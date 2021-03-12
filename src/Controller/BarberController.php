<?php

namespace App\Controller;

use App\Entity\Barber;
use App\Form\BarberType;
use App\Repository\BarberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/barber')]
class BarberController extends AbstractController
{
    #[Route('/{id}/read', name: 'barber_read', methods: ['GET'])]
    public function read(Barber $barber): Response
    {
        return $this->render('barber/read.html.twig', [
            'barber' => $barber,
        ]);
    }

    #[Route('/{id}/update', name: 'barber_update', methods: ['GET', 'POST'])]
    public function update(Request $request, Barber $barber): Response
    {
        $form = $this->createForm(BarberType::class, $barber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('barber_read');
        }

        return $this->render('barber/update.html.twig', [
            'barber' => $barber,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'barber_delete', methods: ['DELETE'])]
    public function delete(Request $request, Barber $barber): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barber->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($barber);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
