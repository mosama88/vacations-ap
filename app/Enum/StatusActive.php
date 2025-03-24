<?php

namespace App\Enum;

enum StatusActive: string
{
    case Inactive = "0";
    case Active = "1";
    case Archive = "2";
}