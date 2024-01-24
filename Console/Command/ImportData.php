<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Console\Command;

use Magento\Framework\App\State as AppState;
use Kadoco\YouTube\Service\ImportData as ImportDataService;
use Kadoco\News\Model\NewsConfigProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportData extends Command
{
    /**
     * @var AppState
     */
    private AppState $appState;
    private ImportDataService $importData;

    public function __construct(
        AppState $appState,
        ImportDataService $importData,
        String $name = null
    ) {
        parent::__construct($name);

        $this->appState = $appState;
        $this->importData = $importData;
    }

    protected function configure()
    {
        $this->setName('kadoco:youtube')
            ->setDescription('Import latest youtube data');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $time = microtime(true);
        $this->appState->setAreaCode('adminhtml');

        $output->writeln("\t<comment>Importing youtube data</comment>");

        $this->importData->execute();
        $output->writeln("\n\t\t<comment>Importing youtube</comment>");

        $executionTime = microtime(true) - $time;
        $output->writeln("\t<comment>... completed in $executionTime seconds</comment>\n");
    }
}
