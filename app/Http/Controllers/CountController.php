<?php

namespace App\Http\Controllers;

use App\Http\Middleware\JsonRequestMiddleware;
use App\Repository\Country;
use App\Rule\LowerCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $this->middleware(JsonRequestMiddleware::class);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function incrementCount(Request $request): Response
    {
        $this->validate(
            $request, [
                'country_code' => ['required', 'string', new LowerCase()],
            ]
        );
        $countryCode = $request->get('country_code');
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
