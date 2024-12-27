<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Form\ElevesType;
use App\Form\RechercheType;
use App\Model\RechercheDonnee;
use App\Repository\ElevesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InscriptionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/eleves')]
class ElevesController extends AbstractController
{
    private $ElevesRepository;

    public function __construct(
        ElevesRepository $ElevesRepository
    ) {
        $this->ElevesRepository = $ElevesRepository;
    }

    #[Route('/', name: 'app_eleves_index', methods: ['GET'])]
    public function index(Request $request, ManagerRegistry $em, ElevesRepository $elevesRepository, InscriptionRepository $inscriptionRepository): Response
    {
        /** Barre de recherche 
        $RechercheDonnee = new RechercheDonnee();
        $form = $this->createForm(RechercheType::class, $RechercheDonnee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $RechercheDonnee->page = $request->query->getInt('page', 1);
            $posts = $elevesRepository->findByRecherche($RechercheDonnee);

            return $this->render('admin/eleves/ElevesIndex.html.twig', [
                'form' => $form,
                'posts' => $posts,

            ]);
        }*/

        /** Pagination */
        $offset = max(0, $request->query->getInt('offset', 0));
        $TousEleves = $em->getRepository(Eleves::class)->finAllEleves($offset);
        return $this->render('admin/eleves/ElevesIndex.html.twig', [
            /** 'form' => $form->createView(),*/
            'eleves' => $elevesRepository->findAll(),
            'TousEleves' => $TousEleves,
            'countAllEleves' => $this->ElevesRepository->countAllEleves(),
            'previous' => $offset - ElevesRepository::PAGINATION_PAR_PAGE,
            'next' => min(count($TousEleves), $offset + ElevesRepository::PAGINATION_PAR_PAGE),
            'inscriptions' => $inscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_eleves_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, #[Autowire('%photo_dir%')] string $photoDir): Response
    {
        $elefe = new Eleves();
        $form = $this->createForm(ElevesType::class, $elefe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $elefe = $form->getData();
            if ($photo = $form['photo']->getData()) {
                $filename = uniqid() . '.' . $photo->guessExtension();
                $photo->move($photoDir, $filename);
                $elefe->setImageFileName($filename);
            }
            $entityManager->persist($elefe);
            $entityManager->flush();

            return $this->redirectToRoute('app_eleves_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/eleves/new.html.twig', [
            'elefe' => $elefe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eleves_show', methods: ['GET'])]
    public function show(Eleves $elefe): Response
    {
        return $this->render('admin/eleves/show.html.twig', [
            'elefe' => $elefe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eleves_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Eleves $elefe, EntityManagerInterface $entityManager, #[Autowire('%photo_dir%')] string $photoDir): Response
    {
        $form = $this->createForm(ElevesType::class, $elefe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $elefe = $form->getData();
            if ($photo = $form['photo']->getData()) {
                $filename = uniqid() . '.' . $photo->guessExtension();
                $photo->move($photoDir, $filename);
                $elefe->setImageFileName($filename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_eleves_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/eleves/edit.html.twig', [
            'elefe' => $elefe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eleves_delete', methods: ['POST'])]
    public function delete(Request $request, Eleves $elefe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $elefe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($elefe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eleves_index', [], Response::HTTP_SEE_OTHER);
    }
}
