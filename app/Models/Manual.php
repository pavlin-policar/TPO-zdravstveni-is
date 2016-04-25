<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $table = 'manuals';
    protected $fillable = [
        'name',
        'description',
        'url_link',
    ];
}
