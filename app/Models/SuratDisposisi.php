<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratDisposisi extends Model
{
    protected $table = 'surat_disposisis';

    protected $guarded = ['id'];

    public function getSuratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'suratmasuk_id');
    }

    public function getDari()
    {
        return $this->belongsTo(Jabatan::class, 'dari');
    }

    public function getKepada()
    {
        return $this->belongsTo(Jabatan::class, 'kepada');
    }

    public function getSuratKeluar()
    {
        return $this->hasOne(SuratKeluar::class, 'suratdisposisi_id');
    }

    public function getAgendaMasuk()
    {
        return $this->hasOne(AgendaMasuk::class, 'suratdisposisi_id');
    }
}
