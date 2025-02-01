<?php

declare(strict_types=1);

function loadEnv($vendorPath)
{


    require_once($vendorPath);

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

}

session_start();