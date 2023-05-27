@extends('layouts.main')

@section('title', 'Barang')

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
                                <button id="addMenu" name="addMenu" class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                        <!--end::Svg Icon-->
                                    </span>Barang Baru</a>
                                </button>
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

    <!--begin:Modal-->
    <div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMenuTitle">Create Barang</h5>
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
                                <label class="col-lg-3 col-form-label">Nama Barang:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="barang_name" name="barang_name"
                                           placeholder="Contoh : Totolink N200RE Mini"/>
                                    <span class="form-text text-muted">Masukkan nama Barang</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Jenis Barang:</label>
                                <div class="col-lg-9">
                                    <select class="form-control" id="jenis_code" name="jenis_code">
                                        <option value="">Pilih Jenis Barang</option>
                                        <option value="1">Consummables</option>
                                        <option value="2">Asset</option>
                                    </select>
                                    <span class="form-text text-muted">Masukkan Jenis Barang</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama Kategori</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" id="kategori_id" name="kategori_id" style="width: 100%>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $k)
                                            <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-text text-muted">Masukkan Nama Kategori</span>
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
                                    class="fa fa-times"></i>Cancel
                        </button>
                        @can(['barang-C' , 'barang-U'])
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


      <!--begin:Modal info-->
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
                                    <input type="text" class="form-control" id="kategori_barang" name="kategori_barang"
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
                    },{
                        field: 'jenis_barang',
                        title: 'jenis barang',
                    },{
                        field: 'nama_kategori',
                        title: 'kategori barang',
                    },{
                        field: 'nama_barang',
                        title: 'nama barang',
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
                            return "<center>" +
                                    @can('barang-U')
                                        "<button type='button' class='edits btn btn-sm btn-icon btn-outline-warning ' title='Edit' data-toggle='tooltip' data-id=" + row.barang_id + " ><i class='fa fa-edit'></i> </button>  " +
                                    @endcan
                                            @can('barang-D')
                                        "<button type='button' class='deletes btn-sm btn btn-icon btn-outline-danger' title='Delete' data-toggle='tooltip' alt='' data-id=" + row.barang_id+ " ><i class='fa fa-trash'></i></button>  " +
                                    @endcan                                  
                                            @can ('barang-R')
                                        "<button type='button' class='details btn btn-sm btn-icon btn-outline-info ' title='Detail' data-toggle='tooltip' data-id=" + row.barang_id + " data-nama="+row.nama_barang+" data-barcode="+row.barcode_barang+" data-jenis_barang="+row.jenis_barang+" data-jumlah_barang="+row.jumlah_barang+" data-keterangan_barang="+row.keterangan_barang+"><i class='fa fa-eye'></i> </button>  " +
                                      
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
                $('#modalMenuTitle').text('Create barang'
                );
                $('#modalMenu').modal('show');
                $(`.form-control`).removeClass('is-invalid');
                $(`.invalid-feedback`).remove();
                let form = document.forms.formmenus; // <form name="formmenus"> element
                form.reset();
                
            });
            @endcan

            @can('barang-U')
            $(document).on('click', '.edits', function () {
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
                        $('#jenis_code').val(res.data.jenis_barang);                       
                        $('#keterangan_code').val(res.data.keterangan_barang);
                        $("#saveMenu").data("id", res.data.barang_id);
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

                $('#kategori_code_detail').val($(this).data('kategori'));
                $('#keterangan_code_detail').val($(this).data('keterangan_barang'));

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
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
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

        });


    </script>

@endsection
