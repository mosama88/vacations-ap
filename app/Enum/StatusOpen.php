<?php

namespace App\Enum;

enum StatusOpen: string
{
    case Pending = "0";
    case Open = "1";
    case Archive = "2";
}