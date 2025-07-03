@extends('layouts.main')

@section('title', 'Barang')

@section('css_page')
    <!-- BEGIN VENDOR CSS-->
    <!-- END VENDOR CSS-->

    <!-- BEGIN Page Level CSS-->
<style>
    .datatable.datatable-default.datatable-head-custom > .datatable-table > .datatable-head .datatable-row > .datatable-cell > span, .datatable.datatable-default.datatable-head-custom > .datatable-table > .datatable-foot .datatable-row > .datatable-cell > span{
        color: #ffffff !important;
    }
    
    ::-webkit-scrollbar {
        width: 5px;
    }
    
    ::-webkit-scrollbar {
        background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #c8c8c8;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #555;
    }

    
    
    #kt_datatable_menu td,
    #kt_datatable_menu th {
        padding: 1rem;
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        border: 1px solid #ddd;
        padding: 1rem;
        text-align: center;
    }
    
    tbody tr:nth-child(odd) {
        background-color: #f2f2f2; 
    }
    
    tbody tr:nth-child(even) {
        background-color: #ffffff; 
    }
    
    thead {
        background-color: #333;
        color: #ffffff;
    }
    
    
    
    #kt_datatable_menu td:first-child { 
        width: 0.5rem; /* ID input */
    }
    
    #kt_datatable_menu thead {
        background-color: #28a745; 
        color: white !important;
    }
    
    #kt_datatable_menu td:first-child {
        background-color: #d4edda; 
        color: #155724; 
    }
    
    #kt_datatable_menu th:first-child {
        background-color: #28a745; 
        color: #ffffff; 
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
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Barang</h5>
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
                            <h3 class="card-label">Data Barang
                                <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            @can('barang-C')
                                <button  class="btn btn-primary font-weight-bolder  dropdown-toggle" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                        <!--end::Svg Icon-->
                                    </span>Barang Baru</a>
                                </button>
                                
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi flex-column navi-hover py-2">
                                        <li
                                            class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                             Pilih cara input:
                                        </li>
                                        <li class="navi-item">
                                            <a id="addMenu" name="addMenu" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-file-excel-o"></i>
                                                </span>
                                                <span class="navi-text">Form</span>
                                            </a>
                                        </li>
                                        </li>
                                        <li class="navi-item">
                                        <a id="modalimportbarang" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-file-pdf-o"></i>
                                                </span>
                                                <span class="navi-text">Import</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                        @endcan
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
                                                       id="kt_datatable_search_query"/>
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

  

    <!--Modal Menu-->
    <div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMenuTitle">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formmenus" id="formmenus" enctype="multipart/formdata" method="">
                    <div class="modal-body" style="height: 400px;">
                    <input type="hidden" name="user_code" id="user_code">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Kode Barcode:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="barcode" name="barcode"
                                           placeholder="contoh : SW.PG.abc.123.123"/>
                                    <span class="form-text text-muted">Masukkan kode</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama Kategori</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" id="kategori_id" name="kategori_id" style="width: 100%">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach($kategori as $k)
                                            <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-text text-muted">Masukkan Nama Kategori</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama Barang:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="barang_name" name="barang_name"
                                           placeholder="Contoh : Totolink N200RE Mini"/>
                                    <span class="form-text text-muted">Masukkan nama Barang</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Gambar:</label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control-file" id="gambar" name="gambar">
                                    <span class="form-text text-muted">Unggah gambar Barang</span>
                                </div>
                            </div>                        
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Keterangan Barang:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="keterangan_code" name="keterangan_code"
                                           placeholder="Contoh : untuk router"/>
                                    <span class="form-text text-muted">Masukkan keterangan Barang</span>
                                </div>
                            </div>
                           
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                                    class="fa fa-times"></i>Batal
                        </button>
                        @can(['barang-C' , 'barang-U'])
                            <button type="submit" id="saveMenu" data-id="" class="btn btn-primary font-weight-bold">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        @endcan
                    </div>
                </form>
                <!--end:Form-->
            </div>
        </div>
    </div>
    <!--end:Modal-->

    <!--Modal Preview-->
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMenuTitle">Informasi Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formmenus" id="formmenus" enctype="multipart/formdata" method="">
                    <div class="modal-body" style="height: 400px;">
                        <input type="hidden" name="user_code" id="user_code">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Jenis Barang:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="jenis_code_detail" name="jenis_code_detail"
                                    readonly/>
                                    <span class="form-text text-muted">Masukkan Jenis Barang</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Kategori Barang:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="kategori_barang_info" name="kategori_barang_info"
                                           placeholder="Contoh : Totolink N200RE Mini" readonly/>
                                    <span class="form-text text-muted" >Masukkan kategori Barang</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama Barang:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="barang_name_detail" name="barang_name_detail"
                                           placeholder="Contoh : Totolink N200RE Mini" readonly/>
                                    <span class="form-text text-muted" >Masukkan nama Barang</span>
                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Kode Barcode:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="barcode_detail" name="barcode_detail"
                                           placeholder="contoh:SW.PG.abc.123.123" readonly/>
                                    <span class="form-text text-muted">Masukkan kode</span>
                                </div>
                            </div>
                         {{-- show detail gambar images --}}
                         <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Gambar:</label>
                            <div class="col-lg-9">
                                <img id="gambar_detail" src="path/ke/gambar.jpg" alt="Gambar Detail">
                            </div>
                        </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Keterangan Barang:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="keterangan_code_detail" name="keterangan_code_detail"
                                    readonly/>
                                    <span class="form-text text-muted" readonly>Masukkan keterangan Barang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                            <i class="fa fa-times"></i>Tutup
                        </button>
                    </div>
                </form>
                <!--end:Form-->
            </div>
        </div>
    </div>

    <!--end:Modal-->


      <!--Modal Import-->
      <div class="modal fade" id="modalimportbarangadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalMenuimportTitle">Import data Barang</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <i aria-hidden="true" class="ki ki-close"></i>
                 </button>
             </div>
             <!--begin:Form-->
             <form role="form" class="form" name="formmenusimport" id="formimports" enctype="multipart/formdata" method="">
                 <div class="modal-body" style="height: 400px;">
                     <div class="mb-7">
                         <div class="row">
                             <label class="col-lg-3 col-form-label">File import isian:</label>
                             <div class="col-lg-9 text-center">
                                <button type="button" class="btn btn-primary" id="importdummy" style="width: 100%">Download File isi import</button>
                             </div>
                         </div>
                         <div class="form-group row">
                            <label class="col-lg-3 col-form-label">File import:</label>
                            <div class="col-lg-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileimportupload" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                  </div>
                                <span class="form-text text-muted"> Download file untuk entri data </span>
                            </div>
                        </div>
                        
                        
                     </div>

                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                                 class="fa fa-times"></i> Batal
                     </button>
                     @can(['barang-C' , 'barang-U'])
                         <button type="submit" id="saveMenuimport" data-id="" class="btn btn-primary font-weight-bold">
                             <i class="fa fa-save"></i> Simpan
                         </button>
                     @endcan
                 </div>
             </form>
             <!--end:Form-->
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

            

            $('.select2').select2();

            var datatable = $('#kt_datatable_menu');

            @can('barang-R')

            datatable.KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method: 'GET',
                            url: '/barang/list'
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
                columns: [
                    {
                        field : 'DT_RowIndex',
                        title : 'No',   
                        textAlign: 'center',
                        width : 50
                    },{
                        field: 'jenis_barang',
                        title: 'jenis barang',
                        textAlign: 'center',
                    },{
                        field: 'nama_kategori',
                        title: 'kategori barang',
                        textAlign: 'center',
                    },{
                        field: 'nama_barang',
                        title: 'nama barang',
                        textAlign: 'center',
                    }, 
                    {
                        field: 'gambark',
                        title: 'gambar',
                        textAlign: 'center',
                    },
                    // {
                    //     field: 'jumlah_barang',
                    //     title: 'jumlah barang',
                    // }
                    {
                        field: 'Actions',
                        title: 'Actions',
                        sortable: false,
                        width: 125,
                        autoHide: false,
                        overflow: 'visible',
                        template: function (row) {
                            console.log(row);
                            return "<center>" +
                                    @can('barang-U')
                                        "<button type='button' class='edits btn btn-sm btn-icon btn-outline-warning ' title='Edit' data-toggle='tooltip' data-id=" + row.barang_id + " ><i class='fa fa-edit'></i> </button>  " +
                                    @endcan
                                            @can('barang-D')
                                        "<button type='button' class='deletes btn-sm btn btn-icon btn-outline-danger' title='Delete' data-toggle='tooltip' alt='' data-id=" + row.barang_id+ " ><i class='fa fa-trash'></i></button>  " +
                                    @endcan                                  
                                            @can ('barang-R')
                                        "<button type='button' class='details btn btn-sm btn-icon btn-outline-info ' title='Detail' data-toggle='tooltip' data-id=" + row.barang_id +" data-nama="+row.nama_barang+" data-barcode="+row.barcode_barang+" data-jenis_barang="+row.jenis_barang+" data-nama_kategori="+row.nama_kategori+" data-jumlah_barang="+row.jumlah_barang+" data-keterangan_barang="+row.keterangan_barang+" data-gambar="+encodeURI(row.gambar)+"><i class='fa fa-eye'></i> </button>  " +
                                      
                                        @endcan
                                            "</center>";
                                        
                        },
                    }
                ],


            });
            @endcan

            @can('barang-C')
            $(document).on('click', '#addMenu', function () {
                $("#saveMenu").data("id", "");
                $('#modalMenuTitle').text('Tambah barang');
                $('#modalMenu').modal('show');
                $(`.form-control`).removeClass('is-invalid');
                $(`.invalid-feedback`).remove();
                let form = document.forms.formmenus; // <form name="formmenus"> element
                form.reset();
            });
            @endcan
            $(document).on('click','#saveMenuimport', function(e){
                e.preventDefault();
                var fileimportupload = $('#fileimportupload').prop('files')[0];
                var form_data = new FormData();
                form_data.append('fileimportupload', fileimportupload);
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: './barang/import', // the url where we want to POST
                    data: form_data,
                    dataType: 'JSON', // what type of data do we expect back from the server
                    contentType: false,
                    processData: false,
                }).done(function(res) {
                   // reset form
                     $('#modalimportbarangadd').modal('hide');
                        showtoastr('success', res.message);
                        $("#saveMenuimport").data("id", "");
                        $("#formimports")[0].reset();
                        menuID = "";
                        let form = document.forms.formimports; // <form name="formmenus"> element
                        form.reset();
                        datatable.reload();
                })
                
            })

            @can('barang-U')
            $(document).on('click', '.edits', function () {
                console.log($(this).data('id'));
                $.ajax({
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './barang/' + $(this).data('id'), // the url where we want to POST
                    beforeSend: function () {
                        let form = document.forms.formmenus; // <form name="formmenus"> element
                        form.reset();
                        $(`.form-control`).removeClass('is-invalid');
                        $(`.invalid-feedback`).remove();
                    }
                }).done(function (res) {
                    let form = document.forms.formmenus; // <form name="formmenus"> element
                    console.log(res.success);
                    if (res.success) {
                        showtoastr('success', res.message);
                        $('#user_code').val(res.data.user_id);
                        $('#barcode').val(res.data.barcode_barang);                        
                        $('#barang_name').val(res.data.nama_barang);
                        $('#kategori_code').val(res.data.kategori_nama)
                        $('#kategori_id').val(res.data.kategori_id).trigger('change');                  
                        $('#keterangan_code').val(res.data.keterangan_barang);
                        $("#saveMenu").data("id", res.data.barang_id);
                        $('#gambar').attr('src', encodeURI('file_barang/' + res.data.gambar));
                    }
                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.errors, function (index, value) {
                        show_toastr('error', index, value);
                    });
                }).always(function () {
                    $('#modalMenuTitle').text('Edit Data Barang');
                    $('#modalMenu').modal('show');
                });
            });

            $(document).on('click', '.returns', function () {
                $.ajax({
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './returnbarang/' + $(this).data('id'), // the url where we want to POST
                    beforeSend: function () {
                        let form = document.forms.formreturn; // <form name="formmenus"> element
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
                        $('#kategori_code').val(res.data[0].nama_kategori);
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

            $(document).on('click', '.details', function(){
                $('#barang_name_detail').val($(this).data('nama'));
                $('#barcode_detail').val($(this).data('barcode'));
                var kode = $(this).data('jenis_barang');
                if(kode == 1){
                    $('#jenis_code_detail').val('Consummables');
                }else{
                    $('#jenis_code_detail').val('Asset');
                }  
                $('#jenis_code_detail').val();  
                console.log($(this).data('keterangan_barang'));

                $('#kategori_code_detail').val($(this).data('kategori'));
                $('#keterangan_code_detail').val($(this).data('keterangan_barang'));
                $('#kategori_barang_info').val($(this).data('nama_kategori'));
                $('#gambar_detail').attr('src', 'file_barang/' + $(this).data('gambar'));
                // show modal
                $('#modalInfo').modal('show');
            })
            
  

            @can(['barang-C', 'barang-U'])
            $('#formmenus').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($("#formmenus")[0]);
                // var formData = $('#formmenus').serializeArray(); // our data object
                var method = "POST";
                let menuID = $("#saveMenu").data("id");
                
                if (typeof menuID == "undefined" || menuID == "") {
                    var url = `./barang`;
                } else {
                    var url = `./barang/${menuID}/update`;
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
                        // $('#saveMenu').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
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
                            $(`input[name='${index}']`).after(`<div class="invalid-feedback">${value}</div>`);
                        }
                        show_toastr('error', index, value);
                    });
                }).always(function () {
                    $('#saveMenu').attr('disabled', false).html("<i class='fa fa-save'></i> Save");
                });
            });
            @endcan

            @can('barang-D')
            $(document).on('click', '.deletes', function () {
                Swal.fire({
                    title: 'Apakah anda ingin menghapus data ini?',
                     text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ya, hapus data!'
                })
                    .then(isConfirm => {
                    if(isConfirm.isConfirmed){
                    $.ajax({
                        type: 'DELETE', // define the type of HTTP verb we want to use (POST for our form)
                        url: './barang/' + $(this).data('id'), // the url where we want to POST
                    })
                        .done(function (data) {
                            showtoastr('success', data.message);
                            
                        })
                        .fail(function (data) {
                            show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                            $.each(data.responseJSON.messages, function (index, value) {
                                show_toastr('error', index, value);
                            });
                        })
                        .always(function () {
                            datatable.reload();
                        });
                }
            else
                {
                    show_toastr('error', 'internal Server Error');
                }
            })
                ;
            });
            @endcan

            $(document).on('click', '#importdummy', function () {
                // download file
                $.ajax({
                    xhrFields: {responseType: 'blob',
        },
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './templatebarang', // the url where we want to POST
                    success: function(result, status, xhr) {
                    var disposition = xhr.getResponseHeader('content-disposition');
                    var filename = ('Template Barang.xlsx');

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
            })

            $(document).on('click', '#modalimportbarang', function () {
                $('#modalimportbarangadd').modal('show');
            });

        });



    </script>

@endsection
