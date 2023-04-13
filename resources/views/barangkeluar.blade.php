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
                    <h5 class="modal-title" id="modalMenuTitle">barang keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <script src="script.js"></script>
                <form role="form" class="form" name="formmenus" id="formmenus" enctype="multipart/formdata" method="">
                    <div class="modal-body" style="height: 500px;">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">User ID:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="user_code" name="user_code"
                                           placeholder="e.g: A000"/>
                                    <span class="form-text text-muted">Masukkan id user anda</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">NomorDOF/ E-Ticket:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="nodofetiket_code" name="nodofetiket_code"
                                           placeholder="e.g:10451 /GS-10571"/>
                                    <span class="form-text text-muted">masukan DOF(Deep Of Field)/ E-Ticket(</span>
                                </div>
                            </div>
                            <!--  -->
                <div class="form-group row">
                <label class="col-lg-3 col-form-label">Jenis Barang:</label>
                <div class="col-lg-9">
                    <select class="form-control" id="jenis_code" name="jenis_code">
                        <option value="">Pilih jenis barang</option>
                        <option value="persediaan">Persediaan</option>
                        <option value="asset">Asset</option>
                    </select>
                    <span class="form-text text-muted">Pilih jenis barang untuk menampilkan opsi barang</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Barang:</label>
                <div class="col-lg-9">
                    <select class="form-control" id="barang_code" name="barang_code">
                        <option value="">Pilih barang</option>
                    </select>
                    <span class="form-text text-muted">Pilih barang yang akan dikeluarkan</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Jenis Barang Baru:</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="jenis_code_baru" name="jenis_code_baru" />
                    <span class="form-text text-muted">Masukkan jenis barang baru jika tidak ada di opsi di atas</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Barang Baru:</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="barang_code_baru" name="barang_code_baru" />
                    <span class="form-text text-muted">Masukkan nama barang baru jika tidak ada di opsi di atas</span>
                </div>
            </div>
                
                
                
                           


<!--  -->
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Jumlah Barang:</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                           placeholder="e.g:100"/>
                                    <span class="form-text text-muted">Masukkan Jumlah Barang</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Keterangan Barang:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="keterangan_code" name="keterangan_code"
                                           placeholder="e.g:untuk router"/>
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

            @can('barangkeluar-R')

            datatable.KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method: 'GET',
                            url: './barangkeluar/list'
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
                        field: 'tanggal_keluar',
                        title: 'tanggal keluar',
                        
                    },
                    {
                        field: 'nodofeticket_code',
                        title: 'nodof/eticket',

                    },
                    {
                        field:'user_name',
                        title:'nama user'
                    },
                    { field:'jenis_code_barang', 
                      title:'jenis barang'
                    },
                    
                    {
                        field: 'barang_code',
                        title: 'barang',
                    },
                    {
                        field: 'jumlah_barang',
                        title: 'jumlah barang',
                    },
                    {
                        field: 'keterangan_code',
                        title: 'keterangan barang',

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
                                    @can('barangkeluar-U')
                                        "<button type='button' class='edits btn btn-sm btn-icon btn-outline-warning ' title='Edit' data-toggle='tooltip' data-id=" + row.barang_keluar_id + " ><i class='fa fa-edit'></i> </button>  " +
                                    @endcan
                                            @can('barangkeluar-D')
                                        "<button type='button' class='deletes btn-sm btn btn-icon btn-outline-danger' title='Delete' data-toggle='tooltip' alt='' data-id=" + row.barang_keluar_id+ " ><i class='fa fa-trash'></i></button>  " +
                                    @endcan
                                        "</center>";
                        },
                    }
                ],


            });
            @endcan

            @can('barangkeluar-C')
            $(document).on('click', '#addMenu', function () {
                $("#saveMenu").data("id", "");
                $('#modalMenuTitle').text('Create barnag'
                );
                $('#modalMenu').modal('show');
                $(`.form-control`).removeClass('is-invalid');
                $(`.invalid-feedback`).remove();
                let form = document.forms.formmenus; // <form name="formmenus"> element
                form.reset();
                
            });

            @endcan

            @can('barangkeluar-U')
            $(document).on('click', '.edits', function () {
                $.ajax({
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './barangkeluar/' + $(this).data('id'), // the url where we want to POST
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
                        $('#tanggal_code').val(res.data.tanggal_keluar);
                        $('#nodofeticket_code').val(res.data.nodofeticket_code);
                        $('#barang_code').val(res.data.barang_id);                        
                        $('#jenis_code').val(res.data.jenis_barang);
                        $('#jumlah_code').val(res.data.jumlah_barang);                        
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

            @endcan

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
                        $('#saveMenu').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
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
                    if(isConfirm.isConfirmed
            )
                {
                    $.ajax({
                        type: 'DELETE', // define the type of HTTP verb we want to use (POST for our form)
                        url: './barangkeluar/' + $(this).data('id'), // the url where we want to POST
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
