<?php


namespace App\Enums;

enum ClaimStatus: int
{
    case NOT_STATUS_CHANGED = 0;
    case FOLLOW_UP = 1;
    case COLLECTED = 2;
    case DELAY_SETTLEMENT = 3;
    case PARTIAL_SETTLEMENT = 4;
    case TRANSFER_TO_MORROR = 5;
    case TRANSFER_TO_LAWYER = 6;
    case TRANSFER_TO_FINANCE = 7;
    case TRANSFER_TO_ELM = 8;
    case TRANSFER_TO_IC = 9;
    case CLOSE = 10;
    case COLLECTED_BY_INSURANCE = 11;
    case SEND_TO_LEGAL_DEPARTMENT = 20;
    case SEND_TO_COLLECTION_OFFICE = 21;
    case SEND_BACK_TO_SUPERVISOR = 22;
}
