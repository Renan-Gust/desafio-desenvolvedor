<?php

namespace App\Swagger\Docs;

/**
 *  @OA\Schema(
 *     schema="ValidationError",
 *     type="object",
 *     description="Resposta padrão de erro de validação do Laravel.",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         example="The given data was invalid."
 *     ),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         description="Lista de erros por campo",
 *
 *         additionalProperties=@OA\Schema(
 *             type="array",
 *             @OA\Items(
 *                 type="string",
 *                 example="The field is required."
 *             )
 *         )
 *     )
 *  )
 *
 *  @OA\Schema(
 *     schema="Error500",
 *     type="object",
 *     description="Internal server error.",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         example="Internal server error."
 *     )
 *  )
 * 
 *  @OA\Schema(
 *     schema="UploadPagination",
 *     type="object",
 *     description="Estrutura padrão de paginação do Laravel",
 *
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/UploadResource")
 *     ),
 *     @OA\Property(property="from", type="integer", example=1),
 *     @OA\Property(property="last_page", type="integer", example=5),
 *     @OA\Property(property="per_page", type="integer", example=20),
 *     @OA\Property(property="to", type="integer", example=20),
 *     @OA\Property(property="total", type="integer", example=100)
 *  )
 * 
 *  @OA\Schema(
 *     schema="ContentPagination",
 *     type="object",
 *     description="Estrutura padrão de paginação do Laravel",
 *
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/ContentResource")
 *     ),
 *     @OA\Property(property="from", type="integer", example=1),
 *     @OA\Property(property="last_page", type="integer", example=10),
 *     @OA\Property(property="per_page", type="integer", example=100),
 *     @OA\Property(property="to", type="integer", example=100),
 *     @OA\Property(property="total", type="integer", example=50000)
 *  )
 *
 *  @OA\Schema(
 *     schema="UploadResource",
 *     type="object",
 *     description="Representação de um upload de arquivo",
 *     @OA\Property(
 *         property="filename",
 *         type="string",
 *         example="InstrumentsConsolidatedFile_20251027_1.csv"
 *     ),
 *     @OA\Property(
 *         property="ref_date",
 *         type="string",
 *         format="date",
 *         nullable=true,
 *         example="2025-10-27"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-11-24 12:34:56"
 *     )
 *  )
 *
 *  @OA\Schema(
 *     schema="ContentResource",
 *     type="object",
 *     description="Linha de conteúdo importada do arquivo (CSV/XLSX)",
 *     @OA\Property(
 *         property="RptDt",
 *         type="string",
 *         format="date",
 *         example="2024-08-22"
 *     ),
 *     @OA\Property(
 *         property="TckrSymb",
 *         type="string",
 *         example="AMZO34"
 *     ),
 *     @OA\Property(
 *         property="MktNm",
 *         type="string",
 *         nullable=true,
 *         example="EQUITY-CASH"
 *     ),
 *     @OA\Property(
 *         property="SctyCtgyNm",
 *         type="string",
 *         nullable=true,
 *         example="BDR"
 *     ),
 *     @OA\Property(
 *         property="ISIN",
 *         type="string",
 *         nullable=true,
 *         example="BRAMZOBDR002"
 *     ),
 *     @OA\Property(
 *         property="CrpnNm",
 *         type="string",
 *         nullable=true,
 *         example="AMAZON.COM, INC"
 *     ),
 *     @OA\Property(
 *         property="filename",
 *         type="string",
 *         example="InstrumentsConsolidatedFile_20251027_1.csv"
 *     )
 *  )
 * 
 *  @OA\Schema(
 *     schema="AuthToken",
 *     type="object",
 *     description="Resposta com token de autenticação Sanctum.",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="token", type="string", example="1|Jd92838dj29d9d9dsj2j92d9d2d92d92d92"),
 *     @OA\Property(property="type", type="string", example="Bearer")
 *  )
 */
class Schemas {}
