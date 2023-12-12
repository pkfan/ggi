<?php


namespace App\Enums;

enum OfficerTargetStatus: int
{
    case UPCOMMING = 1;
    case ACTIVE = 2;
    case COMPLETED = 3;

    // this status applied if (approve) status is not continue further
    case EXPIRED = 4;
}
