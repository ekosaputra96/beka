<?php

namespace App\Services;

use Error;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HelperService
{
    public function successWrapper($title, $message, $data = null)
    {
        return [
            'title' => $title,
            'message' => $message,
            'data' => $data
        ];
    }

    public function errorResponse($th)
    {
        $code = 500;

        if ($th instanceof Error && is_int($th->getCode())) {
            $code = ($th->getCode() >= 400 && $th->getCode() <= 500) ? $th->getCode() : 500;
        }

        throw new HttpException($code, $th->getMessage());
    }
}
