<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Entity\NewsLetter;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/home.html.twig', [
            'menu' => 'home',
        ]);
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'menu' => 'contact',
        ]);
    }

    /**
     * @Route("/contact/send", name="app_contact_send")
     */
    public function contactSend(Request $request, MailerInterface $mailer)
    {
        if($request->request->get('newsletter') == 'abonne')
        {
            $o_newsletterSaved = $this->getDoctrine()->getRepository(NewsLetter::class)->findOneBy(array('email' => $request->request->get('email')));
            if ($o_newsletterSaved==NULL)
            {
                $o_newsletter = new NewsLetter();
                $o_newsletter->setNomComplet($request->request->get('nom').' '.$request->request->get('prenom'));
                $o_newsletter->setEmail($request->request->get('email'));
                $o_newsletter->setDateAbonnement(new \DateTime());
                $o_newsletter->setMailsRecu(1);
                $this->getDoctrine()->getManager()->persist($o_newsletter);
                $this->getDoctrine()->getManager()->flush();
            }
        }//endif s'abonner

        $message = (new Email())
            ->from($request->request->get('email'))
            ->to('rijanavalona.rakotomalala@gmail.com')
            ->subject('Vous avez reçu unn email')
            ->text('Sender : Application MDB Symfony'.\PHP_EOL.
            $request->request->get('message'),
                'text/plain');
        $mailer->send($message);

        $this->addFlash('success', 'Vore message a été envoyé');

        return $this->redirectToRoute('app_contact');
    }

    /**
     * @Route("/about", name="app_about")
     */
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'menu' => 'about',
        ]);
    }

    /**
     * @Route("/advert/view/{year}/{slug}.{format}", name="oc_advert_view_slug", requirements={
     *   "year"   = "\d{4}",
     *   "format" = "html|xml"
     * }, defaults={"format" = "html"})
     */
    public function exampleRoute($year,$slug,$format) : Response
    {
        $this->render('home/registration.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
