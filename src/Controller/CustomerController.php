<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Form\CustomerUpdatePwdType;
use App\Form\CustomerUpdateType;
use App\Service\SendingMail;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * @Route("/customer")
 */
class CustomerController extends AbstractController
{
    /**
     * @Route("/create", name="customer_create", methods={"GET","POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param ValidatorInterface $validator
     * @param Environment $twig
     * @param Swift_Mailer $mailer
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder, ValidatorInterface $validator, Environment $twig, Swift_Mailer $mailer): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $customer->setCreatedAt(new \DateTime('NOW'));
            $customer->setPassword(
                $passwordEncoder->encodePassword(
                    $customer,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($customer);
            $entityManager->flush();

            $emailing = new SendingMail();
            $emailing->sendMail($twig, $mailer, $customer);

            $this->addFlash('success', 'Inscription réussie !');

            return $this->redirectToRoute('app_login');
        }

        // all errors from form validation
        $errors = $validator->validate($customer);

        return $this->render('customer/create.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
    }

    /**
     * @Route("/{id}/read", name="customer_read", methods={"GET"})
     * @param Customer $customer
     * @return Response
     */
    public function read(Customer $customer): Response
    {
        return $this->render('customer/read.html.twig', [
            'customer' => $customer,
        ]);
    }

    /**
     * @Route("/{id}/update", name="customer_update", methods={"GET","POST"})
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function update(Request $request, Customer $customer): Response
    {
        $form = $this->createForm(CustomerUpdateType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Vos modifications ont bien été enregistrées.');

            return $this->redirectToRoute('customer_read', [
                'id' => $customer->getId(),
            ]);
        }

        return $this->render('customer/update.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/update_pwd", name="customer_update_pwd", methods={"GET","POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param Customer $customer
     * @return Response
     */
    public function update_pwd(Request $request, UserPasswordEncoderInterface $passwordEncoder, Customer $customer): Response
    {
        $oldPassword = $customer->getPassword();

        $form = $this->createForm(CustomerUpdatePwdType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (password_verify($form->get('oldPassword')->getData(), $oldPassword)) {

                $customer->setPassword(
                    $passwordEncoder->encodePassword(
                        $customer,
                        $form->get('password')->getData()
                    )
                );

                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('success', 'Votre nouveau mot de passe a bien été enregistré.');

                return $this->redirectToRoute('customer_read', [
                    'id' => $customer->getId(),
                ]);
            }

            $this->addFlash('error', 'Ancien mot de passe incorrect.');
        }

        return $this->render('customer/update_pwd.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="customer_delete", methods={"DELETE"})
     * @param Request $request
     * @param SessionInterface $session
     * @param Customer $customer
     * @return Response
     */
    public function delete(Request $request, SessionInterface $session, Customer $customer): Response
    {
        $session->invalidate();

        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_logout');
    }
}
