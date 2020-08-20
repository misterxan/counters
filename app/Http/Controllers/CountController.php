<?php

namespace App\Http\Controllers;

use App\Repository\Country;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CountController extends Controller
{

    /**
     * @var Country
     */
    private Country $countryRepository;

    /**
     * Create a new controller instance.
     *
     * @param Country $countryRepository
     */
    public function __construct(Country $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param string $countryCode
     * @return Response
     */
    public function incrementCount(string $countryCode): Response
    {
        $this->countryRepository->increment($countryCode);
        return new \Illuminate\Http\Response('', Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function getCount(): JsonResponse
    {
        $result = $this->countryRepository->getCounters();
        return new JsonResponse($result->toArray(), Response::HTTP_OK);
    }
}
