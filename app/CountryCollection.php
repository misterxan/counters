<?php

declare(strict_types=1);

namespace App;

use Spatie\DataTransferObject\DataTransferObjectCollection;

class CountryCollection extends DataTransferObjectCollection
{
    public function current(): CountryData
    {
        return parent::current();
    }
}
