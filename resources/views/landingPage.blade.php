@extends('layouts.main')

@section('title', 'Landing Page')

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
                        <i class="fa fa-layer-group text-warning"></i>
                    </span>
                    <!--end::Page Title-->
                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Landing Page</h5>
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
                            <h3 class="card-label">Data Landing Page
                                <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            @can('landingPage-C')
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
                                <div class="col-lg-6 col-xl-8">
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
                                        <div class="col-md-4 my-2 my-md-0">
                                            <div class="d-flex align-items-center">
                                                <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                <select class="form-control" id="kt_datatable_search_status">
                                                    <option value="">All</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
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
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalMenuTitle">Create Landing Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formmenus" id="formmenus" enctype="multipart/formdata" method="">
                    <div class="modal-body" style="height: 450px;">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Urutan:</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="urutan" name="urutan"
                                           placeholder="e.g: 1"/>
                                    <span class="form-text text-muted">Masukkan nomor urutan</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama/Judul:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="judul" name="judul"
                                           placeholder="e.g: Perayaan HUT PT Petrokimia Gresik"/>
                                    <span class="form-text text-muted">Masukkan nama/judul</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Gambar:</label>
                                <div class="col-lg-9">
                                    <img class="img-preview img-fluid mb-3 col-sm-5" style="max-height: 150px">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="gambar" name="gambar" onchange="previewImage()"/>
                                        <label class="custom-file-label" for="gambar">Choose file</label>
                                    </div>
                                    <span class="form-text text-muted">Upload gambar</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">URL/link:</label>
                                <div class="col-lg-9">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3">https://</span>
                                        <input type="text" class="form-control" id="url" name="url" aria-describedby="basic-addon3" placeholder="e.g: petroport.petrokimia-gresik.com/" >
                                    </div>
                                    <span class="form-text text-muted">Masukkan URL/link</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Status:</label>
                                <div class="col-lg-9">
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="form-text text-muted">Pilih status</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                                    class="fa fa-times"></i>Cancel
                        </button>
                        @can(['landingPage-C' , 'landingPage-U'])
                            <button type="submit" id="saveMenu" data-uuid="" class="btn btn-primary font-weight-bold">
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

            @can('landingPage-R')

            datatable.KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method: 'GET',
                            url: './landingpage/list'
                        }
                    },
                    pageSize: 10,
                },
                // layout definition
                layout: {
                    scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
                    footer: false // display/hide footer
                },
                rows: {
                    autoHide: false
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
                        field: 'urutan',
                        title: 'Urutan',
                    }, {
                        field: 'judul',
                        title: 'Judul',
                    }, {
                        field: 'gambar',
                        title: 'Gambar',
                        template: function (row) {
                            return "<img src='{{ asset('images/landingpage') }}/" + row.gambar + "' width='100px' height='100px' alt=''>";
                        }
                    }, {
                        field: 'url',
                        title: 'URL',
                        width: 200,
                    }, {
                        field: 'status',
                        title: 'Status',
                        template: function (row) {
                            var status = {
                                1: {'title': 'Active', 'class': 'label-light-success'},
                                0: {'title': 'Inactive', 'class': ' label-light-danger'},
                            };
                            return '<span class="label label-lg font-weight-bold ' + status[row.status].class + ' label-inline">' + status[row.status].title + '</span>';
                        },
                    }, {
                        field: 'Actions',
                        title: 'Actions',
                        sortable: false,
                        width: 125,
                        autoHide: false,
                        overflow: 'visible',
                        template: function (row) {
                            return "<center>" +
                                    @can('landingPage-U')
                                        "<button type='button' class='edits btn btn-sm btn-icon btn-outline-warning ' title='Edit' data-toggle='tooltip' data-uuid=" + row.uuid + " ><i class='fa fa-edit'></i> </button>  " +
                                    @endcan
                                            @can('landingPage-D')
                                        "<button type='button' class='deletes btn-sm btn btn-icon btn-outline-danger' title='Delete' data-toggle='tooltip' alt='' data-uuid=" + row.uuid+ " ><i class='fa fa-trash'></i></button>  " +
                                    @endcan
                                        "</center>";
                        },
                    }
                ],


            });

            $('#kt_datatable_search_status').on('change', function () {
                $('#kt_datatable_menu').KTDatatable('search', $(this).val().toLowerCase(), 'status');
            });
            @endcan

            @can('landingPage-C')
            $(document).on('click', '#addMenu', function () {
                $("#saveMenu").data("id", "");
                $('#modalMenuTitle').text('Create Landing Page');
                $('#modalMenu').modal('show');
                $(`.form-control`).removeClass('is-invalid');
                $(`.invalid-feedback`).remove();
                let form = document.forms.formmenus; // <form name="formmenus"> element
                form.reset();
                resetPreviewImage();
                $(form.elements.parent_company_code).val('').trigger('change');
            });

            @endcan

            @can('landingPage-U')
            $(document).on('click', '.edits', function () {
                $.ajax({
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './landingpage/' + $(this).data('uuid'), // the url where we want to POST
                    beforeSend: function () {
                        let form = document.forms.formmenus; // <form name="formmenus"> element
                        form.reset();
                        resetPreviewImage();
                        $(`.form-control`).removeClass('is-invalid');
                        $(`.invalid-feedback`).remove();
                    }
                }).done(function (res) {
                    let form = document.forms.formmenus; // <form name="formmenus"> element
                    console.log(res.success);
                    if (res.success) {
                        const imgPreview = document.querySelector('.img-preview');
                        show_toastr('success', res.message);
                        $('#urutan').val(res.data.urutan);
                        $('#judul').val(res.data.judul);
                        $('#url').val(res.data.url);
                        $(".custom-file-input").siblings(".custom-file-label").html(res.data.gambar);
                        imgPreview.src = '{{ asset('images/landingpage') }}/' + res.data.gambar;
                        $('#status').val(res.data.status).trigger('change');
                        $("#saveMenu").data("uuid", res.data.uuid);
                    }
                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.errors, function (index, value) {
                        show_toastr('error', index, value);
                    });
                }).always(function () {
                    $('#modalMenuTitle').text('Edit Data Landing Page');
                    $('#modalMenu').modal('show');
                });
            });

            @endcan

            @can(['landingPage-C', 'landingPage-U'])
            $('#formmenus').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($("#formmenus")[0]);
                // var formData = $('#formmenus').serializeArray(); // our data object
                var method = "POST";
                let menuID = $("#saveMenu").data("uuid");
                
                if (typeof menuID == "undefined" || menuID == "") {
                    var url = `./landingpage`;
                } else {
                    var url = `./landingpage/${menuID}/update`;
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
                    show_toastr('success', data.message);
                    $("#saveMenu").data("uuid", "");
                    $("#formmenus")[0].reset();
                    menuID = "";
                    let form = document.forms.formmenus; // <form name="formmenus"> element
                    form.reset();
                    resetPreviewImage();
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

            @can('landingPage-D')
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
                        url: './landingpage/' + $(this).data('uuid'), // the url where we want to POST
                    })
                    .done(function (data) {
                        show_toastr('success', data.message);
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

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
        var filename = $('input[type=file]')[0].files.length ? ('input[type=file]')[0].files[0].name : "";
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        function previewImage() {
            const gambar = document.querySelector('#gambar');
            const gambarLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            gambarLabel.textContent = gambar.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        function resetPreviewImage() {
            const gambar = document.querySelector('#gambar');
            const gambarLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            gambarLabel.textContent = 'Choose file';
            imgPreview.src = '';
            gambar.value = '';
        }
    </script>

@endsection
