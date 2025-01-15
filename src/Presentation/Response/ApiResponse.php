<?php
namespace App\Presentation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    public static function success(array $data = [], int $status = 200): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'data' => $data,
        ], $status);
    }

    public static function error(string $message, int $status = 400): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => $message,
        ], $status);
    }
}
