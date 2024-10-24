<?php

namespace App\Enums;

enum UserRoles: string
{
    const ADMIN = 'admin';

    const TEACHER = 'teacher';

    const STUDENT = 'student';
}
