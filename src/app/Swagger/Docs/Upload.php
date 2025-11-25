<?php

namespace App\Swagger\Docs;

/**
 * @OA\Post(
 *     path="/upload",
 *     summary="Envia um arquivo CSV ou XLSX para processamento",
 *     tags={"Upload"},
 *     security={{"bearerAuth":{}}},
 * 
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 required={"file"},
 *                 @OA\Property(
 *                     property="file",
 *                     type="string",
 *                     format="binary",
 *                     description="Arquivo CSV ou XLSX."
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Arquivo enviado com sucesso.",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="File sent successfully.")
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
 * 
 *  @OA\Get(
 *     path="/upload",
 *     summary="Lista uploads realizados",
 *     description="Retorna lista paginada de uploads.",
 *     tags={"Upload"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="filename",
 *         in="query",
 *         required=false,
 *         description="Filtrar pelo nome do arquivo",
 *         @OA\Schema(type="string", example="InstrumentsConsolidatedFile_20251027_1")
 *     ),
 *
 *     @OA\Parameter(
 *         name="ref_date",
 *         in="query",
 *         required=false,
 *         description="Filtrar pela data de referência",
 *         @OA\Schema(type="string", format="date", example="2025-10-27")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lista de uploads retornada com sucesso.",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/UploadPagination"
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
class Upload {}
