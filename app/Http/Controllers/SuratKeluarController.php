<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\JenisSurat;
use App\Models\SuratKeluar;
use App\Models\User;
use App\Models\Jabatan;
use App\Support\Role;
use App\Models\PerihalSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKeluarController extends Controller
{
    public function showSuratKeluar(Request $request)
    {
        $keluars = SuratKeluar::orderByDesc('id')->get();
        $types = JenisSurat::all();
        $jabatan = Jabatan::all();
        $no_urut = str_pad(SuratKeluar::count() + 1, 3, '0', STR_PAD_LEFT);
        $klasifikasi = PerihalSurat::all();
        $findSurat = $request->q;

        return view('surat.keluar', compact('keluars', 'types', 'no_urut', 'klasifikasi', 'jabatan', 'findSurat'));
    }

    public function pdfSuratKeluar($id)
    {
        $kadin = User::where('role', Role::KADIN)->first();
        $sk = SuratKeluar::find(decrypt($id));

        if ($sk->jenis_id == 5 || $sk->jenis_id == 6 || $sk->jenis_id == 10 ||
            $sk->jenis_id == 11 || $sk->jenis_id == 12 || $sk->jenis_id == 15 || $sk->jenis_id == 21) {
            return view('surat.template-sk.nd-npkn-sb-si-sk-spgl-su', compact('sk', 'kadin'));

        } elseif ($sk->jenis_id == 7 || $sk->jenis_id == 16) {
            return view('surat.template-sk.pe-spgt', compact('sk', 'kadin'));

        } elseif ($sk->jenis_id == 4 || $sk->jenis_id == 8 || $sk->jenis_id == 13 ||
            $sk->jenis_id == 14 || $sk->jenis_id == 17 || $sk->jenis_id == 18 ||
            $sk->jenis_id == 19 || $sk->jenis_id == 22) {
            return view('surat.template-sk.m-r-skmt-sku-sp-spt-sppd-ts', compact('sk', 'kadin'));

        } elseif ($sk->jenis_id == 1) {
            return view('surat.template-sk.ba', compact('sk', 'kadin'));

        } elseif ($sk->jenis_id == 2 || $sk->jenis_id == 3) {
            return view('surat.template-sk.dh-lap', compact('sk', 'kadin'));

        } elseif ($sk->jenis_id == 9) {
            return view('surat.template-sk.ser', compact('sk', 'kadin'));

        } elseif ($sk->jenis_id == 20) {
            return view('surat.template-sk.mou', compact('sk', 'kadin'));
        }
    }

    public function wordSuratKeluar($id)
    {
        $sk = SuratKeluar::find(decrypt($id));

        if($sk->jenis_id == 1){
            $file = public_path('surat/template/edaran.docx');
            $document = new \PhpOffice\PhpWord\TemplateProcessor($file);

            $jabatan = Jabatan::find($sk->jabatan_id);
            $klasifikasi = PerihalSurat::find($sk->perihal_id);

            // $qr = \QrCode::size(100)->format('png')->generate('https://youcb.ac.id');

            $t1 = $jabatan->jabatan;
            $t2 = $sk->no_urut;
            $t3 = $jabatan->kode;
            $t4 = $klasifikasi->kode;
            $t5 = $sk->perihal;
            $t6 = $sk->kepada;
            $t7 = $sk->isi;
            $t8 = $sk->tgl_surat;
            $t9 = $jabatan->nama_pejabat;
            $t10 = $jabatan->nidn;

            $document->setValues(array(
                'JABATAN' => $t1,
                'NO_URUT' => $t2,
                'KODE_JABATAN' => $t3,
                'KODE_KLASIFIKASI' => $t4,
                'TAHUN' => date("Y", strtotime($sk->tgl_surat)),
                'TENTANG' => $t5,
                'KEPADA' => $t6,
                'ISI' => $t7,
                'TANGGAL_DIBUAT' => $t8,
                'NAMA_PEJABAT' => $t9,
                'NIDN' => $t10,
            ));
            $document->setImageValue('QR', public_path('surat/qr/qr.png'));

            $nama_file = public_path('surat/tmp/Surat Edaran '.$jabatan->jabatan.' '.$sk->tgl_surat.'.docx');
            // SuratKeluar::create([

            // ]);
            $document->saveAs($nama_file);
            return response()->download($nama_file);
        }
    }

    public function createSuratKeluar(Request $request)
    {
        $sk = SuratKeluar::create([
            'user_id' => Auth::id(),
            'jenis_id' => $request->jenis_id,
            'no_surat_penerima' => $request->no_surat_penerima,
            'instansi_penerima' => $request->instansi_penerima,
            'kota_penerima' => $request->kota_penerima,
            'nama_penerima' => $request->nama_penerima,
            'jabatan_penerima' => $request->jabatan_penerima,
            'pangkat_penerima' => $request->pangkat_penerima,
            'nip_penerima' => $request->nip_penerima,
            'perihal' => $request->perihal,
            'status' => 0,
        ]);

        return back()->with('success', 'Surat keluar (' . $sk->getJenisSurat->jenis . ') berhasil dibuat!');
    }

    public function editSuratKeluar($id)
    {
        return SuratKeluar::find($id);
    }

    public function updateSuratKeluar(Request $request)
    {
        $sk = SuratKeluar::find($request->id);
        if (Auth::user()->isPegawai()) {
            $sk->update([
                'user_id' => Auth::id(),
                'jenis_id' => $request->jenis_id,
                'no_surat_penerima' => $request->no_surat_penerima,
                'instansi_penerima' => $request->instansi_penerima,
                'kota_penerima' => $request->kota_penerima,
                'nama_penerima' => $request->nama_penerima,
                'jabatan_penerima' => $request->jabatan_penerima,
                'pangkat_penerima' => $request->pangkat_penerima,
                'nip_penerima' => $request->nip_penerima,
                'perihal' => $request->perihal,
                'status' => 0,
            ]);

            return back()->with('success', 'Surat keluar (' . $sk->getJenisSurat->jenis . ') berhasil diperbarui!');

        } elseif (Auth::user()->isPengolah()) {
            $date = date('Y-m-d');
            $jab = Jabatan::where('id', $request->jabatan_id);
            $kla = PerihalSurat::where('id', $request->perihal_id);
            $kd_jab = $jab->kode;
            $kd_kla = $kla->kode;
            $no_surat = $request->no_urut.'/'.$kd_jab.'/'.$kd_kla.'/'.date("Y");
            // var_dump($no_surat);
            $sk->update([
                'nama_pengolah' => Auth::user()->name,
                'tgl_surat' => $date,
                'no_urut' => $request->no_urut,
                'jabatan_id' => $request->jabatan_id,
                'perihal_id' => $request->klasifikasi_id,
                'kepada' => $request->kepada,
                'perihal' => $request->perihal,
                'isi' => $request->isi,
                'no_surat' => $no_surat,
                'sifat_surat' => $request->sifat_surat,
                'lampiran' => $request->lampiran . ' lembar',
                'isi' => $request->isi,
                'tembusan' => $request->tembusan,
                'status' => 1,
            ]);

            return back()->with('success', 'Surat keluar #' . $sk->no_surat . ' berhasil diperbarui!');

        } elseif (Auth::user()->isKadin()) {
            $sk->update([
                'status' => $request->rb_status,
                'catatan' => $request->catatan,
            ]);

            $status = $sk->status == 2 ? 'divalidasi!' : 'diperbarui!';
            return back()->with('success', 'Surat keluar #' . $sk->no_surat . ' berhasil ' . $status);
        }
    }

    public function deleteSuratKeluar($id)
    {
        $sk = SuratKeluar::find(decrypt($id));
        $sk->delete();

        return back()->with('success', 'Surat keluar (' . $sk->getJenisSurat->jenis . ') berhasil dihapus!');
    }

    public function konfirmasiSuratKeluar($id)
    {
        $sk = SuratKeluar::find($id);
        $sk->update(['status' => 5]);

        return back()->with('success', 'Pengambilan surat keluar #' . $sk->no_surat . ' berhasil dikonfirmasi!');
    }
}
