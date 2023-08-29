<?php

declare(strict_types=1);

namespace SamihSoylu\Crunchyroll\Tests\Framework\Builder;

use Notion\Databases\Properties\SelectOption;
use Notion\Pages\Page;
use SamihSoylu\Crunchyroll\Api\Notion\Entity\Field\Episode;
use SamihSoylu\Crunchyroll\Api\Notion\Entity\Option\EpisodeStatus;
use SamihSoylu\Crunchyroll\Api\Notion\Entity\Serie;
use SamihSoylu\Crunchyroll\Tests\Framework\TestDouble\Fake\FakeSerie;

final class FakeSerieBuilder
{
    private string $name;
    private Episode $currentEpisode;
    private Episode $previousEpisode;
    private string $currentEpisodeUrl;
    private SelectOption $currentEpisodeStatus;

    public function __construct()
    {
        $this->setDefaults();
    }

    private function setDefaults(): void
    {
        $this->name = 'Naruto';
        $this->currentEpisode = new Episode(1, 2);
        $this->previousEpisode = new Episode(1, 1);
        $this->currentEpisodeUrl = 'https://crunchyroll.com/naruto/s1/e2';
        $this->currentEpisodeStatus = EpisodeStatus::newEpisode();
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withCurrentEpisode(Episode $currentEpisode): self
    {
        $this->currentEpisode = $currentEpisode;

        return $this;
    }

    public function withPreviousEpisode(Episode $previousEpisode): self
    {
        $this->previousEpisode = $previousEpisode;

        return $this;
    }

    public function withCurrentEpisodeUrl(string $currentEpisodeUrl): self
    {
        $this->currentEpisodeUrl = $currentEpisodeUrl;

        return $this;
    }

    public function withCurrentEpisodeStatus(SelectOption $currentEpisodeStatus): self
    {
        $this->currentEpisodeStatus = $currentEpisodeStatus;

        return $this;
    }

    public function build(): FakeSerie
    {
        return new FakeSerie(
            $this->name,
            $this->currentEpisode,
            $this->previousEpisode,
            $this->currentEpisodeUrl,
            $this->currentEpisodeStatus,
        );
    }
}