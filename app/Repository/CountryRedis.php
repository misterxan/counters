<?php

declare(strict_types=1);

namespace App\Repository;


use App\CountryCollection;
use App\CountryData;
use Illuminate\Redis\RedisManager;

class CountryRedis implements Country
{
    /**
     * @var RedisManager
     */
    private RedisManager $redis;

    /**
     * Country constructor.
     * @param RedisManager $redis
     */
    public function __construct(RedisManager $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @inheritDoc
     */
    function increment(string $countryCode): int
    {
        return $this->redis->client()->hIncrBy("countries", $countryCode, 1);
    }

    /**
     * @inheritDoc
     */
    function getCounters(): CountryCollection
    {
        $prepare = [];
        $allData = $this->redis->client()->hGetAll("countries");
        foreach ($allData as $code => $counter) {
            $prepare[] = [
                'code' => $code,
                'count' => (int)$counter,
            ];
        }
        return new CountryCollection(CountryData::arrayOf($prepare));
    }
}
