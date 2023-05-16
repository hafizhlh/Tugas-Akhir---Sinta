@extends('layouts.main')

@section('title', 'BarangKeluar')

@section('css_page')
<!-- BEGIN VENDOR CSS-->
<!-- END VENDOR CSS-->

<!-- BEGIN Page Level CSS-->
<style>
    /* width */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #c8c8c8;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

</style>
<!-- END Page Level CSS-->
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <span class="text-muted font-weight-bold mr-4">
                    <i class="fa fa-layer-group text-success"></i>
                </span>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Barang Keluar</h5>
                <!--end::Actions-->
            </div>
            <div>
                <span class="mr-2 d-none d-lg-inline text-dark my-auto" id="time"></span>
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Notice-->
            <!--end::Notice-->
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Data Barang Keluar
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        @can('barangkeluar-C')
                        <button id="addMenu" name="addMenu" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <!--end::Svg Icon-->
                            </span>keluarkan barang</a>
                        </button>
                        @endcan
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <!--end::Svg Icon-->
                            </span>Export
                        </button>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li
                                    class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                    Choose an option:
                                </li>
                                <li class="navi-item" id="export_bulanan">
                                    <a onclick="modalBulananExport()" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i>
                                        </span>
                                        <span class="navi-text">bulanan</span>
                                    </a>
                                </li>
                                </li>
                                <li class="navi-item" >                                
                                <a onclick="modalTahunanExport()" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                        <span class="navi-text">Tahunan</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Search Form-->
                    <!--begin::Search Form-->
                    <div class="mb-7">
                        <div class="row align-items-center">
                            <div class="col-lg-9 col-xl-8">
                                <div class="row align-items-center">
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" placeholder="Search..."
                                                id="kt_datatable_search_query" />
                                            <span>
                                                <i class="flaticon2-search-1 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Search Form-->
                    <!--end: Search Form-->
                    <!--begin: Datatable-->
                    <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable_menu"></div>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<!--begin:Modal-->
<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMenuTitle">barang keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <!--begin:Form-->
            <!-- <script src="script.js"></script> -->
            <form role="form" class="form" name="formmenus" id="formmenus" enctype="multipart/formdata" method="">
                <div class="modal-body" style="height: 500px;">
                    <div class="mb-7">
                        <input type="hidden" name="user_code" id="user_code">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">NomorDOF/ E-Ticket:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nodofetiket_code" name="nodofetiket_code"
                                    placeholder="Contoh : HLP-23-01223/DOF-10571" />
                                <span class="form-text text-muted">masukan DOF(Deep Of Field)/ E-Ticket</span>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Jenis Barang:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="jenis_code" name="jenis_code">
                                    <option value="">Pilih jenis barang</option>
                                    <option value="1">Consumable</option>
                                    <option value="2">Asset</option>
                                </select>
                                <span class="form-text text-muted">Pilih jenis barang untuk menampilkan opsi
                                    barang</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Barang:</label>
                            <div class="col-lg-9">
                                <select class="form-control select2" id="barang_code" name="barang_code"
                                    style="width: 100%;">
                                    <option class="form-control" value=''>Pilih barang</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Jumlah Barang:</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                    placeholder="Contoh : 100" />
                                <span class="form-text text-muted">Masukkan Jumlah Barang</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Keterangan Barang:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="keterangan_code" name="keterangan_code"
                                    placeholder="Contoh : untuk router" />
                                <span class="form-text text-muted">Masukkan keterangan Barang</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                            class="fa fa-times"></i>Cancel
                    </button>
                    @can(['barangkeluar-C' , 'barangkeluar-U'])
                    <button type="submit" id="saveMenu" data-id="" class="btn btn-primary font-weight-bold">
                        <i class="fa fa-save"></i> Save changes
                    </button>
                    @endcan
                </div>
            </form>
            <!--end:Form-->
        </div>
    </div>
</div>


<!--end:Modal-->

