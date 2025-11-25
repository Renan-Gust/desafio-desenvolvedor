<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UploadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'filename'   => $this->filename,
            'ref_date'   => $this->ref_date,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
