<?php

declare(strict_types=1);

namespace SamihSoylu\CrunchyrollSyncer\Console\Action\CrunchyrollToNotion;

use SamihSoylu\CrunchyrollSyncer\Action\ActionInterface;
use SamihSoylu\CrunchyrollSyncer\Action\CrunchyrollToNotionSyncAction;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SyncCommand extends Command
{
    public function __construct(
        private ActionInterface $syncer,
        private string $notionDatabaseId,
    ) {
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('action:crunchyroll-to-notion:sync')
            ->setDescription('Using the Crunchyroll RSS feed up date your Notion anime page');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var CrunchyrollToNotionSyncAction $syncer */
        $syncer = $this->syncer;

        $syncer->__invoke($this->notionDatabaseId);

        return self::SUCCESS;
    }
}
