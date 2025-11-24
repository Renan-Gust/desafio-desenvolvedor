<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'ref_date',
    ];

    public function content()
    {
        return $this->hasMany(Content::class);
    }
}
