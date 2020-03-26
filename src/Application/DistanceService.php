<?php

declare(strict_types = 1);

namespace App\Application;

use App\Domain\Model\Distance\Distances;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class DistanceService
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(): JsonResponse
    {
        $data      = $this->jsonDecode($this->request->getContent());
        $distances = Distances::fromArray($data->distances);
        $result    = null;

        if ($data->response_unit === 'Meters') {
            $result = $distances->meters();
        }
        elseif ($data->response_unit === 'Yards') {
            $result = $distances->meters()->toYards();
        }

        return new JsonResponse(['success' => true, 'data' => $result]);
    }

    private function jsonDecode(string $json): \stdClass
    {
        return json_decode($json, false, 512, JSON_THROW_ON_ERROR);
    }
}