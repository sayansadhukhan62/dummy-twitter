<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{

    public static function noPermission()
    {
        return new static(403, 'Access Denied', null, []);
    }

}
