<?php

namespace Herb\Vcard\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Herb\Vcard\DefaultBundle\Entity\Contact;
use Herb\Vcard\DefaultBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction( Request $request )
    {
        $contact = new Contact();
        // Generate contact form
        $form = $this->createForm(new ContactType(), $contact, ['action' => "",
                                                                'method' => "POST"
                                                                ]
        );
        if( $request->getMethod() === "POST" ){
            $form->handleRequest($request);
            if( $form->isValid() ){

                // Save to db
                $em = $this->getDoctrine()->getManager();
                $contact->setIp($request->getClientIp());

                $em->persist($contact);
                $em->flush();

                // E-mail
                $message = \Swift_Message::newInstance()
                    ->setSubject( $contact->getName()." 透過履歷網站聯絡你!")
                    ->addFrom( "root@mail.iphpo.com" )
                    ->addTo("herb123456@gmail.com")
                    ->setBody(
                        $this->renderView("HerbVcardDefaultBundle:Default:mail.html.twig", ["contact" => $contact])
                    );

                $this->get("mailer")->send($message);

                return $this->render("HerbVcardDefaultBundle:Default:sendok.html.twig", ["indexurl" => $this->generateUrl("index")]);
            }
        }



        return [
            "form" => $form->createView()
        ];
    }

}
