<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'resource_tags';

    protected $fillable = [
        'resource_id',
        'tag_name'
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}