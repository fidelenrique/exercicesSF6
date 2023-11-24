<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationRepository;
use function Symfony\Component\String\u;

class StationController extends AbstractController
{
    const TITLE_STATION = 'Liste des Station de gare RATP';

    #[Route('/', name: 'home_page')]
    public function home()
    {
        return $this->render('station/home.html.twig', []);
    }

    #[Route('/station', name: 'station_list', methods: ['GET'])]
    public function stations(StationRepository $stationRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $line = $request->query->get('line')?? null;
        $pagination = $paginator->paginate(
            $stationRepository->paginationQuery($line),
            $request->query->get('page', 1),
            20
        );

        return $this->render('station/show.html.twig', [
            'pagination' => $pagination,
            'title' => self::TITLE_STATION,
            'lines' => $stationRepository->ratpLines(),
            'transits' => $stationRepository->transitInLine()
        ]);
    }

    #[Route('/ligne/{slug}', name: 'app_browse')]
    public function ligne(string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre
        ]);
    }

}