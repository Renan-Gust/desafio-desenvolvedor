<?php

namespace App\Swagger\Docs;

/**
 *  @OA\Post(
 *     path="/user/create",
 *     summary="Cria um novo usuário",
 *     description="Registra um usuário e retorna um token de autenticação.",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="Renan"),
 *             @OA\Property(property="email", type="string", example="renan@example.com"),
 *             @OA\Property(property="password", type="string", example="123456")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Usuário criado com sucesso.",
 *         @OA\JsonContent(ref="#/components/schemas/AuthToken")
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação.",
 *         @OA\JsonContent(ref="#/components/schemas/ValidationError")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error.",
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 *  )
 * 
 *  @OA\Post(
 *     path="/user/login",
 *     summary="Realiza login",
 *     description="Valida credenciais e retorna um token de autenticação.",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *             @OA\Property(property="email", type="string", example="renan@example.com"),
 *             @OA\Property(property="password", type="string", example="123456")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Login bem-sucedido.",
 *         @OA\JsonContent(ref="#/components/schemas/AuthToken")
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Credenciais inválidas.",
 *         @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example="false"),
 *              @OA\Property(property="message", type="string", example="Invalid credentials."),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação.",
 *         @OA\JsonContent(ref="#/components/schemas/ValidationError")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error.",
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 *  )
 */
class Auth {}
