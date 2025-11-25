<?php

namespace App\Swagger;

/**
 *  @OA\Info(
 *     version="1.0.0",
 *     title="API - Desafio Oliveira Trust",
 *     description="Documentação da API de upload e consulta de arquivos CSV/XLSX."
 *  )
 *
 *  @OA\Server(
 *     url="/api",
 *     description="API base"
 *  )
 *
 *  @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 *  )
 */
class SwaggerController {}
