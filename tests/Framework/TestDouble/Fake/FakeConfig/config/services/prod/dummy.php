<?php

declare(strict_types=1);

use DI\Container;
use SamihSoylu\CrunchyrollSyncer\Tests\Framework\TestDouble\Dummy\DummyObjectInterface;
use SamihSoylu\CrunchyrollSyncer\Tests\Framework\TestDouble\Dummy\DummyProdObject;

return function (Container $container) {
    $container->set(DummyObjectInterface::class, function () {
        return new DummyProdObject();
    });
};
