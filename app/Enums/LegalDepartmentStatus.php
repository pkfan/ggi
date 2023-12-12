<?php


namespace App\Enums;

enum LegalDepartmentStatus: int
{
    case PENDING = 0;
    case APPROVE = 1;
    case COURT_VERDICT_ISSUED_NO = 2;
    case COURT_VERDICT_ISSUED_YES = 3;
    case SHOW = 4;
    case REJECT=5;


}
