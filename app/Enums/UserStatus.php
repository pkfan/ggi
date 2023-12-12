<?php


namespace App\Enums;

enum UserRole: int
{
    case SUPER_ADMIN = 0;
    case ADMIN = 1;
    case SUPERVISOR = 2;
    case EMPLOYEE = 3;
}
