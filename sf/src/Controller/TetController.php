<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TetController extends AbstractController
{
    #[Route('/tet', name: 'app_tet')]
    public function index(
        EventRepository $eventRepository,
        EntityManagerInterface $em,
    ): Response {
        $e = $eventRepository->test('2023-01-02');
        dump($e->getAppointments()->getKeys());
        $e = $eventRepository->test('2023-01-01');
        dump($e->getAppointments()->getKeys());
        $e = $eventRepository->find(1);
        dump($e->getAppointments()->getKeys());
        $em->clear();
        $e = $eventRepository->test('2023-01-01');
        dump($e->getAppointments()->getKeys());
        $e = $eventRepository->test('2023-01-02');
        dump($e->getAppointments()->getKeys());
        $e = $eventRepository->find(1);
        dump($e->getAppointments()->getKeys());
        $em->clear();
        $e = $eventRepository->find(1);
        dump($e->getAppointments()->getKeys());
        $e = $eventRepository->test('2023-01-02');
        dump($e->getAppointments()->getKeys());
        $e = $eventRepository->test('2023-01-01');
        dump($e->getAppointments()->getKeys());
        dd('');
    }
}
