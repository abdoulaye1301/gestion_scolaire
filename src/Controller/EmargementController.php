<?php

namespace App\Controller;

use App\Entity\Emargement;
use App\Form\EmargementType;
use App\Repository\AnneeScolaireRepository;
use App\Repository\ClasseRepository;
use App\Repository\EmargementRepository;
use App\Repository\MatieresRepository;
use App\Repository\ProfesseursRepository;
use App\Repository\SemestreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/emargement')]
class EmargementController extends AbstractController
{
    #[Route('/', name: 'app_emargement_index', methods: ['GET'])]
    public function index(
        EmargementRepository $emargementRepository,
        ProfesseursRepository $professeursRepository,
        MatieresRepository $matieresRepository,
        ClasseRepository $classeRepository,
        SemestreRepository $semestreRepository,
        AnneeScolaireRepository $anneeScolaireRepository
    ): Response {
        return $this->render('admin/emargement/index.html.twig', [
            'emargements' => $emargementRepository->findAll(),
            'professeurs' => $professeursRepository->findAll(),
            'matieres' => $matieresRepository->findAll(),
            'classe' => $classeRepository->findAll(),
            'semestre' => $semestreRepository->findAll(),
            'anneeScolaire' => $anneeScolaireRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_emargement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $emargement = new Emargement();
        $form = $this->createForm(EmargementType::class, $emargement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emargement);
            $entityManager->flush();

            return $this->redirectToRoute('app_emargement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/emargement/new.html.twig', [
            'emargement' => $emargement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_emargement_show', methods: ['GET'])]
    public function show(Emargement $emargement): Response
    {
        return $this->render('admin/emargement/show.html.twig', [
            'emargement' => $emargement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_emargement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Emargement $emargement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmargementType::class, $emargement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_emargement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/emargement/edit.html.twig', [
            'emargement' => $emargement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_emargement_delete', methods: ['POST'])]
    public function delete(Request $request, Emargement $emargement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $emargement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($emargement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_emargement_index', [], Response::HTTP_SEE_OTHER);
    }
}
