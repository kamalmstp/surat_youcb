<?php

namespace App\Http\Controllers;

use App\Models\SuratDisposisi;
use App\Models\SuratMasuk;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposisiController extends Controller
{
    //
    public function index($id)
    {
        $masuk = SuratMasuk::find(decrypt($id));
        $disposisi = SuratDisposisi::where('suratmasuk_id', decrypt($id))->get();
        $jabatan = Jabatan::all();
        return view('surat.disposisi', compact('masuk', 'disposisi', 'jabatan'));
    }
}
