<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerihalSurat extends Model
{
    protected $table = 'perihal_surats';

    protected $guarded = ['id'];

    public function getSuratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'perihal_id');
    }
}
