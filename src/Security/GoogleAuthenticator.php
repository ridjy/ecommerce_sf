<?php
/**la méthode d'authentification */
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Security\Exception\NotVerifiedEmailException;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use KnpU\OAuth2ClientBundle\Client\Provider\GithubClient;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use League\OAuth2\Client\Provider\GithubResourceOwner;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport; 
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use League\OAuth2\Client\Provider\Google;

class GoogleAuthenticator extends OAuth2Authenticator implements AuthenticatorInterface
{

    use TargetPathTrait;

    private RouterInterface $router;
    private ClientRegistry $clientRegistry;
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct (RouterInterface $router, ClientRegistry $clientRegistry, UserRepository $userRepository, 
    EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder) 
    {
        $this->router = $router;
        $this->clientRegistry = $clientRegistry;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse($this->router->generate('app_login'));
    }

    /**
     * Si la route correspond à celle attendue, alors on déclenche cet authenticator
    **/
    public function supports(Request $request) : bool
    {
        return 'connect_google_check' === $request->attributes->get('_route') && $request->get('service') === 'google';
    }

    //rentre ici lors de l'authentification
    public function authenticate(Request $request): Passport
    {
        $client = $this->clientRegistry->getClient('google');
        $accessToken = $this->fetchAccessToken($client);
        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function() use ($accessToken, $client) {
                /** @var Google $githubUser */
                $googleUser = $client->fetchUserFromToken($accessToken);

                $a_retour = $googleUser->toArray();
                
                // 1) have they logged in with Facebook before? Easy!
                $existingUser = $this->userRepository->findOneBy(['googleId' => $a_retour['sub'] ]);

                if ($existingUser) {
                    return $existingUser;
                } 
                if (isset($a_retour['email']) && $user = $this->userRepository->findOneBy(['email' => $a_retour['email']]))
                {
                    return $user;
                } else {
                    $user = new User();
                    $user->setUsername($a_retour['given_name']);
                    $user->setGoogleId($a_retour['sub']);
                    $user->setEmail($a_retour['email']);
                    //creer un mdp pour l'user pour pas d'erreur
                    $user->setPassword($this->passwordEncoder->encodePassword($user, $a_retour['sub']));
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                }

                return $user;
            })
        );

    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) : ?Response
    {
        if ($request->hasSession()) {
            $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        }

        return new RedirectResponse($this->router->generate('app_login'));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey) : ?Response
    {
        //fait qu'après onauthenticate va rediriger ici
        $targetPath = $this->getTargetPath($request->getSession(), $providerKey);
        return new RedirectResponse($targetPath ?: '/');
    }

    private function getClient(): GoogleClient {
        return $this->clientRegistry->getClient('google');
    }
}