<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $guarded = ['id'];

    public function getPejabatDari()
    {
        return $this->hasOne(SuratDisposisi::class, 'dari');
    }

    public function getPejabatKepada()
    {
        return $this->hasOne(SuratDisposisi::class, 'kepada');
    }
}
