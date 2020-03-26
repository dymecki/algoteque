<?php

declare(strict_types = 1);

include_once '../vendor/autoload.php';

use App\Application\DistanceService;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

if ($request->getContent()) {
    (new DistanceService($request))->index()->send();
}
