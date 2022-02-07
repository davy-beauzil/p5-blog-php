<?php

declare(strict_types=1);

namespace App\Tests;

use Composer\Autoload\ClassLoader;

include_once __DIR__ . '/../vendor/autoload.php';

$classLoader = new ClassLoader();
$classLoader->addPsr4('App\\Tests\\', __DIR__, true);
$classLoader->register();
