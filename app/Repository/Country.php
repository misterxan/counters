<?php


namespace App\Repository;


use App\CountryCollection;
use App\CountryData;

interface Country
{
    /**
     * @param string $countryCode
     * @return int
     */
    function increment(string $countryCode): int;

    /**
     * @return CountryCollection
     */
    function getCounters(): CountryCollection;
}
