<?php

namespace App\Enums;

enum UserRoles: string
{
    case ADMIN = 'admin';
    case VENDOR = 'vendor';
    case CUSTOMER = 'customer';
}
