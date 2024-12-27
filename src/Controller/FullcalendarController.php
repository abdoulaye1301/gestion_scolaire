<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Repository\CalendarRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FullcalendarController extends AbstractController
{
    #[Route('/fullcalendar', name: 'app_fullcalendar')]
    public function index(CalendarRepository $calendar): Response
    {
        $events = $calendar->findAll();
        $rdv = [];
        foreach ($events as $event) {
            $rdv[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:m:s'),
                'end' => $event->getEnd()->format('Y-m-d H:m:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'allDay' => $event->isAllDay(),
                'backgroundColor' => $event->getBackgroundColor(),
                'bordrColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor()
            ];
        }
        $data = json_encode($rdv);
        return $this->render('fullcalendar/fullcalendar.html.twig', compact('data'));
    }
}