<div class="modal fade" id="modalReturn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReturnTitle">Return barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <!--begin:Form-->
            <script src="script.js"></script>
            <form role="form" class="form" name="formreturn" id="formreturn" enctype="multipart/formdata" method="">
                <input type="hidden" name="id_barang_keluar" id="id_barang_keluar">

                <div class="modal-body" style="height: 500px;">
                    <div class="mb-7">
                        <input type="hidden" name="user_code" id="user_code">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">NomorDOF/ E-Ticket:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="nodof_code" name="nodofetiket_code"
                                    placeholder="Contoh : 10451 /GS-10571" disabled />
                                <span class="form-text text-muted">masukan DOF(Deep Of Field)/ E-Ticket(</span>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Jenis Barang:</label>
                            <div class="col-lg-9">

                                <input type="text" class="form-control" id="tipebarang_code" name="jenis_code" disabled>
                                <span class="form-text text-muted">Pilih jenis barang untuk menampilkan opsi
                                    barang</span>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="barang_id" name="barang_id">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Barang:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="barangdikembalikan_code" name="barang_code"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Jumlah Barang:</label>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" id="jumlahdikembalikan" name="jumlah"
                                    placeholder="Contoh : 100" />
                                <span class="form-text text-muted">Masukkan Jumlah Barang</span>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                            class="fa fa-times"></i>Cancel
                    </button>
                    @can(['barangkeluar-C' , 'barangkeluar-U'])
                    <button type="submit" id="btn_return_barang" data-id="" class="btn btn-primary font-weight-bold">
                        <i class="fa fa-reply"></i> Save changes
                    </button>
                    @endcan
                </div>
            </form>
            <!--end:Form-->
        </div>
    </div>
</div>


<!--begin:Modal-->
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInfoTitle">Informasi Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <!--begin:Form-->
            <!-- <script src="script.js"></script> -->
            <!-- <form role="form" class="form" name="formmenus" id="formmenus" enctype="multipart/formdata" method=""> -->
            <div class="modal-body" style="height: 500px;">
                <div class="mb-7">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama Pengambil Barang:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="user_code_detail" id="user_code_detail"
                                readonly>
                            <span class="form-text text-muted"></span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tgl Pengambilan:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="tgl_pengambilan" name="tgl_pengambilan"
                                readonly />
                            <span class="form-text text-muted"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">NomorDOF/ E-Ticket:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="nodofetiket_code_detail"
                                name="nodofetiket_code_detail" readonly />
                            <span class="form-text text-muted">masukan DOF(Deep Of Field)/ E-Ticket</span>
                        </div>
                    </div>
                    <!--  -->
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Barang:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="nama_code_detail" name="nama_code_detail" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Kode Barcode:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="barcode_detail" name="barcode_detail"
                                placeholder="contoh:SW.PG.abc.123.123" readonly />

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Jenis Barang:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="jenis_code_detail" name="jenis_code_detail"
                                readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Keterangan Barang:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="keterangan_code_detail" name="keterangan_code_detail"
                                readonly />

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Jumlah Barang Keluar:</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" id="jumlah_detail" name="jumlah_detail"
                                readonly />

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                        <i class="fa fa-times"></i>Cancel
                    </button>
                </div>
            </div>

        </div>
        <!--end:Form-->
    </div>
</div>



<!--end:Modal-->

<!--begin:Modal bulanan-->
<div class="modal fade" id="BulananExportkeluar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMenuTitle">Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="mb-7">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">tanggal awal:</label>
                            <div class="col-lg-9">
                            <input type='date' class="form-control" id="tgl_awal" placeholder="Select time"/>
                                <span class="form-text text-muted">Masukkan tanggal</span>
                            </div>                           
                            
                        </div>
                    </div>

                    <div class="mb-7">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">tanggal akhir:</label>
                            <div class="col-lg-9">
                            <input type='date' class="form-control" id="tgl_akhir" placeholder="Select time"/>
                                <span class="form-text text-muted">Masukkan tanggal</span>
                            </div>                           
                            
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-export_excel">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--end:Modal-->
<!--begin:Modal Tahunan-->
<div class="modal fade" id="exportTahunankeluar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMenuTitle">Barang keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="mb-7">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">apakah anda ingin membuat tahun ini?</label>         
                        </div>
                    </div>

                    
                </div>
                <button type="submit" class="btn btn-primary btn-export_pdf">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--end:Modal-->
@endsection

@section('js_page')
<!--begin::Page Vendors(used by this page)-->
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<!--end::Page Scripts-->

<script type="text/javascript">

   
        $(document).ready(function () {
      
        //select data dari barang 
        $('.select2').select2();
        $('#jenis_code').on('change', function () {
            var jenis_code = $(this).val();
            if (jenis_code) {
                $.ajax({
                    url: './getBarang/' + jenis_code,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="barang_code"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="barang_code"]').append(
                                '<option value="' + value.barang_id + '">' +
                                value.nama_barang + '</option>');
                        });
                    }
                });
            } else {

                $('select[name="barang_code"]').empty();
            }
        });

        //datatable menampilkan data
        var datatable = $('#kt_datatable_menu');

        @can('barangkeluar-R')

        datatable.KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: '/BarangKeluar/list'
                    }
                },
                pageSize: 10,
            },
            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },
            // column sorting
            sortable: true,
            pagination: true,
            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },
            // columns definition
            columns: [{
                    field: 'barang_keluar_id',
                    title: 'id barang keluar',
                    // make center aligment.
                    textAlign: 'center',

                },
                {
                    field: 'nama_barang',
                    title: 'nama barang',
                    textAlign: 'center',

                },
                {
                    field: 'jumlah_barang_keluar',
                    title: 'jumlah',
                    textAlign: 'center',
                },
                {
                    field: 'no_dof_etiket',
                    title: 'nodof/eticket',
                    textAlign: 'center',
                },
                {
                    field: 'tgl_pengambilan',
                    title: 'tanggal pengambilan',
                    textAlign: 'center',
                },
                {
                    field: 'keterangan',
                    title: 'keterangan',
                    autoHide: false,
                    overflow: 'visible',
                    textAlign: 'center',
                },
                {
                    field: 'Actions',
                    title: 'Actions',
                    sortable: false,
                    width: 125,
                    autoHide: false,
                    overflow: 'visible',
                    template: function (row) {
                        return "<center>" +
                //semua button dalam table action
                            @can('barangkeluar-U')
                        "<button type='button' class='edits btn btn-sm btn-icon btn-outline-warning ' title='Edit' data-toggle='tooltip' data-id=" +
                        row.barang_keluar_id + " ><i class='fa fa-edit'></i> </button>  " +
                            @endcan
                        @can('barangkeluar-D')
                        "<button type='button' class='deletes btn-sm btn btn-icon btn-outline-danger' title='Delete' data-toggle='tooltip' alt='' data-id=" +
                        row.barang_keluar_id + " ><i class='fa fa-trash'></i></button>  " +
                            @endcan

                        @can('barangkeluar-U')
                        "<button type='button' class='returns btn btn-sm btn-icon btn-outline-info ' title='Return' data-toggle='tooltip' data-id=" +
                        row.barang_keluar_id +
                            " ><i class='fa fa-reply-all'></i> </button>  " +
                            @endcan
                        @can('barangkeluar-R')
                        "<button type='button' class='details btn btn-sm btn-icon btn-outline-info ' title='Detail' data-toggle='tooltip' data-id="+row.barang_keluar_id+" data-user_id="+row.user_id+" data-tgl_pengambilan="+row.tgl_pengambilan+" data-no_dof_etiket="+row.no_dof_etiket+" data-nama="+row.nama_barang+" data-barcode="+row.barcode_barang+" data-jenis_barang="+row.jenis_barang+" data-keterangan=" +row.keterangan+" data-jumlah_barang_keluar="+row.jumlah_barang_keluar+" ><i class='fa fa-info-circle'></i> </button>  " +
                            @endcan 
                        "</center>";
                    },
                }
            ],


        });
        @endcan
