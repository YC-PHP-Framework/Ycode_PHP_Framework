<?php

namespace Yc\App\Exceptions;

use Exception;
use Yc\framework\Response;

class ForbiddenException extends Exception
{

    protected $message = "You do not have Permission to access this page ";
    protected $code = Response::HTTP_FORBIDDEN;
}
