@extends('layouts.main')

@section('title', 'ReturnBarang')

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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Return Barang</h5>
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
                        <h3 class="card-label">Data Return Barang
                            <span class="d-block text-muted pt-2 font-size-sm"></span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
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
                                            <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
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


<!--end:Modal-->

@endsection

@section('js_page')
<!--begin::Page Vendors(used by this page)-->
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<!--end::Page Scripts-->

<script type="text/javascript">
    $(document).ready(function() {

        $('.select2').select2();
        $('#jenis_code').on('change', function() {
            var jenis_code = $(this).val();
            if (jenis_code) {
                $.ajax({
                    url: './getBarang/' + jenis_code,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="barang_code"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="barang_code"]').append('<option value="' + value.barang_id + '">' + value.nama_barang + '</option>');
                        });
                    }
                });
            } else {

                $('select[name="barang_code"]').empty();
            }
        });
        var datatable = $('#kt_datatable_menu');

        @can('returnbarang-R')

        datatable.KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: '/data-returnbarang'
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
                    field: 'return_id',
                    title: 'id return',
                },



                {
                    field: 'nama_barang',
                    title: 'nama barang',
                }, {
                    field: 'jumlah_barang_return',
                    title: 'jumlah return barang',
                },
                {
                    field: 'jumlah_barang',
                    title: 'Stok Barang',


                },
                {
                    field: 'waktu_return',
                    title: 'waktu return',
                },
                {
                    field: 'action',
                    title: 'Action',


                }
            ],


        });
        @endcan

        @can('returnbarang-C')
        $(document).on('click', '#addMenu', function() {
            $("#saveMenu").data("id", "");
            $('#modalMenuTitle').text('Mengembalikan Barang');
            $('#modalMenu').modal('show');
            $(`.form-control`).removeClass('is-invalid');
            $(`.invalid-feedback`).remove();
            let form = document.forms.formmenus; // <form name="formmenus"> element
            form.reset();

        });

        @endcan

        @can('returnbarang-U')
        $(document).on('click', '.edits', function() {
            $.ajax({
                type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                url: './returnbarang/' + $(this).data('id'), // the url where we want to POST
                beforeSend: function() {
                    let form = document.forms.formmenus; // <form name="formmenus"> element
                    form.reset();
                    $(`.form-control`).removeClass('is-invalid');
                    $(`.invalid-feedback`).remove();
                }
            }).done(function(res) {
                let form = document.forms.formmenus; // <form name="formmenus"> element
                console.log(res.success);
                if (res.success) {
                    showtoastr('success', res.message);
                    $('#user_code').val(res.data.user_id);
                    $('#barang_name').val(res.data.nama_barang);
                    $('#jenis_code').val(res.data.jenis_barang);
                    $('#jumlah_code').val(res.data.jumlah_barang);
                    $('#keterangan_code').val(res.data.keterangan_barang);
                    $("#saveMenu").data("id", res.data.barang_id);
                }
            }).fail(function(data) {
                show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                $.each(data.responseJSON.errors, function(index, value) {
                    show_toastr('error', index, value);
                });
            }).always(function() {
                $('#modalMenuTitle').text('Edit Data Barang');
                $('#modalMenu').modal('show');
            });
        });

        @endcan

        @can(['returnbarang-C', 'returnbarang-U'])
        $('#formmenus').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($("#formmenus")[0]);
            // var formData = $('#formmenus').serializeArray(); // our data object
            var method = "POST";
            let menuID = $("#saveMenu").data("id");

            if (typeof menuID == "undefined" || menuID == "") {
                var url = `./returnbarang`;
            } else {
                var url = `./returnbarang/${menuID}/update`;
            }
            //var url = (menuID != "" || menuID != undefined) ? `./company/${menuID}/update` : `./company`;

            $.ajax({
                type: method, // define the type of HTTP verb we want to use (POST for our form)
                url: url, // the url where we want to POST
                data: formData,
                dataType: 'JSON', // what type of data do we expect back from the server
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(`.form-control`).removeClass('is-invalid');
                    $(`.invalid-feedback`).remove();
                    // $('#saveMenu').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
                }
            }).done(function(data) {
                $("#modalMenu").modal('hide');
                showtoastr('success', data.message);
                $("#saveMenu").data("id", "");
                $("#formmenus")[0].reset();
                menuID = "";
                let form = document.forms.formmenus; // <form name="formmenus"> element
                form.reset();
                datatable.reload();
            }).fail(function(data) {
                show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                $.each(data.responseJSON.errors, function(index, value) {
                    if ($(`input[name='${index}']`)) {
                        $(`input[name='${index}']`).addClass(`is-invalid`);
                        $(`input[name='${index}']`).after(`<div class="invalid-feedback">${value}</div>`);
                    }
                    show_toastr('error', index, value);
                });
            }).always(function() {
                $('#saveMenu').attr('disabled', false).html("<i class='fa fa-save'></i> Save");
            });
        });
        @endcan

        @can('returnbarang-D')
        $(document).on('click', '.deletes', function() {
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
                                url: './returnbarang/' + $(this).data('id'), // the url where we want to POST
                            })
                            .done(function(data) {
                                showtoastr('success', data.message);
                            })
                            .fail(function(data) {
                                show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                                $.each(data.responseJSON.messages, function(index, value) {
                                    show_toastr('error', index, value);
                                });
                            })
                            .always(function() {
                                datatable.reload();
                            });
                    } else {
                        show_toastr('error', 'internal Server Error');
                    }
                });
        });
        @endcan

    });
</script>

@endsection