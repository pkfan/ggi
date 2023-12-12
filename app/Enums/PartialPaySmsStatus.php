<?php


namespace App\Enums;

enum PartialPaySmsStatus: int
{
    case SMS_NOT_SEND = 1;
    case SMS_SENT = 2;
    case ERROR_SENDING_SMS = 3;

}
