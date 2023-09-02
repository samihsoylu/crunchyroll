<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use SamihSoylu\CrunchyrollSyncer\Core\Framework\AppEnv;
use SamihSoylu\CrunchyrollSyncer\Core\Framework\Core\ContainerFactory;
use SamihSoylu\CrunchyrollSyncer\Tests\Framework\TestDouble\Dummy\DummyObjectInterface;
use SamihSoylu\CrunchyrollSyncer\Tests\Framework\TestDouble\Dummy\DummyProdObject;
use SamihSoylu\CrunchyrollSyncer\Tests\Framework\TestDouble\Dummy\DummyTestObject;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

it('should create a container', function () {
    $configDir = testKit()->getTestDoubleDir() . '/Fake/FakeConfig/config';

    $containerFactory = new ContainerFactory($configDir, AppEnv::TEST);
    $container = $containerFactory->create();

    expect($container)->toBeInstanceOf(ContainerInterface::class);
});

it('should load container configurations based on the app environment', function ($environment, $expectedInstance) {
    $configDir = testKit()->getTestDoubleDir() . '/Fake/FakeConfig/config';

    $containerFactory = new ContainerFactory($configDir, $environment);
    $container = $containerFactory->create();

    $dummyObject = $container->get(DummyObjectInterface::class);
    expect($dummyObject)->toBeInstanceOf($expectedInstance);
})->with([
    [AppEnv::TEST, DummyTestObject::class],
    [AppEnv::PROD, DummyProdObject::class],
]);

it('should throw exception when config dir does not exist', function () {
    $containerFactory = new ContainerFactory(testKit()->getTestDoubleDir(), AppEnv::TEST);
    $container = $containerFactory->create();
})->throws(DirectoryNotFoundException::class);

it('should throw exception when configurator is not callable', function () {
    $configDir = testKit()->getTestDoubleDir() . '/Fake/FakeConfig/invalidConfig';

    $containerFactory = new ContainerFactory($configDir, AppEnv::TEST);
    $containerFactory->create();
})->throws(LogicException::class);
