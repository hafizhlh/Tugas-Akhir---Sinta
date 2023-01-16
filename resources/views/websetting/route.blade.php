@extends('layouts.main')

@section('title', 'Route Settings')

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
                        <i class="fa fa-cog text-warning"></i>
                    </span>
                    <!--end::Page Title-->
                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Route Settings</h5>
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
            <div class="container-fluid">
                <!--begin::Notice-->
                <!--end::Notice-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">Data Route
                                <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            @can('routesetting-C')
                                <button id="addMenu" name="addMenu" class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                        <!--end::Svg Icon-->
                                    </span>New Record</a>
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
    <div class="modal fade" id="modalRoutes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRoutesTitle">Create Routes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formroutes" id="formroutes" enctype="multipart/formdata" method="">
                    <div class="modal-body" style="height: 500px;">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Method:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" name="method" style="width: 100%;">
                                        @foreach($methods as $item)
                                            <option class="form-control"
                                                    value='{{$item["value"]}}'> {{$item['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Type:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" name="type" style="width: 100%;">
                                        <option class="form-control" value='data'> Data</option>
                                        <option class="form-control" value='view'> View</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Guard:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" name="guard" style="width: 100%;">
                                        <option class="form-control" value='web'> WEB</option>
                                        <option class="form-control" value='api'> API</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Url:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="url" placeholder="e.g: /dashboard"/>
                                    <span class="form-text text-muted">Please enter your URL</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Route/Path:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="route"
                                           placeholder="e.g: DahsboardController@index"/>
                                    <span class="form-text text-muted">Please enter your route</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Middleware:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="middleware"
                                           placeholder="e.g: lang,authz"/>
                                    <span class="form-text text-muted">Please enter your middleware</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Permission:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" name="permission" style="width: 100%;">
                                        <option class="form-control"
                                                    value=''>Kosong</option>
                                        @foreach($permissions as $permission)
                                            <option class="form-control"
                                                    value='{{$permission->name}}'> {{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                                    class="fa fa-times"></i>Cancel
                        </button>
                        @can(['routesetting-C' , 'routesetting-U'])
                            <button type="submit" id="saveRoute" data-id="" class="btn btn-primary font-weight-bold">
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

            @can('routesetting-R')

            datatable.KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method: 'GET',
                            url: './routesetting/list'
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
                    field: 'method',
                    title: 'Method',
                    width: 65,
                    template: function (row) {
                        var color = '';
                        switch (row.method) {
                            case 'GET':
                                color = "badge-success";
                                break;
                            case 'DELETE':
                                color = "badge-danger";
                                break;
                            case 'POST':
                                color = "badge-primary";
                                break;

                            default:
                                color = "badge-warning";
                                break;
                        }
                        return `<span class="badge ${color}"">${row.method}</span>`;
                    }
                }, {
                    field: 'url',
                    title: 'URL',
                }, {
                    field: 'route',
                    title: 'Route',
                }, {
                    field: 'type',
                    title: 'Type',
                    width: 50,
                }, {
                    field: 'permission',
                    title: 'Permission',
                }, {
                    field: 'middleware',
                    title: 'Middleware',
                    width: 100,
                }, {
                    field: 'Actions',
                    title: 'Actions',
                    sortable: false,
                    width: 125,
                    autoHide: false,
                    overflow: 'visible',
                    template: function (row) {
                        return "<center>" +
                                @can('routesetting-U')
                                    "<button type='button' class='edits btn btn-sm btn-icon btn-outline-warning ' title='Edit' data-toggle='tooltip' data-id=" + row.id + " ><i class='fa fa-edit'></i></button>  " +
                                @endcan
                                        @can('routesetting-D')
                                    "<button type='button' class='deletes btn-sm btn btn-icon btn-outline-danger' title='Delete' data-toggle='tooltip' alt='' data-id=" + row.id + " ><i class='fa fa-trash'></i></button>  " +
                                @endcan
                                    "</center>";
                    },
                }
                ],

            });

            $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

            @endcan

            @can('routesetting-C')
            $(document).on('click', '#addMenu', function () {
                $("#saveRoute").data("id", "");
                $('#modalRoutesTitle').text('Create Data Route');
                $('#modalRoutes').modal('show');
                $(`.form-control`).removeClass('is-invalid');
                $(`.invalid-feedback`).remove();
                let form = document.forms.formroutes; // <form name="formroutes"> element
                form.reset();
                
                $(form.elements.method).val('GET').trigger('change');
                $(form.elements.type).val('data').trigger('change');
                $(form.elements.guard).val('web').trigger('change');
                $(form.elements.permission).val('').trigger('change');
            });

            @endcan

            @can('routesetting-U')
            $(document).on('click', '.edits', function () {
                $.ajax({
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './routesetting/' + $(this).data('id'), // the url where we want to POST
                    beforeSend: function () {
                        let form = document.forms.formroutes; // <form name="formroutes"> element
                        form.reset();
                    }
                }).done(function (res) {
                    let form = document.forms.formroutes; // <form name="formroutes"> element
                    if (res.success) {
                        showtoastr('success', res.message);
                        $(form.elements.method).val(res.data.method).trigger('change');
                        $(form.elements.type).val(res.data.type).trigger('change');
                        $(form.elements.guard).val(res.data.guard).trigger('change');
                        $(form.elements.url).val(res.data.url);
                        $(form.elements.route).val(res.data.route);
                        $(form.elements.middleware).val(res.data.middleware);
                        $(form.elements.permission).val(res.data.permission).trigger('change');
                        $("#saveRoute").data("id", res.data.id);
                    }
                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.messages, function (index, value) {
                        show_toastr('error', index, value);
                    });
                }).always(function () {
                    $('#modalRoutesTitle').text('Edit Data Route');
                    $('#modalRoutes').modal('show');
                });
            });

            @endcan

            @can(['routesetting-C', 'routesetting-U'])
            $('#formroutes').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($("#formroutes")[0]);
                // var formData = $('#formroutes').serializeArray(); // our data object
                var method = "POST";
                let _ID = $("#saveRoute").data("id");
                var url = (_ID != "") ? `./routesetting/${_ID}` : `./routesetting`;

                $.ajax({
                    type: method, // define the type of HTTP verb we want to use (POST for our form)
                    url: url, // the url where we want to POST
                    data: formData,
                    dataType: 'JSON', // what type of data do we expect back from the server
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#saveRoute').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
                    }
                }).done(function (data) {
                    $("#modalRoutes").modal('hide');
                    showtoastr('success', data.message);
                    $("#saveRoute").data("id", "");
                    $("#formroutes")[0].reset();
                    datatable.reload();
                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.messages, function (index, value) {
                        if ($(`input[name='${index}']`)) {
                            $(`input[name='${index}']`).addClass(`is-invalid`);
                            $(`input[name='${index}']`).after(`<div class="invalid-feedback">${value}</div>`);
                        }
                        show_toastr('error', index, value);
                    });
                }).always(function () {
                    $('#saveRoute').attr('disabled', false).html("<i class='fa fa-save'></i> Save");
                });
            });
            @endcan

            @can('routesetting-D')
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
                        url: './routesetting/' + $(this).data('id'), // the url where we want to POST
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
