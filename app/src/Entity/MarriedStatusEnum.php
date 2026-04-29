<?php

namespace App\Entity;

enum MarriedStatusEnum : string
{
    case MARRIED = 'married';
    case NOT_MARRIED = 'not_married';

    public function getRussian(): string
    {
        return match($this) {
            self::MARRIED => 'Женат',
            self::NOT_MARRIED => 'Не женат',
        };
    }


}
