<?php

namespace App\Enum;

enum LeaveTypeEnum: string
{
    case Emergency = "1";
    case Regular = "2";
    case Annual = "3";
    case Sick = "4";
}
