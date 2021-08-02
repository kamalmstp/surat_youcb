@extends('layouts.mst')
@section('title', 'Disposisi | '.env('APP_NAME').' - Universitas Cahaya Bangsa')
@push("styles")
<link href="{{asset('css/myCheckbox.css')}}" rel="stylesheet">
<style>
    .dataTables_filter {
        /*width: 70%;*/
        width: auto;
    }

    .modal.and.carousel {
        position: fixed;
    }

    .carousel-indicators-numbers li {
        text-indent: 0;
        margin: 0 2px;
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 100%;
        line-height: 30px;
        color: #fff;
        background-color: #999;
        transition: all 0.25s ease;
    }

    .carousel-indicators-numbers li.active,
    .carousel-indicators-numbers li:hover {
        margin: 0 2px;
        width: 30px;
        height: 30px;
        background-color: #2A3F54;
    }

    td ul,
    td ol {
        margin: 0 -2em;
    }
</style>
@endpush
@section('content')
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Disposisi Surat Masuk
                        <small id="panel_subtitle"></small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:50%">Surat Dari : <br> <strong>{{ $masuk->nama_pengirim }}</strong></td>
                                <td>Tanggal Diterima : <br> <strong>{{ date('l, d-M-Y', strtotime($masuk->created_at)) }} </strong></td>
                            </tr>
                            <tr>
                                <td>No. Surat : <br><strong>{{ $masuk->no_surat }}</strong></td>
                                <td>Kepada : <br><strong></strong> </td>
                            </tr>
                            <tr>
                                <td>Tanggal Surat : <br><strong>{{ $masuk->tgl_surat }}</strong></td>
                                <td>Sifat Surat : <br><strong>{{ $masuk->sifat_surat }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2">Perihal : <br><strong>{{ $masuk->perihal }}</strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="pull-left">
                            <a href="" type="button" class="btn btn-primary btn-sm"><i class="fa fa-history"></i> History Disposisi</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('show.surat-masuk') }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                            <a href="" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Disposisi</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row" id="history_disposisi">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->isKadin())
<div id="disposisiModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <form method="post" action="{{route('create.surat-disposisi')}}" id="form-sd">
                {{csrf_field()}}
                <input type="hidden" name="_method">
                <input type="hidden" name="sm_id" id="sm_id">
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <label for="diteruskan_kepada">Diteruskan kepada Saudara: <span class="required">*</span></label>
                            <textarea id="diteruskan_kepada" name="diteruskan_kepada" class="use-tinymce"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-5">
                            <label for="harapan">Dengan hormat harap: <span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input id="rb_ts" type="radio" class="flat" name="rb_harapan" required></span>
                                <input id="txt_ts" class="form-control" type="text" name="harapan" value="Tanggapan dan Saran" disabled>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input id="rb_pll" type="radio" class="flat" name="rb_harapan"></span>
                                <input id="txt_pll" class="form-control" type="text" name="harapan" value="Proses Lebih Lanjut" disabled>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input id="rb_kk" type="radio" class="flat" name="rb_harapan"></span>
                                <input id="txt_kk" class="form-control" type="text" name="harapan" value="Koordinasi / Konfirmasikan" disabled>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input id="rb_bsb" type="radio" class="flat" name="rb_harapan"></span>
                                <input id="txt_bsb" class="form-control" type="text" name="harapan" value="Buat Surat Balasan" disabled>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input id="rb_cust" type="radio" class="flat" name="rb_harapan"></span>
                                <input id="txt_cust" class="form-control" type="text" name="harapan" placeholder="Tulis harapan disini..." disabled>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <label for="catatan">Catatan:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-clipboard-list"></i></span>
                                <textarea id="catatan" class="form-control" name="catatan" style="resize: vertical;" placeholder="Tulis catatan disini..." rows="12"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_sd_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
@push("scripts")
<script>
</script>
@endpush