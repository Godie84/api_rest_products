<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Respuesta exitosa
     */
    protected function successResponse($data = null, $message = 'Operación exitosa', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Respuesta de error
     */
    protected function errorResponse($message = 'Error de servidor', $code = 500, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
