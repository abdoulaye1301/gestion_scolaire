<?php

namespace App\Controller;

use DateTime;
use App\Entity\Calendar;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'app_api_edit', methods: 'PUT')]
    public function majEvent(?Calendar $calendar, Request $request): Response
    {

        $donnees = json_decode($request->getContent());
        if (
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->bordrColor) && !empty($donnees->bordrColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ) {
            # Les données sont complètes
            # On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if (!$calendar) {
                # On instancie un rendez-vous
                $calendar = new Calendar;

                # On change les code
                $code = 201;
            }
            # On hydrate l'objet avec les données
            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new DateTime($donnees->start));
            if ($donnees->allDay) {
                $calendar->setEnd(new DateTime($donnees->start));
            } else {
                $calendar->setEnd(new DateTime($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->bordrColor);
            $calendar->setTextColor($donnees->textColor);
            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            # On retourne le code
            return new Response('Ok', $code);
        } else {
            # Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
