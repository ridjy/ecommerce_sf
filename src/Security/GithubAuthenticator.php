<?php
/**la méthode d'authentification */
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use App\Security\Exception\NotVerifiedEmailException;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
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
use Symfony\Component\Security\Http\Authenticator\Passport\Passport; 
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;

class GithubAuthenticator implements AuthenticatorInterface
{

    use TargetPathTrait;

    private RouterInterface $router;
    private ClientRegistry $clientRegistry;
    private UserRepository $userRepository;

    public function __construct (RouterInterface $router, ClientRegistry $clientRegistry, UserRepository $userRepository) {

        $this->router = $router;
        $this->clientRegistry = $clientRegistry;
        $this->userRepository = $userRepository;
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
        return 'oauth_check' === $request->attributes->get('_route') && $request->get('service') === 'github';
    }

    public function getCredentials(Request $request)
    {
        return $this->fetchAccessToken($this->clientRegistry->getClient('github'));
    }

    //rentre ici lors de l'authentification
    public function authenticate(Request $request): Passport
    {
        $credentials = $this->getCredentials($request);
        dd($credentials);
    }

    public function createAuthenticatedToken(PassportInterface $passport, string $firewallName) : TokenInterface
    {
        dd();
    }

    /**
     * Récupère l'utilisateur à partir du AccessToken
     * 
     * @param AccessToken $credentials
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        dd($credentials);
        /** @var GithubResourceOwner $githubUser */
       /* $githubUser = $this->getClient()->fetchUserFromToken($credentials);

        // On récupère l'email de l'utilisateur (spécifique à github)
        $response = HttpClient::create()->request(
            'GET',
            'https://api.github.com/user/emails',
            [
                'headers' => [
                    'authorization' => "token {$credentials->getToken()}"
                ]
            ]
        );
        $emails = json_decode($response->getContent(), true);
        foreach($emails as $email) {
            if ($email['primary'] === true && $email['verified'] === true) {
                $data = $githubUser->toArray();
                $data['email'] = $email['email'];
                $githubUser = new GithubResourceOwner($data);
            }
        }

        if ($githubUser->getEmail() === null) {
            throw new NotVerifiedEmailException();
        }

        return $this->userRepository->findOrCreateFromGithubOauth($githubUser);*/
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
        $targetPath = $this->getTargetPath($request->getSession(), $providerKey);
        return new RedirectResponse($targetPath ?: '/');
    }

    private function getClient (): GithubClient {
        return $this->clientRegistry->getClient('github');
    }
}