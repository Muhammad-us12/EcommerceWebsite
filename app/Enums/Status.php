<?php

namespace App\Enums;

enum Status: string
{
    case ACTIVE = 'active';
    case PENDING = 'pending';
    case SUBMIT_FOR_APPROVAL = 'submit_for_approval';
    case IN_REVIEW = 'in_review';
    case REJECTED = 'rejected';
    case DISABLED = 'disabled';
}
