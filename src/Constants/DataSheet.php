<?php

namespace App\Constants;

use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\Finder\Finder;

abstract class DataSheet
{
    const FILE_IMPORT_CSV_NAME = 'exports-des-gares-idf.csv';
    const SHEET_ONE_NAME = 'exports-des-gares-idf';
    const ERROR_REQUIRE_GEO_POINT = 'No Geo Point value on line ';


    const COLUMNS = [
        'Geo Point' => 'column Geo Point does not exist',
        'Geo Shape' => 'column Geo Shape does not exist',
        'OBJECTID' => 'column OBJECTID does not exist',
        'id_ref_zdl' => 'column id_ref_zdl does not exist',
        'gares_id' => 'column gares_id does not exist',
        'nom_gare' => 'column nom_gare does not exist',
        'nomlong' => 'column nomlong does not exist',
        'nom_iv' => 'column nom_iv does not exist',
        'num_mod' => 'column num_mod does not exist',
        'mode_' => 'column mode_ does not exist',
        'fer' => 'column fer does not exist',
        'train' => 'column train does not exist',
        'rer' => 'column rer does not exist',
        'metro' => 'column metro does not exist',
        'tramway' => 'column tramway does not exist',
        'navette' => 'column navette does not exist',
        'val' => 'column val does not exist',
        'terfer' => 'column terfer does not exist',
        'tertrain' => 'column tertrain does not exist',
        'terrer' => 'column terrer does not exist',
        'termetro' => 'column termetro does not exist',
        'tertram' => 'column tertram does not exist',
        'ternavette' => 'column ternavette does not exist',
        'terval' => 'column terval does not exist',
        'idrefliga' => 'column idrefliga does not exist',
        'idrefligc' => 'column idrefligc does not exist',
        'ligne' => 'column ligne does not exist',
        'cod_ligf' => 'column cod_ligf does not exist',
        'ligne_code' => 'column ligne_code does not exist',
        'indice_lig' => 'column indice_lig does not exist',
        'reseau' => 'column reseau does not exist',
        'res_com' => 'column res_com does not exist',
        'cod_resf' => 'column cod_resf does not exist',
        'res_stif' => 'column res_stif does not exist',
        'exploitant' => 'column exploitant does not exist',
        'num_psr' => 'column num_psr does not exist',
        'idf' => 'column idf does not exist',
        'principal' => 'column principal does not exist',
        'x' => 'column x does not exist',
        'y' => 'column y does not exist'
    ];

    private const PATTERN_COORDINATES = '/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/';
    private const PATTERN_HTML5_ALLOW_NO_TLD = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/';
    private const PATTERN_HTML5 = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/';
    private const PATTERN_LOOSE = '/^.+\@\S+\.\S+$/';

    /**
     * @throws Exception
     */
    public static function getDataSheet(): array
    {
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in(__DIR__ .'/../../public/files');
        $downloadedFile = null;
        foreach ($finder as $file) {
            if ($file->getRelativePathname() === DataSheet::FILE_IMPORT_CSV_NAME) {
                $downloadedFile = $file->getRealPath();
            }
        }

        $spreadsheet = DataSheet::loadCsvFile($downloadedFile);
        $results = DataSheet::validatorSheet($spreadsheet);

        if (empty(DataSheet::sheetErrors($spreadsheet->getAllSheets()[0]))) {
            $results['data'] = DataSheet::headerColumnCheck($spreadsheet);
        }
        else {
            $results['error'][] = implode("  |  ", DataSheet::sheetErrors($spreadsheet->getAllSheets()[0]));
        }

        return $results;
    }

    /**
     * @throws Exception
     */
    public static function loadCsvFile($downloadedFile): Spreadsheet
    {
        $reader = new Csv();
        $reader->setLoadSheetsOnly(["Sheet 1", self::SHEET_ONE_NAME]);
        Return $reader->load($downloadedFile);
    }

    public static function headerColumnCheck(Spreadsheet $spreadsheet): array
    {
        $worksheet = $spreadsheet->getAllSheets()[0];
        return $worksheet->toArray();
    }

    public static function sheetErrors($worksheet): array
    {
        $errors = [];
        foreach (self::COLUMNS as $header => $errorMessage) {

            if (!in_array($header, $worksheet->toArray()[0])) {
                $errors[$header] = $errorMessage;
            }
        }

        return $errors;
    }

    private static function validatorSheet($spreadsheet): array
    {
        $results = [];
        $data = DataSheet::headerColumnCheck($spreadsheet);

        for ($i = 1; $i < count($data); $i++) {
            // check GEO_POINT require
            $keyId = array_search('Geo Point', $data[0]);
            if ($keyId && empty($data[$i][$keyId])) {
                $results['error'][] = DataSheet::ERROR_REQUIRE_GEO_POINT . $i + 1;
            }
            // ...
        }

        return $results;
    }
}
