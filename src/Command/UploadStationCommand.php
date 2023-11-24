<?php

namespace App\Command;

use App\Constants\DataSheet;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Services\DataStation;

// the "name" and "description" arguments of AsCommand replace the
// static $defaultName and $defaultDescription properties
#[AsCommand(
    name: 'app:upload-station',
    description: 'Upload all stations.',
    aliases: ['app:add-stations'],
    hidden: false
)]
class UploadStationCommand extends Command
{
    private DataStation $dataStation;

    public function __construct(DataStation $dataStation, string $name = null)
    {
        parent::__construct($name);
        $this->dataStation = $dataStation;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'Import csv',
            '===========',
            '',
        ]);

        $output->writeln('Truncate station table...');
        $this->dataStation->truncateStation();
        $output->writeln('Insert data in station table...');
        $this->dataStation->dataToStation(DataSheet::getDataSheet());

        // outputs a message without adding a "\n" at the end of the line
        $output->writeln('list of created stations.');

        return Command::SUCCESS;
    }
}