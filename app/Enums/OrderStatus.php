<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case INPROGRESS = 'inprogress';
    case DISPATCH = 'dispatch';
    case DELIVERED = 'delivered';
    case COMPLETE = 'complete';
}
