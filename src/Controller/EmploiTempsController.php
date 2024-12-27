<?php

namespace App\Controller;

use App\Entity\EmploiTemps;
use App\Form\EmploiTemps1Type;
use App\Repository\EmploiTempsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/emploi/temps')]
class EmploiTempsController extends AbstractController
{
    #[Route('/', name: 'app_emploi_temps_index', methods: ['GET'])]
    public function index(EmploiTempsRepository $emploiTempsRepository): Response
    {
        return $this->render('admin/emploi_temps/EmploisTempsIndex.html.twig', [
            'emploi_temps' => $emploiTempsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_emploi_temps_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $emploiTemp = new EmploiTemps();
        $form = $this->createForm(EmploiTemps1Type::class, $emploiTemp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emploiTemp);
            $entityManager->flush();

            return $this->redirectToRoute('app_emploi_temps_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/emploi_temps/new.html.twig', [
            'emploi_temp' => $emploiTemp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_emploi_temps_show', methods: ['GET'])]
    public function show(EmploiTemps $emploiTemp): Response
    {
        return $this->render('admin/emploi_temps/show.html.twig', [
            'emploi_temp' => $emploiTemp,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_emploi_temps_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EmploiTemps $emploiTemp, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmploiTemps1Type::class, $emploiTemp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_emploi_temps_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/emploi_temps/edit.html.twig', [
            'emploi_temp' => $emploiTemp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_emploi_temps_delete', methods: ['POST'])]
    public function delete(Request $request, EmploiTemps $emploiTemp, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $emploiTemp->getId(), $request->request->get('_token'))) {
            $entityManager->remove($emploiTemp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_emploi_temps_index', [], Response::HTTP_SEE_OTHER);
    }
}
