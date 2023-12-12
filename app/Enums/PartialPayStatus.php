<?php


namespace App\Enums;

enum PartialPayStatus: int
{
    case UPCOMMING = 1;
    case ACTIVE = 2;
    case PAID = 3;
    case MANUAL_PAID = 4;

}
