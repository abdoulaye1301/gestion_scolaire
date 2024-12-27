<?php

namespace App\Controller;

use App\Entity\Devoir;
use App\Form\DevoirType;
use App\Repository\DevoirRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/devoir')]
class DevoirController extends AbstractController
{
    #[Route('/', name: 'app_devoir_index', methods: ['GET'])]
    public function index(Request $request, DevoirRepository $devoirRepository, ManagerRegistry $em): Response
    {

        /** Pagination */
        $offset = max(0, $request->query->getInt('offset', 0));
        $TousDevoirs = $em->getRepository(Devoir::class)->findByDevoirs($offset);
        return $this->render('admin/notes/devoir/devoirIndex.html.twig', [
            'devoirs' => $devoirRepository->findAll(),
            'TousDevoirs' => $TousDevoirs,
            'previous' => $offset - DevoirRepository::PAGINATION_PAR_PAGE,
            'next' => min(count($TousDevoirs), $offset + DevoirRepository::PAGINATION_PAR_PAGE),
        ]);
    }

    #[Route('/new', name: 'app_devoir_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $devoir = new Devoir();
        $form = $this->createForm(DevoirType::class, $devoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($devoir);
            $entityManager->flush();

            return $this->redirectToRoute('app_devoir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/notes/devoir/new.html.twig', [
            'devoir' => $devoir,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devoir_show', methods: ['GET'])]
    public function show(Devoir $devoir): Response
    {
        return $this->render('admin/notes/devoir/show.html.twig', [
            'devoir' => $devoir,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devoir_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Devoir $devoir, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DevoirType::class, $devoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_devoir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/notes/devoir/edit.html.twig', [
            'devoir' => $devoir,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devoir_delete', methods: ['POST'])]
    public function delete(Request $request, Devoir $devoir, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $devoir->getId(), $request->request->get('_token'))) {
            $entityManager->remove($devoir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_devoir_index', [], Response::HTTP_SEE_OTHER);
    }
}
