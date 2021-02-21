<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Form\CustomerUpdatePwdType;
use App\Form\CustomerUpdateType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/customer")
 */
class CustomerController extends AbstractController
{
    /**
     * @Route("/create", name="customer_create", methods={"GET","POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
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

            $this->addFlash('success', 'Inscription réussie !');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('customer/create.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
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
     * @param Customer $customer
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function update_pwd(Request $request, Customer $customer, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(CustomerUpdatePwdType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $oldPassword = $passwordEncoder->encodePassword(
                $customer,
                $form->get('oldPassword')->getData()
            );

            if($oldPassword === $customer->getPassword()) {

                $customer->setPassword(
                    $passwordEncoder->encodePassword(
                        $customer,
                        $form->get('password')->getData()
                    )
                );

                $entityManager->persist($customer);
                $entityManager->flush();

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
     * @param Customer $customer
     * @return Response
     */
    public function delete(Request $request, Customer $customer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
