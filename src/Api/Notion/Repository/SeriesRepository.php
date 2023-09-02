<?php

declare(strict_types=1);

namespace SamihSoylu\CrunchyrollSyncer\Api\Notion\Repository;

use Notion\Notion;
use Notion\Pages\Page;
use SamihSoylu\CrunchyrollSyncer\Api\Notion\Entity\Serie;
use SamihSoylu\CrunchyrollSyncer\Api\Notion\Entity\SerieInterface;

final readonly class SeriesRepository implements SeriesRepositoryInterface
{
    public function __construct(
        private Notion $notion
    ) {
    }

    /**
     * @return SerieInterface[]
     */
    public function getAll(string $databaseId): array
    {
        $database = $this->notion->databases()->find($databaseId);

        return array_map(function (Page $page) {
            return Serie::fromApiPage($page);
        }, $this->notion->databases()->queryAllPages($database));
    }

    public function update(SerieInterface $serie): void
    {
        $this->notion->pages()->update($serie->toApiPage());
    }
}
