<?php

namespace App\Swagger\Docs;

/**
 *  @OA\Get(
 *     path="/upload/content",
 *     summary="Busca conteúdo dos arquivos importados",
 *     description="Retorna registros importados dos arquivos CSV/XLSX",
 *     tags={"Content"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="TckrSymb",
 *         in="query",
 *         required=false,
 *         description="Busca pelo símbolo (ticker)",
 *         @OA\Schema(type="string", example="AMZO34")
 *     ),
 *
 *     @OA\Parameter(
 *         name="RptDt",
 *         in="query",
 *         required=false,
 *         description="Busca pela data de referência",
 *         @OA\Schema(type="string", format="date", example="2024-08-22")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Resultados encontrados.",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/ContentPagination"
 *             )
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
class Content {}
