<?php


namespace App\Enums;

enum DebDiscountRequestStatus: int
{
    case PENDING = 1;
    case APPROVE = 2;
    case REJECT = 3;

    // this status applied if (approve) status is not continue further
    case DISCARD = 4;
}
