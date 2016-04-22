<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllergiesAndDiseasesMedical extends Model
{
    protected $table = 'allergies_and_diseases_medical';
    protected $fillable = ['note', 'sideEffects', 'allergy_or_disease', 'cure'];

    public function cure()
    {
        return $this->belongsTo(Code::class, 'cure');
    }
}
