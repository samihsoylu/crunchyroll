<?php

declare(strict_types=1);

namespace SamihSoylu\Crunchyroll\Tests\Framework;

use AllowDynamicProperties;
use PHPUnit\Framework\TestCase;
use SamihSoylu\Crunchyroll\Core\Framework\Core\Kernel;
use SamihSoylu\Crunchyroll\Tests\Framework\Core\MockHttpStream;

#[AllowDynamicProperties] abstract class BaseTestCase extends TestCase
{
    private Kernel $kernel;

    protected function setUp(): void
    {
        $this->kernel = Kernel::boot();
    }

    /**
     * @template T
     *
     * @param class-string<T> $serviceId
     * @return T
     */
    public function getService(string $serviceId): object
    {
        return $this->kernel->container->get($serviceId);
    }

    public function getProjectRootDir(): string
    {
        return $this->kernel->rootDir;
    }

    public function mockHttpStream(string|bool $mockResponse): void
    {
        stream_wrapper_unregister('http');
        stream_wrapper_register('http', MockHttpStream::class);
        MockHttpStream::$mockResponse = $mockResponse;
    }

    public function restoreHttpStream(): void
    {
        stream_wrapper_restore('http');
    }
}
