<?php

namespace App\Controller;

use App\Entity\Composition;
use App\Form\CompositionType;
use App\Repository\CompositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/composition')]
class CompositionController extends AbstractController
{
    #[Route('/', name: 'app_composition_index', methods: ['GET'])]
    public function index(CompositionRepository $compositionRepository): Response
    {
        return $this->render('admin/notes/composition/compositionIndex.html.twig', [
            'compositions' => $compositionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_composition_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $composition = new Composition();
        $form = $this->createForm(CompositionType::class, $composition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($composition);
            $entityManager->flush();

            return $this->redirectToRoute('app_composition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/notes/composition/new.html.twig', [
            'composition' => $composition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_composition_show', methods: ['GET'])]
    public function show(Composition $composition): Response
    {
        return $this->render('admin/notes/composition/show.html.twig', [
            'composition' => $composition,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_composition_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Composition $composition, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompositionType::class, $composition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_composition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/notes/composition/edit.html.twig', [
            'composition' => $composition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_composition_delete', methods: ['POST'])]
    public function delete(Request $request, Composition $composition, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $composition->getId(), $request->request->get('_token'))) {
            $entityManager->remove($composition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_composition_index', [], Response::HTTP_SEE_OTHER);
    }
}
