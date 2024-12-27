<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\ClasseRepository;
use App\Repository\ElevesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InscriptionRepository;
use App\Repository\ProfesseursRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/inscription')]
class InscriptionController extends AbstractController
{
    private $ElevesRepository;
    private $InscriptionRepository;
    private $ClasseRepository;
    private $ProfesseursRepository;

    public function __construct(
        ElevesRepository $ElevesRepository,
        InscriptionRepository $inscriptionRepository,
        ClasseRepository $classe,
        ProfesseursRepository $prof,
    ) {
        $this->ElevesRepository = $ElevesRepository;
        $this->InscriptionRepository = $inscriptionRepository;
        $this->ClasseRepository = $classe;
        $this->ProfesseursRepository = $prof;
    }

    #[Route('/', name: 'app_inscription_index', methods: ['GET'])]
    public function index(Request $request, ManagerRegistry $em, InscriptionRepository $inscriptionRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $TousEleves = $em->getRepository(Inscription::class)->finAllInscriptions($offset);
        return $this->render('admin/inscription/InscriptionIndex.html.twig', [
            'inscriptions' => $inscriptionRepository->findAll(),
            'countAllEleves' => $this->ElevesRepository->countAllEleves(),
            'countAllElevesInscris' => $this->InscriptionRepository->countAllElevesInscris(),
            'countAllClasses' => $this->ClasseRepository->countAllClasses(),
            'CountAllProfesseurs' => $this->ProfesseursRepository->CountAllProfesseurs(),
            'TousEleves' => $TousEleves,
            'previous' => $offset - InscriptionRepository::PAGINATION_PAR_PAGE,
            'next' => min(count($TousEleves), $offset + InscriptionRepository::PAGINATION_PAR_PAGE)
        ]);
    }

    #[Route('/new', name: 'app_inscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/inscription/new.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_show', methods: ['GET'])]
    public function show(Inscription $inscription): Response
    {
        return $this->render('admin/inscription/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inscription $inscription, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/inscription/edit.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_delete', methods: ['POST'])]
    public function delete(Request $request, Inscription $inscription, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $inscription->getId(), $request->request->get('_token'))) {
            $entityManager->remove($inscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
