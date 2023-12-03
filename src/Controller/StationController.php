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

        //var_dump($this->fill(0,0)); // ok
        //var_dump($this->fill(1,1)); // ok
        //var_dump($this->fill(2,2)); // ok
        //var_dump($this->fill(3,3)); // ok
        //var_dump($this->fill(4,4)); // ok
        //var_dump($this->fill(5,5)); // ok
        //var_dump($this->fill(0,1)); // ok
        var_dump($this->fill(3,2)); // ok
        //dd();

        return $this->render('home.html.twig', []);
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

    public function fill($line,$column): array
    {
        $initial_array = [
            [77,77,12,28,37,39],
            [77,77,77,12,12,37],
            [77,77,12,12,37,37],
            [38,29,12,12,37,37],
            [77,12,12,37,37,37],
            [77,12,12,37,37,37]
        ];

        $cardinalNumber = $initial_array[$line][$column];
        // init break line
        $breakLine = $line;
        // we go through the table from top to bottom
        for($lineCount=0; $lineCount<count($initial_array); $lineCount++) {
            $nextLineUp = $lineCount-1;
            $nextLineDown = $lineCount+1;
            if (!is_integer(array_search($cardinalNumber, $initial_array[$lineCount]))) {
                $breakLine = $lineCount;
            }
            // we go through the table from left to right
            for ($columnCount=0; $columnCount<count($initial_array[$lineCount]); $columnCount++) {
                $nextColumnLeft = $columnCount-1;
                $nextColumnRight = $columnCount+1;

                // we approach the value of the cardinals for each item addressed
                if ($initial_array[$lineCount][$columnCount] === $cardinalNumber) {
                    // we put 0 on all the values of the columns of current line
                    if ($lineCount === $line) {
                        $initial_array[$line][$columnCount] = 0;
                    }
                    // when the top line exists
                    if (isset($initial_array[$nextLineDown])) {
                        // when the line below exists
                        if (isset($initial_array[$nextLineUp])) {
                            // if the value of the row - column below is equal to the value
                            // of the cardinal number or equal to zero
                            if(
                                ($initial_array[$nextLineUp][$columnCount] === $cardinalNumber
                                || $initial_array[$nextLineUp][$columnCount] === 0)
                            )
                            {
                                $initial_array[$lineCount][$columnCount] = 0;
                            }
                            // if the value of the row - column above is equal to the value
                            // of the cardinal number or equal to zero
                            if(
                                ($initial_array[$nextLineDown][$columnCount] === $cardinalNumber
                                    || $initial_array[$nextLineDown][$columnCount] === 0)
                            )
                            {
                                // if no break line
                                if ($line === $breakLine) {
                                    $initial_array[$lineCount][$columnCount] = 0;
                                }
                            }
                            // if the value of the row - column below is different from the value
                            // of the cardinal number or different from zero
                            else {
                                // if the value of the left column or the right column is equal to
                                // the value of the cardinal number or it is equal to zero
                                $initial_array = $this->checkLeftRightColumnValue($initial_array, $lineCount, $nextColumnLeft, $nextColumnRight, $columnCount, $cardinalNumber);
                            }
                        }
                        // when the line below does not yet exist
                        // we put 0 on all the values of the columns
                        else {
                            $initial_array = $this->checkLeftRightColumnValue($initial_array, $lineCount, $nextColumnLeft, $nextColumnRight, $columnCount, $cardinalNumber);
                        }
                    }
                    // when the top line does not exist
                    else {
                        $initial_array = $this->checkLeftRightColumnValue($initial_array, $lineCount, $nextColumnLeft, $nextColumnRight, $columnCount, $cardinalNumber);
                    }
                }
            }
        }

        return $initial_array;
    }

    public function checkLeftRightColumnValue($initial_array, $lineCount, $nextColumnLeft, $nextColumnRight, $columnCount, $cardinalNumber): array
    {
        if (
            (isset($initial_array[$lineCount][$nextColumnLeft])
                && ($initial_array[$lineCount][$nextColumnLeft] === $cardinalNumber
                    || $initial_array[$lineCount][$nextColumnLeft] === 0))
            || (isset($initial_array[$lineCount][$nextColumnRight])
                && ($initial_array[$lineCount][$nextColumnRight] === $cardinalNumber
                    || $initial_array[$lineCount][$nextColumnRight] === 0))

        )
        {
            $initial_array[$lineCount][$columnCount] = 0;
        }

        return $initial_array;
    }
}