<?php

namespace App\Models;

use App\Models\Code;
use App\Models\Manual;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManualsCodes extends Model
{
    use SoftDeletes;
    protected $table = 'manuals_codes';
    protected $fillable = ['note', 'manual', 'code'];

    public function manual()
    {
        return $this->belongsTo(Manual::class, 'manual');
    }

    public function code()
    {
        return $this->belongsTo(Code::class, 'code');
    }
}
