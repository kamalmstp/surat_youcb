@extends('layouts.mst')
@section('title', 'Surat Keluar | '.env('APP_NAME'))
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
                    <h2>Signature Online
                        <small id="panel_subtitle">List</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        @if(Auth::user()->isPengolah())
                        <li><a id="btn_create" data-toggle="tooltip" title="Ajukan Surat" data-placement="right"><i class="fa fa-plus"></i></a></li>
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="content1">
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>File Surat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            <tr>
                                <td style="vertical-align: middle" align="center">{{$no++}}</td>
                                <td style="vertical-align: middle"></td>
                                <td style="vertical-align: middle" align="center"></td>
                                <td style="vertical-align: middle" align="center"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="x_content" id="content2" style="display: none">
                    <form method="post" action="{{route('create.surat-keluar')}}" id="form-sk">
                        {{csrf_field()}}
                        <input type="hidden" name="_method">

                        @if(Auth::user()->isPengolah())
                        <div class="col-lg-12 alert alert-danger" style="display: none;background-color: #f2dede;border-color: #ebccd1;color: #a94442;">
                            <strong>INVALID!</strong> &mdash; <span id="stats_invalid"></span>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-7 no_urut">
                                <label for="no_urut">Nomor Urut <span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                    <input id="no_urut" class="form-control" type="text" name="no_urut" placeholder="Nomor Urut">
                                </div>
                            </div>
                            <!-- <div class="col-lg-7 no_surat">
                                        <label for="no_surat">Nomor Surat <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                            <input id="no_surat" class="form-control" type="text" name="no_surat"
                                                   placeholder="kode_perihal/nomor_urut/kode_instansi/tahun" required>
                                        </div>
                                    </div> -->
                            <!-- <div class="col-lg-5 tgl_surat">
                                        <label for="tgl_surat">Tanggal Surat <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
                                            <input id="tgl_surat" class="form-control datepicker" type="text"
                                                   name="tgl_surat" placeholder="yyyy-mm-dd" required>
                                        </div>
                                    </div> -->
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-7 jenis_id">
                                <label for="jenis_id">Jenis Surat <span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-thumbtack"></i></span>
                                    <select id="jenis_id" class="form-control selectpicker" title="-- Pilih Jenis Surat --" data-live-search="true" name="jenis_id" data-max-options="1" multiple required>
                                        @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->jenis}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 sifat_surat">
                                <label for="sifat_surat">Sifat Surat <span class="required">*</span></label>
                                <div class="radio" id="sifat_surat">
                                    <label style="padding: 0 1em 0 0">
                                        <input id="penting" type="radio" class="flat" name="sifat_surat" value="penting" required> Penting</label>
                                    <label style="padding: 0 1em 0 0">
                                        <input id="rahasia" type="radio" class="flat" name="sifat_surat" value="rahasia"> Rahasia</label>
                                    <label style="padding: 0 1em 0 0">
                                        <input id="segera" type="radio" class="flat" name="sifat_surat" value="segera"> Segera</label>
                                    <label style="padding: 0 1em 0 0">
                                        <input id="sangat_segera" type="radio" class="flat" name="sifat_surat" value="sangat segera"> Sangat Segera</label>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-7 jabatan_id">
                                <label for="jabatan_id">Jabatan Pengirim<span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-thumbtack"></i></span>
                                    <select id="jabatan_id" class="form-control selectpicker" title="-- Pilih Jabatan --" data-live-search="true" name="jabatan_id" data-max-options="1" multiple required>
                                        @foreach($jabatan as $jab)
                                        <option value="{{$jab->id}}">{{$jab->jabatan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-7 klasifikasi_id">
                                <label for="klasifikasi_id">Klasifikasi Surat<span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-thumbtack"></i></span>
                                    <select id="klasifikasi_id" class="form-control selectpicker" title="-- Pilih Klasifikasi Surat --" data-live-search="true" name="klasifikasi_id" data-max-options="1" multiple required>
                                        @foreach($klasifikasi as $k)
                                        <option value="{{$k->id}}">{{$k->perihal}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-7 perihal">
                                <label for="perihal">Perihal/Keterangan Surat <span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                                    <textarea id="perihal" class="form-control" type="text" name="perihal" placeholder="Perihal" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-5 lampiran">
                                <label for="lampiran">Lampiran <span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-image"></i></span>
                                    <input id="lampiran" class="form-control" type="text" name="lampiran" placeholder="Contoh: 1 (satu)" required>
                                    <span class="input-group-addon">lembar</span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group penerima">
                            <div class="col-lg-7 kepada">
                                <label for="kepada">Kepada <span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-university"></i></span>
                                    <input id="kepada" placeholder="Kepada" type="text" class="form-control" name="kepada" required>
                                </div>
                            </div>
                            <!-- <div class="col-lg-5 kota">
                                        <label for="kota">Asal Instansi Penerima <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marked-alt"></i></span>
                                            <input id="kota" placeholder="Asal instansi penerima" type="text"
                                                   class="form-control" name="kota_penerima" required>
                                        </div>
                                    </div> -->
                        </div>

                        <div class="row form-group no_surat_penerima" style="display: none">
                            <div class="col-lg-12">
                                <label for="no_surat_penerima">Nomor Surat Penerima (PIHAK KEDUA)
                                    <span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                    <input id="no_surat_penerima" class="form-control" name="no_surat_penerima" type="text" placeholder="Nomor surat penerima / pihak kedua" required>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row form-group penerima">
                                    <div class="col-lg-7 nama">
                                        <label for="nama">Nama Penerima <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-tie"></i></span>
                                            <input id="nama" placeholder="Nama lengkap penerima" type="text"
                                                   class="form-control" name="nama_penerima" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 nip">
                                        <label for="nip">NIP Penerima</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                            <input id="nip" placeholder="NIP penerima" type="text" class="form-control"
                                                   name="nip_penerima" onkeypress="return numberOnly(event, false)">
                                        </div>
                                    </div>
                                </div> -->

                        <!-- <div class="row form-group penerima">
                                    <div class="col-lg-7 jabatan">
                                        <label for="jabatan">Jabatan Penerima</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                            <input id="jabatan" placeholder="Jabatan penerima" type="text"
                                                   class="form-control" name="jabatan_penerima">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 pangkat">
                                        <label for="pangkat">Pangkat Penerima</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
                                            <input id="pangkat" placeholder="Pangkat penerima" type="text"
                                                   class="form-control"
                                                   name="pangkat_penerima" onkeypress="return numberOnly(event, false)">
                                        </div>
                                    </div>
                                </div> -->

                        <div class="row form-group isi">
                            <div class="col-lg-12">
                                <label for="isi">Isi Surat<span class="required">*</span></label>
                                <textarea id="isi" class="use-tinymce" name="isi"></textarea>
                            </div>
                        </div>

                        <!-- <div class="row form-group tembusan">
                                    <div class="col-lg-12">
                                        <label for="tembusan">Tembusan</label>
                                        <textarea id="tembusan" class="use-tinymce" name="tembusan"></textarea>
                                    </div>
                                </div> -->
                        @endif

                        <div class="row form-group">
                            <div class="col-lg-6">
                                <button type="reset" class="btn btn-default btn-block" id="btn_sk_cancel">
                                    <strong>BATAL</strong></button>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary btn-block" id="btn_sk_submit">
                                    <strong>SUBMIT</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->isKadin())
<div id="validasiModal" class="modal fade">
    <div class="modal-dialog" style="width: 45%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <form method="post" id="form-validasi">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input id="rb_valid" type="radio" class="flat" value="3" name="rb_status" required></span>
                                <input id="txt_valid" class="form-control" type="text" value="Surat Valid" disabled>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input id="rb_invalid" type="radio" class="flat" value="2" name="rb_status"></span>
                                <textarea id="txt_invalid" class="form-control" type="text" name="catatan" placeholder="Tulis catatan disini..." disabled style="resize: vertical"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_validasi_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<div class="modal fade and carousel slide" id="lampiranModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <ol class="carousel-indicators carousel-indicators-numbers"></ol>
                <div class="carousel-inner"></div>
                <a class="left carousel-control" href="#lampiranModal" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#lampiranModal" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@push("scripts")
<script>
    $(function() {
        @if($findSurat != "")
        $(".dataTables_filter input[type=search]").val('{{$findSurat}}').trigger('keyup');
        @endif
    });

    var $indicators = '',
        $item = '',
        $no_surat = $("#no_surat");

    $("#btn_create, #btn_sk_cancel").on("click", function() {
        $("#content1").toggle(300);
        $("#content2").toggle(300);
        $("#btn_create i").toggleClass('fa-plus fa-th-list');
        $("#btn_sk_submit").html("<strong>SUBMIT</strong>");
        $("#form-sk input[name=_method]").val('');
        $("#form-sk").attr('action', '{{route('
            create.surat - keluar ')}}');

        $("#btn_create[data-toggle=tooltip]").attr('data-original-title', function(i, v) {
            return v === "Ajukan Surat" ? "Daftar Surat" : "Ajukan Surat";
        });

        $("#panel_subtitle").html(function(i, v) {
            return v === "Create Form" ? "List" : "Create Form";
        });

        $("#perihal, #nama_instansi, #kota, #nama, #jabatan, #pangkat, #nip").val('');
        $(".penerima").show(300);
        $(".penerima input").attr('required', 'required');
        $(".no_surat_penerima").hide(300);
        $("#no_surat_penerima").removeAttr('required');
        $("#jenis_id").val('default').selectpicker('refresh');
    });

    $("#jenis_id").on("change", function() {
        var val = $(this).val();
        if (val == 4 || val == 8 || val == 13 || val == 14 || val == 17 || val == 18 || val == 19 || val == 22 ||
            val == 2 || val == 3 || val == 9) {
            $(".penerima").hide(300);
            $(".penerima input").removeAttr('required', 'required');
            $(".no_surat_penerima").hide(300);
            $("#no_surat_penerima").removeAttr('required');

        } else if (val == 20) {
            $(".penerima").show(300);
            $(".penerima input").attr('required', 'required');
            $(".no_surat_penerima").show(300);
            $("#no_surat_penerima").attr('required', 'required');

        } else {
            $(".penerima").show(300);
            $(".penerima input").attr('required', 'required');
            $(".no_surat_penerima").hide(300);
            $("#no_surat_penerima").removeAttr('required');
        }
    });

    $no_surat.inputmask({
        mask: "999/999/999.999/9999",
        placeholder: "___/{{$no_urut}}/401.113/{{now()->format('Y')}}"
    });

    $no_surat.autocomplete({
        source: function(request, response) {
            $.getJSON($no_surat.val().substr(0, 3) + "/perihal", {
                name: request.term,
            }, function(data) {
                response(data);
            });
        },
        focus: function(event, ui) {
            event.preventDefault();
        },
        select: function(event, ui) {
            event.preventDefault();
            $no_surat.val(ui.item.kode);
        }
    });

    $("#lampiran").inputmask({
        mask: "9{1,2} (a{3,25})"
    });

    @if(Auth::user() - > isPengolah())
    $("#form-sk").on("submit", function(e) {
        e.preventDefault();
        if (tinyMCE.get('isi').getContent() == "") {
            swal('PERHATIAN!', 'Kolom isi surat harus diisi!', 'warning');
        } else {
            $(this)[0].submit();
        }
    });
    @endif

    $(".delete-surat").on("click", function() {
        var linkURL = $(this).attr("href");
        swal({
            title: 'Hapus Surat Keluar',
            text: 'Apakah Anda yakin? Anda tidak dapat mengembalikannya!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fa5555',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    window.location.href = linkURL;
                });
            },
            allowOutsideClick: false
        });
        return false;
    });

    function editSuratKeluar(id) {
        $("#content1").toggle(300);
        $("#content2").toggle(300);
        $("#btn_create i").toggleClass('fa-plus fa-th-list');
        $("#btn_sk_submit").html("<strong>SIMPAN PERUBAHAN</strong>");
        $("#form-sk input[name=_method]").val('PUT');
        $("#form-sk").attr('action', '{{route('
            update.surat - keluar ', ['
            id ' => '
            '])}}/' + id);

        $("#btn_create[data-toggle=tooltip]").attr('data-original-title', function(i, v) {
            return v === "Ajukan Surat" ? "Daftar Surat" : "Ajukan Surat";
        }).tooltip('show');

        $("#panel_subtitle").html(function(i, v) {
            return v === "Edit Form" ? "List" : "Edit Form";
        });
        $(".tgl_surat").removeClass('col-lg-12').addClass('col-lg-5');
        $(".jenis_id, .perihal").removeClass('col-lg-12').addClass('col-lg-7');

        $.get('{{route('
            edit.surat - keluar ', ['
            id ' => '
            '])}}/' + id,
            function(data) {
                if (data.jenis_id == 4 || data.jenis_id == 8 || data.jenis_id == 13 || data.jenis_id == 14 ||
                    data.jenis_id == 17 || data.jenis_id == 18 || data.jenis_id == 19 || data.jenis_id == 22 ||
                    data.jenis_id == 2 || data.jenis_id == 3 || data.jenis_id == 9) {
                    $(".penerima").hide(300);
                    $(".penerima input").removeAttr('required', 'required');
                    $(".no_surat_penerima").hide(300);
                    $("#no_surat_penerima").val('').removeAttr('required');

                } else if (data.jenis_id == 20) {
                    $(".penerima").show(300);
                    $(".penerima input").attr('required', 'required');
                    $(".no_surat_penerima").show(300);
                    $("#no_surat_penerima").val(data.no_surat_penerima).attr('required', 'required');

                } else {
                    $(".penerima").show(300);
                    $(".penerima input").attr('required', 'required');
                    $(".no_surat_penerima").hide(300);
                    $("#no_surat_penerima").val('').removeAttr('required');
                }

                if (data.jenis_id == 5 || data.jenis_id == 6 || data.jenis_id == 10 || data.jenis_id == 11 ||
                    data.jenis_id == 12 || data.jenis_id == 15 || data.jenis_id == 21) {
                    $(".no_surat, .tgl_surat, .jenis_id, .sifat_surat, .perihal, .lampiran, .isi, .tembusan").show(300);
                    $("#no_surat, #tgl_surat, #jenis_id, #penting, #perihal, #lampiran").attr('required', 'required');

                } else if (data.jenis_id == 7 || data.jenis_id == 16) {
                    $(".no_surat, .tgl_surat, .jenis_id, .perihal, .isi, .tembusan").show(300);
                    $(".sifat_surat, .lampiran").hide(300);
                    $("#no_surat, #tgl_surat, #jenis_id, #perihal").attr('required', 'required');
                    $("#penting, #lampiran").removeAttr('required');
                    $(".jenis_id, .perihal").removeClass('col-lg-7').addClass('col-lg-12');

                } else if (data.jenis_id == 4 || data.jenis_id == 8 || data.jenis_id == 13 || data.jenis_id == 14 ||
                    data.jenis_id == 17 || data.jenis_id == 18 || data.jenis_id == 19 || data.jenis_id == 22 ||
                    data.jenis_id == 1 || data.jenis_id == 9 || data.jenis_id == 20) {
                    $(".no_surat, .tgl_surat, .jenis_id, .perihal, .isi").show(300);
                    $(".sifat_surat, .lampiran, .tembusan").hide(300);
                    $("#no_surat, #tgl_surat, #jenis_id, #perihal").attr('required', 'required');
                    $("#penting, #lampiran").removeAttr('required');
                    $(".jenis_id, .perihal").removeClass('col-lg-7').addClass('col-lg-12');

                } else if (data.jenis_id == 2 || data.jenis_id == 3) {
                    $(".tgl_surat, .jenis_id, .perihal, .isi").show(300);
                    $(".no_surat, .sifat_surat, .lampiran, .tembusan").hide(300);
                    $("#tgl_surat, #jenis_id, #perihal").attr('required', 'required');
                    $("#no_surat, #penting, #lampiran").removeAttr('required');
                    $(".tgl_surat").removeClass('col-lg-5').addClass('col-lg-12');
                    $(".jenis_id, .perihal").removeClass('col-lg-7').addClass('col-lg-12');
                }

                $("#perihal").val(data.perihal);
                $("#nama_instansi").val(data.instansi_penerima);
                $("#kota").val(data.kota_penerima);
                $("#nama").val(data.nama_penerima);
                $("#jabatan").val(data.jabatan_penerima);
                $("#pangkat").val(data.pangkat_penerima);
                $("#nip").val(data.nip_penerima);
                $("#jenis_id").val(data.jenis_id).selectpicker('refresh');

                @if(Auth::user() - > isPengolah())
                $("#no_surat").val(data.no_surat);
                $("#tgl_surat").val(data.tgl_surat);
                $("#lampiran").val(data.lampiran);
                if (data.sifat_surat != null) {
                    $("#" + data.sifat_surat.replace(/\s/g, "_")).iCheck('check');
                }
                if (data.isi != "") {
                    tinyMCE.get('isi').setContent(data.isi);
                }
                if (data.tembusan != "") {
                    tinyMCE.get('tembusan').setContent(data.tembusan);
                }
                if (data.status == 3) {
                    $("#stats_invalid").text(data.catatan).parent().show(300);
                }
                @endif
            });
    }

    function validasiSuratKeluar(id) {
        $("#rb_valid").on("ifToggled", function() {
            if ($(this).is(":checked")) {
                $("#txt_valid").removeAttr('disabled').attr('readonly', 'readonly')
                    .css('background', '#31c2a5').css('color', '#fff').css('border-color', '#31c2a5');
                $(this).parent().parent().css('border-color', '#31c2a5');
            } else {
                $("#txt_valid").attr('disabled', 'disabled')
                    .css('background', '#eee').css('color', '#555').css('border-color', '#ccc');
                $(this).parent().parent().css('border-color', '#ccc');
            }
        });

        $("#rb_invalid").on("ifToggled", function() {
            if ($(this).is(":checked")) {
                $("#txt_invalid").removeAttr('disabled').attr('required', 'required').css('border-color', '#31c2a5');
                $(this).parent().parent().css('border-color', '#31c2a5');
            } else {
                $("#txt_invalid").removeAttr('required').attr('disabled', 'disabled').css('border-color', '#ccc');
                $(this).parent().parent().css('border-color', '#ccc');
            }
        });

        $.get('{{route('
            edit.surat - keluar ', ['
            id ' => '
            '])}}/' + id,
            function(data) {
                $("#validasiModal .modal-title").html('Validasi Surat Keluar #<strong>' + data.no_surat + '</strong>');
                $("#btn_validasi_submit").html("<strong>" + data.status == 2 ? 'SIMPAN PERUBAHAN' : 'SUBMIT' + "</strong>");
                if (data.catatan != "") {
                    $("#rb_invalid").iCheck('check');
                    $("#txt_invalid").val(data.catatan);
                } else {
                    $("#rb_valid").iCheck('check');
                    $("#txt_invalid").val('');
                }
            });

        $("#form-validasi").attr('action', '{{route('
            update.surat - keluar ', ['
            id ' => '
            '])}}/' + id);
        $("#validasiModal").modal('show');
    }

    function konfirmasiSuratKeluar(id, no_surat) {
        swal({
            title: 'Konfirmasi Pengambilan Surat',
            text: 'Apakah Anda yakin sudah mengambil surat keluar #' + no_surat + '? Anda tidak dapat mengembalikannya!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#169F85',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    window.location.href = '{{route('
                    confirm.surat - keluar ', ['
                    id ' => '
                    '])}}/' + id;
                });
            },
            allowOutsideClick: false
        });
    }

    function lihatSurat(id, surat, total, index) {
        $indicators = '';
        $item = '';

        if (total > 0) {
            $.ajax({
                url: "/surat-" + surat + "/" + id + "/files",
                type: "GET",
                success: function(data) {
                    $.each(data, function(i, val) {
                        var c = i + 1;
                        $indicators += '<li data-target="#lampiranModal" data-slide-to="' + i + '">' + c + '</li>';

                        $item += '<div class="item">' +
                            '<img src="{{asset('
                        storage / surat - ')}}' + surat + '/' + index + '/' + val + '" ' +
                            'alt="file surat"></div>';
                    });
                    $("#lampiranModal .carousel-indicators").html($indicators);
                    $("#lampiranModal .carousel-inner").html($item);
                    $('.carousel-indicators').find('li').first().addClass('active');
                    $('.carousel-inner').find('.item').first().addClass('active');
                    $("#lampiranModal").modal('show');
                },
                error: function() {
                    swal({
                        title: 'Oops..',
                        text: 'Terjadi kesalahan! Mohon refresh halaman ini.',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
        } else {
            swal('PERHATIAN!', 'File surat tidak ditemukan.', 'warning')
        }
    }
</script>
@endpush