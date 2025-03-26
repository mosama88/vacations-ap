<?php

namespace App\Enum;

enum LeaveStatusEnum: string
{
    case Approved = "1";
    case Pending = "2";
    case Refused = "3";
}