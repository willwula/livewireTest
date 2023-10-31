<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachments';

    protected $fillable = [
        'attachmentable_id',
        'attachmentable_type',
        'attachmentable_field',
        'images',
        'original_name',
        'mime_type',
        'illustrate',
        'uuid',
        'size',
    ];

    public function attachmentable(): MorphTo
    {
        return $this->morphTo();
    }
}

