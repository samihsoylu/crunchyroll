<?php

declare(strict_types=1);

namespace Samihsoylu\Crunchyroll\Tests\TestDouble\Fake;

use Samihsoylu\Crunchyroll\Api\Crunchyroll\Entity\AnimeEpisode;
use Samihsoylu\Crunchyroll\Api\Crunchyroll\Repository\AnimeEpisodeRepositoryInterface;

final class FakeAnimeEpisodeRepository implements AnimeEpisodeRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getLatestEpisodes(): array
    {
        return [
            AnimeEpisode::fromArray([
                'title' => 'Blah',
                'link' => 'http://crunchyroll.com/blah/',
                'description' => '',
                'seriesTitle' => 'Blah',
                'episodeTitle' => 'Blah One',
                'episodeNumber' => 1,
                'seasonNumber' => 1,
                'duration' => '60',
                'publisher' => 'Samih',
                'publishedDate' => '2022-03-02 10:03:04',
            ])
        ];
    }
}