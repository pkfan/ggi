<?php


namespace App\Enums;

enum ClaimsTableStatus: int
{
    case REJECT = 0;
    case APPROVED = 1;
    case REJECTED = 2;

}
