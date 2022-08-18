<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//restriction d'accès
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Service\FileUpload;
//ajout du use pour utiliser le type input password de Symfony
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'menu' => 'utilisateur',
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('username',TextType::class,array(
                'label' => 'Vorname',
                'attr' => array(
                    'placeholder' => 'Votre pseudo')))
            ->add('email',EmailType::class,array(
                'label' => 'Vormail',
                'attr' => array(
                    'placeholder' => 'Votre adresse mail')))
            ->add('password', PasswordType::class,array(
                'label' => 'Vormdp',
                'attr' => array(
                    'placeholder' => 'Votre mot de passe')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_login', array('msg'=>'1'), Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'menu' => 'utilisateur'
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder, FileUpload $fileUploader): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //pas e changement mdp ici
            //$user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            /** @var UploadedFile $a_avatar */
            $a_avatar = $form->get('avatar')->getData();
            if ($a_avatar) {
                $newFilename = $fileUploader->upload($a_avatar);
                $user->setavatar($newFilename);
            }
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'menu' => 'utilisateur',
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
