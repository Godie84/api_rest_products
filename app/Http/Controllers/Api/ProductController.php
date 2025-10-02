<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

// Removed AuthorizesResources import as it's not available in Laravel 10+

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API de Productos",
 *      description="API REST para gestionar productos",
 *
 *      @OA\Contact(
 *          email="diego.reina9@hotmail.com"
 *      )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Producto",
 *     required={"name", "price", "stock"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Producto A"),
 *     @OA\Property(property="description", type="string", example="Descripción del producto"),
 *     @OA\Property(property="price", type="number", format="float", example=99.99),
 *     @OA\Property(property="stock", type="integer", example=10),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class ProductController extends Controller
{
    use ApiResponse;
    use AuthorizesRequests;

    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Obtener listado paginado de productos",
     *     tags={"Productos"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *          name="per_page",
     *          in="query",
     *          description="Número de registros por página",
     *          required=false,
     *
     *          @OA\Schema(type="integer", default=15)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Listado de productos",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Listado de productos"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *
     *                     @OA\Items(ref="#/components/schemas/Product")
     *                 ),
     *
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="total", type="integer"),
     *                 @OA\Property(property="last_page", type="integer")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(response=500, description="Error del servidor")
     * )
     */
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 15);
            $products = Product::paginate($perPage);

            return $this->successResponse($products, 'Listado de productos');
        } catch (Exception $e) {
            return $this->errorResponse('Error al obtener los productos', 500, $e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Crear un nuevo producto",
     *     tags={"Productos"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Producto creado correctamente",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Producto creado correctamente"),
     *             @OA\Property(property="data", ref="#/components/schemas/Product")
     *         )
     *     ),
     *
     *     @OA\Response(response=500, description="Error del servidor")
     * )
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());

            return $this->successResponse($product, 'Producto creado correctamente', 201);
        } catch (Exception $e) {
            return $this->errorResponse('Error al crear el producto', 500, $e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Mostrar un producto específico",
     *     tags={"Productos"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del producto",
     *          required=true,
     *
     *          @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Producto encontrado",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Producto encontrado"),
     *             @OA\Property(property="data", ref="#/components/schemas/Product")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Producto no encontrado"),
     *     @OA\Response(response=500, description="Error del servidor")
     * )
     */
    public function show(Product $product)
    {
        return $this->successResponse($product, 'Producto encontrado');
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     summary="Actualizar un producto existente",
     *     tags={"Productos"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del producto a actualizar",
     *          required=true,
     *
     *          @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Producto actualizado correctamente",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Producto actualizado correctamente"),
     *             @OA\Property(property="data", ref="#/components/schemas/Product")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Producto no encontrado"),
     *     @OA\Response(response=500, description="Error del servidor")
     * )
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->update($request->validated());

            return $this->successResponse($product, 'Producto actualizado correctamente');
        } catch (Exception $e) {
            return $this->errorResponse('Error al actualizar el producto', 500, $e->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Eliminar un producto",
     *     tags={"Productos"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del producto a eliminar",
     *          required=true,
     *
     *          @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=204,
     *         description="Producto eliminado correctamente"
     *     ),
     *     @OA\Response(response=404, description="Producto no encontrado"),
     *     @OA\Response(response=500, description="Error del servidor")
     * )
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return $this->successResponse(null, 'Producto eliminado correctamente', 204);
        } catch (Exception $e) {
            return $this->errorResponse('Error al eliminar el producto', 500, $e->getMessage());
        }
    }
}
