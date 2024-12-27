<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionFormType;
use App\Repository\ClasseRepository;
use App\Repository\ElevesRepository;
use App\Repository\InscriptionRepository;
use App\Repository\ParentsRepository;
use App\Repository\MatieresRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProfesseursRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    private $ElevesRepository;
    private $UtilisateursRepository;
    private $ProfesseursRepository;
    private $ParentsRepository;
    private $ClasseRepository;
    private $MatieresRepository;

    public function __construct(
        ElevesRepository $ElevesRepository,
        UtilisateursRepository $UtilisateursRepository,
        ProfesseursRepository $ProfesseursRepository,
        ParentsRepository $ParentsRepository,
        MatieresRepository $MatieresRepository,
        ClasseRepository $ClasseRepository
    ) {
        $this->ElevesRepository = $ElevesRepository;
        $this->UtilisateursRepository = $UtilisateursRepository;
        $this->ProfesseursRepository = $ProfesseursRepository;
        $this->ParentsRepository = $ParentsRepository;
        $this->ClasseRepository = $ClasseRepository;
        $this->MatieresRepository = $MatieresRepository;
    }

    #[Route('/administ1', name: 'administ1')]
    public function administration(InscriptionRepository $inscriptionRepository): Response
    {
        return $this->render('admin/Dashboard/administration1.html.twig', [
            'countAllEleves' => $this->ElevesRepository->countAllEleves(),
            'countAllUtilisateurs' => $this->UtilisateursRepository->countAllUtilisateurs(),
            'countAllProfesseurs' => $this->ProfesseursRepository->CountAllProfesseurs(),
            'countAllParents' => $this->ParentsRepository->CountAllParents(),
            'countAllClasses' => $this->ClasseRepository->countAllClasses(),
            'countAllMatieres' => $this->MatieresRepository->countAllMatieres(),
            'Utilisateurs' => $this->UtilisateursRepository->findAll(),
            'countAllGarçon' => $this->ElevesRepository->countAllGarçon(),
            'countAllFilles' => $this->ElevesRepository->countAllFilles(),
            'inscriptions' => $inscriptionRepository->finAllAdministration(),
        ]);
    }



    #[Route('/administration', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/Administration.html.twig');
    }
    /**#[Route('/', name: 'accueilPrincipale')]
    public function accueil(): Response
    {
        return $this->render('accueil/accueilPrincipale.html.twig');
    }

    /** Espace administrateur des enségnants */
    #[Route('/administration_ensegnant', name: 'ensegnantAdmin')]
    public function ensegnantAdmin(): Response
    {
        return $this->render('admin/ensegnants/ensegnantsAdmin.html.twig');
    }

    /** Espace administrateur des élèves */
    #[Route('/administration_eleves', name: 'elevesAdmin')]
    public function elevesAdmin(): Response
    {
        return $this->render('admin/eleves/elevesAdmin.html.twig');
    }

    /** Espace administrateur des élèves */
    #[Route('/administration_parents', name: 'parentsAdmin')]
    public function parentsAdmin(): Response
    {
        return $this->render('admin/parents/parentsAdmin.html.twig');
    }

    #[Route('/paiement_Inscription', name: 'inscription_eleve')]
    public function paiementInscription(Request $request, EntityManagerInterface $entityManager): Response
    {
        $Inscription = new Inscription();
        $InscriptionForm = $this->createForm(InscriptionFormType::class, $Inscription);
        $InscriptionForm->handleRequest($request);

        if ($InscriptionForm->isSubmitted() && $InscriptionForm->isValid()) {

            $entityManager->persist($Inscription);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('inscription_eleve');
        }
        return $this->render('admin/parents/Inscription.html.twig', [
            'InscriptionForm' => $InscriptionForm->createView(),
        ]);
    }
}
