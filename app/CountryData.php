<?php

declare(strict_types=1);

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Spatie\DataTransferObject\DataTransferObject;

class CountryData extends DataTransferObject
{
    /**
     * Country code
     *
     * @var string
     */
    public string $code;

    /**
     * @var int
     */
    public int $count;
}
