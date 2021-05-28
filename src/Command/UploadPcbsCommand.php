<?php

namespace App\Command;

use App\Entity\PrintedCircuitBoard;
use App\Entity\ReflowSolderingOven;
use App\Entity\SolderedPrintedCircuitBoard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UploadPcbsCommand extends Command
{
    protected static $defaultName = 'app:upload-pcbs';
    protected static $defaultDescription = 'Upload PCBs to the database';

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
            ->addArgument('interval', InputArgument::REQUIRED, 'Interval between soldered PCBs');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $reflowSolderingOvens = $this->entityManager->getRepository(ReflowSolderingOven::class)->findAll();
        $printedCircuitBoards = $this->entityManager->getRepository(PrintedCircuitBoard::class)->findAll();

        $chars = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        while (true) {
            $serialNumber = '';
            for ($i = 0; $i < 20; $i++) {
                $serialNumber .= $chars[mt_rand(0, count($chars) - 1)];
            }

            $solderedPrintedCircuitBoard = new SolderedPrintedCircuitBoard();
            $solderedPrintedCircuitBoard->setSerialNumber($serialNumber);
            $solderedPrintedCircuitBoard->setReflowSolderingOven($reflowSolderingOvens[mt_rand(0, count($reflowSolderingOvens) - 1)]);
            $solderedPrintedCircuitBoard->setPrintedCircuitBoard($printedCircuitBoards[mt_rand(0, count($printedCircuitBoards) - 1)]);
            $solderedPrintedCircuitBoard->setEntryDatetime(new \DateTime());
            sleep($input->getArgument('interval'));
            $solderedPrintedCircuitBoard->setExitDatetime(new \DateTime());

            $this->entityManager->persist($solderedPrintedCircuitBoard);
            $this->entityManager->flush();

            $io->writeln("Committed Soldered PCB with serial number {$serialNumber}");
        }

        return Command::SUCCESS;
    }
}
