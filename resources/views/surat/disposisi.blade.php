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
                        <!-- <div class="pull-left">
                            <a href="" type="button" class="btn btn-primary btn-sm"><i class="fa fa-history"></i> History Disposisi</a>
                        </div> -->
                        <div class="pull-right">
                            <a href="{{ route('show.surat-masuk') }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="disposisiSurat('{{$masuk->id}}','{{$masuk->no_surat}}','create')"><i class="fa fa-plus"></i> Tambah Disposisi</button>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <br>
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Disposisi Oleh</th>
                                <th>Diteruskan Kepada</th>
                                <th>Dengan Hormat</th>
                                <th>Catatan Disposisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1 @endphp
                            @foreach($disposisi as $dsp)
                            <tr>
                                <td style="vertical-align: middle" align="center">{{$no++}}</td>
                                <td>
                                    <strong>
                                        <p>{{$dsp->getDari->jabatan}}</p>
                                    </strong>
                                    {{$dsp->getDari->nama_pejabat}}
                                </td>
                                <td>
                                    <strong>{{$dsp->getKepada->jabatan}}</strong>
                                    <p>{{$dsp->getKepada->nama_pejabat}}</p>
                                </td>
                                <td>
                                    {{$dsp->harapan}}
                                </td>
                                <td>{{$dsp->catatan}}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            <!-- <textarea id="diteruskan_kepada" name="diteruskan_kepada" class="use-tinymce"></textarea> -->

                            <div class="input-group">
                                <select name="kepada" id="kepada" class="form-control" required>
                                    <option value="">--Diteruskan Kepada--</option>
                                    @foreach($jabatan as $jbt)
                                    <option value="{{$jbt->id}}">{{$jbt->jabatan}}</option>
                                    @endforeach
                                </select>
                            </div>

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
    function disposisiSurat(id, no_surat, method) {
        var $form = $("#form-sd");
        $("#sm_id").val(id);

        $("#rb_ts").on("ifToggled", function() {
            if ($(this).is(":checked")) {
                $("#txt_ts").removeAttr('disabled').attr('readonly', 'readonly')
                    .css('color', '#31c2a5').css('border-color', '#31c2a5');
                $(this).parent().parent().css('border-color', '#31c2a5');
            } else {
                $("#txt_ts").attr('disabled', 'disabled')
                    .css('background', '#eee').css('color', '#555').css('border-color', '#ccc');
                $(this).parent().parent().css('border-color', '#ccc');
            }
        });

        $("#rb_pll").on("ifToggled", function() {
            if ($(this).is(":checked")) {
                $("#txt_pll").removeAttr('disabled').attr('readonly', 'readonly')
                    .css('color', '#31c2a5').css('border-color', '#31c2a5');
                $(this).parent().parent().css('border-color', '#31c2a5');
            } else {
                $("#txt_pll").attr('disabled', 'disabled')
                    .css('background', '#eee').css('color', '#555').css('border-color', '#ccc');
                $(this).parent().parent().css('border-color', '#ccc');
            }
        });

        $("#rb_kk").on("ifToggled", function() {
            if ($(this).is(":checked")) {
                $("#txt_kk").removeAttr('disabled').attr('readonly', 'readonly')
                    .css('color', '#31c2a5').css('border-color', '#31c2a5');
                $(this).parent().parent().css('border-color', '#31c2a5');
            } else {
                $("#txt_kk").attr('disabled', 'disabled')
                    .css('background', '#eee').css('color', '#555').css('border-color', '#ccc');
                $(this).parent().parent().css('border-color', '#ccc');
            }
        });

        $("#rb_bsb").on("ifToggled", function() {
            if ($(this).is(":checked")) {
                $("#txt_bsb").removeAttr('disabled').attr('readonly', 'readonly')
                    .css('background', '#31c2a5').css('color', '#fff').css('border-color', '#31c2a5');
                $(this).parent().parent().css('border-color', '#31c2a5');
            } else {
                $("#txt_bsb").attr('disabled', 'disabled')
                    .css('background', '#eee').css('color', '#555').css('border-color', '#ccc');
                $(this).parent().parent().css('border-color', '#ccc');
            }
        });

        $("#rb_cust").on("ifToggled", function() {
            if ($(this).is(":checked")) {
                $("#txt_cust").val('').removeAttr('disabled').attr('required', 'required').css('border-color', '#31c2a5');
                $(this).parent().parent().css('border-color', '#31c2a5');
            } else {
                $("#txt_cust").val('').removeAttr('required').attr('disabled', 'disabled').css('border-color', '#ccc');
                $(this).parent().parent().css('border-color', '#ccc');
            }
        });

        if (method == 'create') {
            $("#disposisiModal .modal-title").html('Buat Disposisi Surat Masuk #<strong>' + no_surat + '</strong>');
            $("#btn_sd_submit").html("<strong>Submit</strong>");
            $("#form-sd input[name=_method]").val('');
            $form.attr('action', '{{route("create.surat-disposisi")}}');



        } else if (method == 'update') {
            $("#disposisiModal .modal-title").html('Edit Disposisi Surat Masuk #<strong>' + no_surat + '</strong>');
            $("#btn_sd_submit").html("<strong>Simpan Perubahan</strong>");
            $("#form-sd input[name=_method]").val('PUT');
            $form.attr('action', '{{route("update.surat-disposisi" , ["id" => ""])}}/' + id);

            $.get('{{route("edit.surat-disposisi", ["id" => ""])}}/' + id,
                function(data) {
                    $("#catatan").val(data.catatan);

                    if (data.harapan == 'Tanggapan dan Saran') {
                        $("#rb_ts").iCheck('check');
                        $("#txt_ts").removeAttr('disabled').attr('readonly', 'readonly');
                        $("#txt_pll, #txt_kk, #txt_bsb").attr('disabled', 'disabled');
                        $("#txt_cust").removeAttr('required').attr('disabled', 'disabled');

                    } else if (data.harapan == 'Proses Lebih Lanjut') {
                        $("#rb_pll").iCheck('check');
                        $("#txt_pll").removeAttr('disabled').attr('readonly', 'readonly');
                        $("#txt_ts, #txt_kk, #txt_bsb").attr('disabled', 'disabled');
                        $("#txt_cust").removeAttr('required').attr('disabled', 'disabled');

                    } else if (data.harapan == 'Koordinasi / Konfirmasikan') {
                        $("#rb_kk").iCheck('check');
                        $("#txt_kk").removeAttr('disabled').attr('readonly', 'readonly');
                        $("#txt_ts, #txt_pll, #txt_bsb").attr('disabled', 'disabled');
                        $("#txt_cust").removeAttr('required').attr('disabled', 'disabled');

                    } else if (data.harapan == 'Buat Surat Balasan') {
                        $("#rb_bsb").iCheck('check');
                        $("#txt_bsb").removeAttr('disabled').attr('readonly', 'readonly');
                        $("#txt_ts, #txt_pll, #txt_kk").attr('disabled', 'disabled');
                        $("#txt_cust").removeAttr('required').attr('disabled', 'disabled');

                    } else {
                        $("#rb_cust").iCheck('check');
                        $("#txt_cust").val(data.harapan).removeAttr('disabled').attr('required', 'required');
                        $("#txt_ts, #txt_pll, #txt_kk, #txt_bsb").attr('disabled', 'disabled');
                    }
                });
        }

        $form.on("submit", function(e) {
            e.preventDefault();

            $(this)[0].submit();
        });

        $("#disposisiModal").modal('show');
    }
</script>
@endpush