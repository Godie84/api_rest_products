<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Operaciones de autenticación"
 * )
 */
class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Iniciar sesión y devolver token
     *
     * @OA\Post(
     *     path="/api/login",
     *     summary="Iniciar sesión",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="usuario@correo.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inicio de sesión exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string"),
     *             @OA\Property(property="user", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciales inválidas"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error durante el login"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials)) {
            return $this->errorResponse('Credenciales inválidas', 401);
        }

        try {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;

            return $this->successResponse([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user, // opcional: puedes quitarlo si quieres
            ], 'Inicio de sesión exitoso');
        } catch (Exception $e) {
            return $this->errorResponse('Error durante el login', 500, $e->getMessage());
        }
    }

    /**
     * Cerrar sesión (elimina el token actual)
     *
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Cerrar sesión",
     *     tags={"Auth"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Sesión cerrada correctamente"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No se encontró un token válido para cerrar sesión"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al cerrar sesión"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            $token = $user?->currentAccessToken();

            if ($token instanceof PersonalAccessToken) {
                $token->delete();

                return $this->successResponse(null, 'Sesión cerrada correctamente');
            }

            return $this->errorResponse('No se encontró un token válido para cerrar sesión', 400);
        } catch (Exception $e) {
            return $this->errorResponse('Error al cerrar sesión', 500, $e->getMessage());
        }
    }
}
