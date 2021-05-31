<?php

namespace App\Command;

use App\Entity\Measurement;
use App\Entity\ReflowSolderingOven;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UploadTempsCommand extends Command
{
    protected static $defaultName = 'app:upload-temps';
    protected static $defaultDescription = 'Upload temperatures to the database';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('interval', InputArgument::REQUIRED, 'Interval between temperatures in milliseconds')
            ->addArgument('min', InputArgument::REQUIRED, 'Max value for random temperatures')
            ->addArgument('max', InputArgument::REQUIRED, 'Min value for random temperatures');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $reflowSolderingOven = $this->entityManager->getRepository(ReflowSolderingOven::class)->find(1);

        while (true) {
            $measurement = new Measurement();
            $measurement->setReflowSolderingOven($reflowSolderingOven);
            $measurement->setDatetime(new \DateTime());
            $measurement->setTemperature((mt_rand() / mt_getrandmax() * ($input->getArgument('max') - $input->getArgument('min'))) + $input->getArgument('min'));

            $this->entityManager->persist($measurement);
            $this->entityManager->flush();

            usleep($input->getArgument('interval') * 1000);
            $io->writeln("Committed measurement with temperature {$measurement->getTemperature()}");
        }

        return Command::SUCCESS;
    }
}
