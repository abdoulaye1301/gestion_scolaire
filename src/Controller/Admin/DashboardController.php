<?php

namespace App\Controller\Admin;

use App\Entity\Sexe;
use App\Entity\Classe;
use App\Entity\Devoir;
use App\Entity\Eleves;
use App\Entity\Matieres;
use App\Entity\Semestre;
use App\Entity\Evaluation;
use App\Entity\Evenements;
use App\Entity\Composition;
use App\Entity\Utilisateurs;
use App\Entity\AnneeScolaire;
use App\Repository\ClasseRepository;
use App\Repository\ElevesRepository;
use App\Repository\ParentsRepository;
use App\Repository\CalendarRepository;
use App\Repository\MatieresRepository;
use App\Repository\ProfesseursRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
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

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/Dashboard/dashboard.html.twig', [
            'countAllEleves' => $this->ElevesRepository->countAllEleves(),
            'countAllUtilisateurs' => $this->UtilisateursRepository->countAllUtilisateurs(),
            'countAllProfesseurs' => $this->ProfesseursRepository->CountAllProfesseurs(),
            'countAllParents' => $this->ParentsRepository->CountAllParents(),
            'countAllClasses' => $this->ClasseRepository->countAllClasses(),
            'countAllMatieres' => $this->MatieresRepository->countAllMatieres(),
            'Utilisateurs' => $this->UtilisateursRepository->findAll()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion Scolarite');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user-circle', Utilisateurs::class);
        yield MenuItem::linkToCrud('Années Scolaires', 'fas fa-home', AnneeScolaire::class);
        yield MenuItem::linkToCrud('Classes', 'fas fa-list', Classe::class);
        yield MenuItem::linkToCrud('Evaluations', 'fas fa-graduation-cap', Evaluation::class);
        yield MenuItem::linkToCrud('Matières', 'fas fa-graduation-cap', Matieres::class);
        yield MenuItem::linkToCrud('Semestres', 'fas fa-graduation-cap', Semestre::class);
        yield MenuItem::linkToCrud('Sexes', 'fas fa-graduation-cap', Sexe::class);
        yield MenuItem::linkToCrud('Evenements', 'fas fa-graduation-cap', Evenements::class);
    }


    #[Route('/administ2', name: 'administ2')]
    public function administ2(): Response
    {
        return $this->render('admin/Dashboard/administration2.html.twig', [
            'countAllEleves' => $this->ElevesRepository->countAllEleves(),
            'countAllUtilisateurs' => $this->UtilisateursRepository->countAllUtilisateurs(),
            'countAllProfesseurs' => $this->ProfesseursRepository->CountAllProfesseurs(),
            'countAllParents' => $this->ParentsRepository->CountAllParents(),
            'countAllClasses' => $this->ClasseRepository->countAllClasses(),
            'countAllMatieres' => $this->MatieresRepository->countAllMatieres(),
            'Utilisateurs' => $this->UtilisateursRepository->findAll()
        ]);
    }
}
