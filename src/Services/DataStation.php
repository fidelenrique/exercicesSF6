<?php

namespace App\Services;

use App\Entity\Station;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;

class DataStation
{
    const SET_TIME_LIMIT = 1800; // 30 minutes timeout
    const NUMBER_OF_BATCHES = 100;
    const START_OF_BATCH = 0;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function dataToStation($data): void
    {
        set_time_limit(DataStation::SET_TIME_LIMIT);

        if (!empty($data['data'])) {
            $rows = [];

            foreach ($data['data'] as $key => $datum) {
                if ($key > 0) {

                    $rows[] = [
                        'geo_point' => $datum[0],
                        'geo_shape' => $datum[1],
                        'objectid' => $datum[2],
                        'id_ref_zdl' => $datum[3],
                        'gares_id' => $datum[4],
                        'nom_gare' => $datum[5],
                        'nomlong' => $datum[6],
                        'nom_iv' => $datum[7],
                        'num_mod' => $datum[8],
                        'mode_' => $datum[9],
                        'fer' => $datum[10],
                        'train' => $datum[11],
                        'rer' => $datum[12],
                        'metro' => $datum[13],
                        'tramway' => $datum[14],
                        'navette' => $datum[15],
                        'val' => $datum[16],
                        'terfer' => $datum[17],
                        'tertrain' => $datum[18],
                        'terrer' => $datum[19],
                        'termetro' => $datum[20],
                        'tertram' => $datum[21],
                        'ternavette' => $datum[22],
                        'terval' => $datum[23],
                        'idrefliga' => $datum[24],
                        'idrefligc' => $datum[25],
                        'ligne' => $datum[26],
                        'cod_ligf' => $datum[27],
                        'ligne_code' => $datum[28],
                        'indice_lig' => $datum[29],
                        'reseau' => $datum[30],
                        'res_com' => $datum[31],
                        'cod_resf' => $datum[32],
                        'res_stif' => $datum[33],
                        'exploitant' => $datum[34],
                        'num_psr' => $datum[35],
                        'idf' => $datum[36],
                        'principal' => $datum[37],
                        'x' => $datum[38],
                        'y' => $datum[39]
                    ];
                }
            }

            $numberOfSlices = intdiv(count($rows), DataStation::NUMBER_OF_BATCHES);

            for ($i = 0; $i <= $numberOfSlices; $i++) {
                if ($i === 0) {
                    $stations = array_slice($rows, DataStation::START_OF_BATCH, DataStation::NUMBER_OF_BATCHES);
                    $this->insertionBySlices($stations);
                    for ($j = DataStation::START_OF_BATCH; $j < DataStation::NUMBER_OF_BATCHES; $j++) {
                        array_shift($rows);
                    }

                }
                if ($i > 0) {
                    $stations = array_slice($rows, DataStation::START_OF_BATCH, DataStation::NUMBER_OF_BATCHES);
                    $this->insertionBySlices($stations);
                    for ($j = DataStation::START_OF_BATCH; $j < DataStation::NUMBER_OF_BATCHES; $j++) {
                        array_shift($rows);
                    }
                }
            }
        }
    }

    private function insertionBySlices($stations): void
    {
        foreach ($stations as $station) {
            $forDbStation = new Station();
            $forDbStation->setGeoPoint($station['geo_point']);
            $forDbStation->setGeoShape($station['geo_shape']);
            $forDbStation->setObjectid($station['objectid']);
            $forDbStation->setIdRefZdl($station['id_ref_zdl']);
            $forDbStation->setGaresId($station['gares_id']);
            $forDbStation->setNomGare($station['nom_gare']);
            $forDbStation->setNomlong($station['nomlong']);
            $forDbStation->setNomIv($station['nom_iv']);
            $forDbStation->setNumMod($station['num_mod']);
            $forDbStation->setMode($station['mode_']);
            $forDbStation->setFer($station['fer']);
            $forDbStation->setTrain($station['train']);
            $forDbStation->setRer($station['rer']);
            $forDbStation->setMetro($station['metro']);
            $forDbStation->setTramway($station['tramway']);
            $forDbStation->setNavette($station['navette']);
            $forDbStation->setVal($station['val']);
            $forDbStation->setTerfer($station['terfer']);
            $forDbStation->setTertrain($station['tertrain']);
            $forDbStation->setTerrer($station['terrer']);
            $forDbStation->setTermetro($station['termetro']);
            $forDbStation->setTertram($station['tertram']);
            $forDbStation->setTernavette($station['ternavette']);
            $forDbStation->setTerval($station['terval']);
            $forDbStation->setIdrefliga($station['idrefliga']);
            $forDbStation->setIdrefligc($station['idrefligc']);
            $forDbStation->setLigne($station['ligne']);
            $forDbStation->setCodLigf($station['cod_ligf']);
            $forDbStation->setLigneCode($station['ligne_code']);
            $forDbStation->setIndiceLig($station['indice_lig']);
            $forDbStation->setReseau($station['reseau']);
            $forDbStation->setResCom($station['res_com']);
            $forDbStation->setCodResf($station['cod_resf']);
            $forDbStation->setResStif($station['res_stif']);
            $forDbStation->setExploitant($station['exploitant']);
            $forDbStation->setNumPsr($station['num_psr']);
            $forDbStation->setIdf($station['idf']);
            $forDbStation->setPrincipal($station['principal']);
            $forDbStation->setX($station['x']);
            $forDbStation->setY($station['y']);
            // C. Persist and flush
            $this->entityManager->persist($forDbStation);
            $this->entityManager->flush();
        }
    }

    /**
     * @throws Exception
     */
    public function truncateStation(): void
    {
        if (count($this->entityManager->getRepository(Station::class)->findAll())>0) {
            $connection = $this->entityManager->getConnection();
            $platform   = $connection->getDatabasePlatform();
            $connection->executeUpdate($platform->getTruncateTableSQL('station', true));
        }
    }
}