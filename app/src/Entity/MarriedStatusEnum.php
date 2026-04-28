<?php

namespace App\Entity;

enum MarriedStatusEnum : string
{
    case MARRIED = 'женат';
    case NOT_MARRIED = 'не женат';
}
