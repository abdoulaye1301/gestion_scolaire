<?php

namespace App\Controller;

use App\Entity\Professeurs;
use App\Form\ProfesseursType;
use App\Repository\SexeRepository;
use App\Repository\ClasseRepository;
use App\Repository\ContratRepository;
use App\Repository\MatieresRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProfesseursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/professeurs')]
class ProfesseursController extends AbstractController
{
    #[Route('/', name: 'app_professeurs_index', methods: ['GET'])]
    public function index(ProfesseursRepository $professeursRepository, ContratRepository $contratRepository): Response
    {
        return $this->render('admin/professeurs/EnseignantIndex.html.twig', [
            'professeurs' => $professeursRepository->findAll(),
            'contrat' => $contratRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_professeurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, #[Autowire('%prof_dir%')] string $profDir): Response
    {
        $professeur = new Professeurs();
        $form = $this->createForm(ProfesseursType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professeur = $form->getData();
            if ($photo = $form['photo']->getData()) {
                $filename = uniqid() . '.' . $photo->guessExtension();
                $photo->move($profDir, $filename);
                $professeur->setPhoto($filename);
            }
            $entityManager->persist($professeur);
            $entityManager->flush();

            return $this->redirectToRoute('app_professeurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/professeurs/new.html.twig', [
            'professeur' => $professeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_professeurs_show', methods: ['GET'])]
    public function show(Professeurs $professeur): Response
    {
        return $this->render('admin/professeurs/show.html.twig', [
            'professeur' => $professeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_professeurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Professeurs $professeur, EntityManagerInterface $entityManager, #[Autowire('%prof_dir%')] string $profDir): Response
    {
        $form = $this->createForm(ProfesseursType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professeur = $form->getData();
            if ($photo = $form['photo']->getData()) {
                $filename = uniqid() . '.' . $photo->guessExtension();
                $photo->move($profDir, $filename);
                $professeur->setPhoto($filename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_professeurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/professeurs/edit.html.twig', [
            'professeur' => $professeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_professeurs_delete', methods: ['POST'])]
    public function delete(Request $request, Professeurs $professeur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $professeur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($professeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_professeurs_index', [], Response::HTTP_SEE_OTHER);
    }
}