//menampilkan modal untuk menambahkan barang
        @can('barangkeluar-C')
        $(document).on('click', '#addMenu', function () {
            //mengkosongkan value id dalam membuat data baru
            $("#saveMenu").data("id", "");
            $('#modalMenuTitle').text('Mengeluarkan Barang');
            $('#modalMenu').modal('show');
            $(`.form-control`).removeClass('is-invalid');
            $(`.invalid-feedback`).remove();
            let form = document.forms.formmenus; // <form name="formmenus"> element
            form.reset();

        });

        @endcan
        //menampilkan update modal menu dalam mengubah atau mengedit data
        @can('barangkeluar-U')
        $(document).on('click', '.edits', function () {
            $.ajax({
                type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                url: './barangkeluar/' + $(this).data(
                    'id'), // the url where we want to POST
                beforeSend: function () {
                    let form = document.forms
                        .formmenus; // <form name="formmenus"> element
                    form.reset();
                    $(`.form-control`).removeClass('is-invalid');
                    $(`.invalid-feedback`).remove();
                }
            }).done(function (res) {
                let form = document.forms.formmenus; // <form name="formmenus"> element
                console.log(res.success);
                if (res.success) {
                    //jika berhasil mengambil data untuk mengedit
                    showtoastr('success', res.message);
                    $('#user_code').val(res.data.user_id);
                    $('#tanggal_code').val(res.data.tanggal_keluar);
                    $('#nodofeticket_code').val(res.data.nodofeticket_code);
                    $('#barang_code').val(res.data.barang_id);
                    $('#jenis_code').val(res.data.jenis_barang);
                    $('#jumlah_code').val(res.data.jumlah_barang);
                    $('#keterangan_code').val(res.data.keterangan_barang);
                    $("#saveMenu").data("id", res.data.barang_id);
                }
            }).fail(function (data) {
                //jika salah sebaliknya 
                show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                $.each(data.responseJSON.errors, function (index, value) {
                    show_toastr('error', index, value);
                });
            }).always(function () {
                $('#modalMenuTitle').text('Edit Data Barang');
                $('#modalMenu').modal('show');
            });
        });
        //menampilkan modal menu return pada barang keluar
        $(document).on('click', '.returns', function () {
            $.ajax({
                type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                url: './returnbarang/' + $(this).data(
                    'id'), // the url where we want to POST
                beforeSend: function () {
                    let form = document.forms
                        .formreturn; // <form name="formmenus"> element
                    form.reset();
                    $(`.form-control`).removeClass('is-invalid');
                    $(`.invalid-feedback`).remove();
                }
            }).done(function (res) {
                let form = document.forms.formmenus; // <form name="formmenus"> element
                console.log(res.success);
                if (res.success) {
                    showtoastr('success', res.message);
                    console.log(res.data[0])
                    $('#id_barang_keluar').val(res.data[0].barang_keluar_id);
                    // $('#tanggal_code').val(res.data.tanggal_keluar);
                    $('#barang_id').val(res.data[0].barang_id);
                    $('#nodof_code').val(res.data[0].no_dof_etiket);
                    $('#barangdikembalikan_code').val(res.data[0].nama_barang);
                    $('#tipebarang_code').val(res.data[0].jenis_barang);
                    $('#jumlahdikembalikan').val(res.data.jumlah_barang);
                    $("#saveMenu").data("id", res.data.barang_id);
                }
            }).fail(function (data) {
                show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                $.each(data.responseJSON.errors, function (index, value) {
                    show_toastr('error', index, value);
                });
            }).always(function () {
                $('#modalReturnTitle').text('Return Barang');
                $('#modalReturn').modal('show');
            });
        });
        @endcan
        $(document).on('click', '.details', function () {
            $('#user_code_detail').val($(this).data('user_id'));
            $('#tgl_pengambilan').val($(this).data('tgl_pengambilan'));
            $('#nodofetiket_code_detail').val($(this).data('no_dof_etiket'));
            $('#nama_code_detail').val($(this).data('nama'));
            $('#barcode_detail').val($(this).data('barcode'));
            var jenis_barang = $(this).data('jenis_barang');
            if (jenis_barang == 1) {
                $('#jenis_code_detail').val('Consumable');
            } else {
                $('#jenis_code_detail').val('Asset');
            }
            $('#jumlah_detail').val($(this).data('jumlah_barang_keluar'));
            $('#keterangan_code_detail').val($(this).data('keterangan'));



            //showmodal
            $('#modalInfo').modal('show');
        });



        @can(['barangkeluar-C', 'barangkeluar-U'])
        $('#formmenus').submit(function (e) {
            e.preventDefault();
            var formData = new FormData($("#formmenus")[0]);
            // var formData = $('#formmenus').serializeArray(); // our data object
            var method = "POST";
            let menuID = $("#saveMenu").data("id");

            if (typeof menuID == "undefined" || menuID == "") {
                var url = `./barangkeluar`;
            } else {
                var url = `./barangkeluar/${menuID}/update`;
            }
            //var url = (menuID != "" || menuID != undefined) ? `./company/${menuID}/update` : `./company`;

            $.ajax({
                type: method, // define the type of HTTP verb we want to use (POST for our form)
                url: url, // the url where we want to POST
                data: formData,
                dataType: 'JSON', // what type of data do we expect back from the server
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(`.form-control`).removeClass('is-invalid');
                    $(`.invalid-feedback`).remove();
                    $('#saveMenu').attr('disabled', true).html(
                        "<i class='fa fa-spinner fa-spin'></i> processing");
                }
            }).done(function (data) {
                $("#modalMenu").modal('hide');
                showtoastr('success', data.message);
                $("#saveMenu").data("id", "");
                $("#formmenus")[0].reset();
                menuID = "";
                let form = document.forms.formmenus; // <form name="formmenus"> element
                form.reset();
                datatable.reload();
            }).fail(function (data) {
                show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                $.each(data.responseJSON.errors, function (index, value) {
                    if ($(`input[name='${index}']`)) {
                        $(`input[name='${index}']`).addClass(`is-invalid`);
                        $(`input[name='${index}']`).after(
                            `<div class="invalid-feedback">${value}</div>`);
                    }
                    show_toastr('error', index, value);
                });
            }).always(function () {
                $('#saveMenu').attr('disabled', false).html(
                    "<i class='fa fa-save'></i> Save");
            });
        });
        @endcan

        @can(['barangkeluar-C', 'barangkeluar-U'])
        $('#formreturn').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST", // define the type of HTTP verb we want to use (POST for our form)
                url: './returnbarang/', // the url where we want to POST
                data: {
                    'barang_keluar_id': $('#id_barang_keluar').val(),
                    'jumlah': $('#jumlahdikembalikan').val(),
                    'barang_id': $('#barang_id').val(),
                },
                dataType: 'JSON', // what type of data do we expect back from the server
                // contentType: false,
                // processData: false,
                beforeSend: function () {
                    $(`.form-control`).removeClass('is-invalid');
                    $(`.invalid-feedback`).remove();
                    $('#saveMenu').attr('disabled', true).html(
                        "<i class='fa fa-spinner fa-spin'></i> processing");
                }
            }).done(function (data) {
                $("#modalInfo").modal('hide');
                showtoastr('success', data.message);
                $("#saveMenu").data("id", "");
                $("#formreturn")[0].reset();
                menuID = "";
                let form = document.forms.formmenus; // <form name="formmenus"> element
                form.reset();
                datatable.reload();
            }).fail(function (data) {
                show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                $.each(data.responseJSON.errors, function (index, value) {
                    if ($(`input[name='${index}']`)) {
                        $(`input[name='${index}']`).addClass(`is-invalid`);
                        $(`input[name='${index}']`).after(
                            `<div class="invalid-feedback">${value}</div>`);
                    }
                    show_toastr('error', index, value);
                });
            }).always(function () {
                $('#saveMenu').attr('disabled', false).html(
                    "<i class='fa fa-save'></i> Save");
            });
        });
        @endcan

        @can('barangkeluar-D')
        $(document).on('click', '.deletes', function () {
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then(isConfirm => {
                    if (isConfirm.isConfirmed) {
                        $.ajax({
                                type: 'DELETE', // define the type of HTTP verb we want to use (POST for our form)
                                url: './barangkeluar/' + $(this).data(
                                    'id'), // the url where we want to POST
                            })
                            .done(function (data) {
                                showtoastr('success', data.message);
                            })
                            .fail(function (data) {
                                show_toastr('error', data.responseJSON.status, data
                                    .responseJSON
                                    .message);
                                $.each(data.responseJSON.messages, function (index, value) {
                                    show_toastr('error', index, value);
                                });
                            })
                            .always(function () {
                                datatable.reload();
                            });
                    } else {
                        show_toastr('error', 'internal Server Error');
                    }
                });
        });
        @endcan

    });
    $('#export_bulanan').click(function () {
        $('#BulananExportkeluar').modal('show');
    });
    function modalTahunanExport() {
        $('#exportTahunankeluar').modal('show')
    }
    function modalBulananExport() {
        $('#BulananExportkeluar').modal('show')
    }

    $('.btn-export_excel').click(function(){
        var tanggal_awal = new Date($('#tgl_awal').val());
        var tanggal_akhir = new Date($('#tgl_akhir').val());
        if(tanggal_akhir < tanggal_awal){
            toastr.warning('Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            return false;
        }
        $.ajax({
            xhrFields: {responseType: 'blob',
    },
            url: './barangkeluar-export' ,
                type: "Post",                   
                data: {
                    tanggal_awal: $('#tgl_awal').val(),
                    tanggal_akhir: $('#tgl_akhir').val(),
                },
                success: function(result, status, xhr) {
      var disposition = xhr.getResponseHeader('content-disposition');
      var filename = ('Laporan Keluar bulanan.xlsx');

      var blob = new Blob([result], {
        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      });
      var link = document.createElement('a');
      link.href = window.URL.createObjectURL(blob);
      link.download = filename;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }

        })

    });
    $('.btn-export_pdf').on('click', function (){
                $.ajax({
                xhrFields: {responseType: 'blob',},
                    url: './barangkeluar-export-tahunan' ,
                    type: "get",                   
                    success: function() {
                        window.location.href = './barangkeluar-export-tahunan';
                    }       
                })
            })


</script>

@endsection
