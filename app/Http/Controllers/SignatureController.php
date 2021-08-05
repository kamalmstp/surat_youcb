<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function showSignature(Request $request)
    {
        return view('surat.signature');
    }
}
