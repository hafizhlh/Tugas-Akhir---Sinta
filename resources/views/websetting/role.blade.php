@extends('layouts.main')

@section('title', 'Role')

@section('css_page')
    <!-- BEGIN VENDOR CSS-->
    <!-- END VENDOR CSS-->

    <!-- BEGIN Page Level CSS-->
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
                        <i class="fa fa-user text-warning"></i>
                    </span>
                    <!--end::Page Title-->
                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Role</h5>
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
                            <h3 class="card-label">Data Role
                                <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                        </div>
                        <div class="card-toolbar">                            
                            <!--begin::Button-->
                            @can('rolesetting-C')
                                <button id="addRole" name="addRole" class="btn btn-primary font-weight-bolder">
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
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable_role"></div>
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
    <div class="modal fade" id="modalRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRoleTitle">Create Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formrole" id="formrole" enctype="multipart/formdata" method="">
                    <div class="modal-body">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Role:</label>
                                <div class="col-lg-9">
                                    <input type="text" id="formrole_role" class="form-control" name="name"
                                           placeholder="e.g: admin" required="true"/>
                                    <span class="form-text text-muted">Please enter your role</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Description:</label>
                                <div class="col-lg-9">
                                    <input type="text" id="formrole_desc" class="form-control" name="desc"
                                           placeholder="e.g: get all privilage ..."/>
                                    <span class="form-text text-muted">Please enter your description</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                                    class="fa fa-times"></i>Cancel
                        </button>
                        @can(['rolesetting-C' , 'rolesetting-U'])
                            <button type="submit" id="saveRole" data-id="" class="btn btn-primary font-weight-bold">
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

    <!--begin:Modal-->
    <div class="modal fade" id="modalaccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRoleTitle">Create Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formrole" id="updateroles" enctype="multipart/formdata" method="">
                    <div class="modal-body">
                        <div class="mb-7">
                            <div class="form-group row">
                                @php
                                $lastMenu = "";
                                $lastMenuC = "";
                                $ic = 0;
                                @endphp
                                @foreach($permissions as $k=> $permission)
                                <div class='col-lg-12 inline-checkbox'>
                                <label class='col-form-label'><b>{{strtoupper($permission->name)}}</b></label><br>
                                    @foreach($permission->permissionMenu as $permis)
                                    <label class="checkbox">
                                        <input type="checkbox" class="ok{{$permis->name}}"
                                        data-sidebar="{{substr($permis->name, 0, -2)}}"
                                        value="{{$permis->name}}" name="permission[]">
                                        <span></span>{{$permis->action->name}}</label>&nbsp;           
                                    @endforeach
                                    @foreach($permission->menuChilds as $k1=> $mc)
                                        <div class='col-lg-12 inline-checkbox'>
                                            <label class='col-form-label'><b>- {{strtoupper($mc->name)}}</b></label><br>
                                        @foreach($mc->permissionMenu as $permis)
                                            <label class="checkbox">
                                                <input type="checkbox" class="ok{{$permis->name}}"
                                                        data-sidebar="{{substr($permis->name, 0, -2)}}"
                                                        value="{{$permis->name}}" name="permission[]">
                                                <span></span>{{$permis->action->name}}</label>&nbsp;
                                        @endforeach
                                        </div>
                                        @php
                                        if($k1+1==count($permission->menuChilds) && $k+1<count($permissions))
                                        echo "<hr>";
                                        @endphp
                                    @endforeach
                                    @php
                                    if(count($permission->menuChilds)==0)
                                        echo "<hr>";
                                    @endphp   
                                </div>
                                
                                @endforeach 
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                                    class="fa fa-times"></i>Cancel
                        </button>
                        @can(['rolesetting-C' , 'rolesetting-U'])
                            <button type="submit" id="saveRole1" data-id="" class="btn btn-primary font-weight-bold">
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
    {{-- <script src="{{ asset('assets/js/pages/crud/ktdatatable/base/data-json.js') }}"></script> --}}
    <!--end::Page Scripts-->

    <script type="text/javascript">

        $(document).ready(function () {

            window.rolesid = 0;

            var datatable = $('#kt_datatable_role');

            @can('rolesetting-R')

            datatable.KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method: 'GET',
                            url: './rolesetting/list'
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
                        field: 'name',
                        title: 'Role Name',
                    },
                    {
                        field: 'desc',
                        title: 'Description',
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
                                    @can('rolesetting-U')
                                        "<button type='button' class='access btn btn-sm btn-icon btn-outline-warning ' title='Assign Permission' data-toggle='tooltip' data-id=" + row.id + " ><i class='fa fa-user'></i></button>  " +
                                "<button type='button' class='edits btn btn-sm btn-icon btn-outline-warning ' title='Edit' data-toggle='tooltip' data-id=" + row.id + " ><i class='fa fa-edit'></i></button>  " +
                                    @endcan
                                            @can('rolesetting-D')
                                        "<button type='button' class='deletes btn-sm btn btn-icon btn-outline-danger' title='Delete' data-toggle='tooltip' alt='' data-id=" + row.id + " ><i class='fa fa-trash'></i></button>  " +
                                    @endcan
                                        "</center>";
                        },
                    }
                ],

            });

            $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

            @endcan

            @can('rolesetting-C')
            $(document).on('click', '#addRole', function () {
                $("#saveRole").data("id", "");
                $('#modalRoleTitle').text('Create Data Role');
                $('#modalRole').modal('show');
                $("#formrole")[0].reset();
            });

            @endcan

            @can('rolesetting-U')
            $(document).on('click', '.edits', function () {
                $.ajax({
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './rolesetting/' + $(this).data('id'), // the url where we want to POST
                    beforeSend: function () {
                        let form = document.forms.formrole; // <form name="formrole"> element
                        form.reset();
                    }
                }).done(function (res) {
                    let form = document.forms.formrole; // <form name="formrole"> element
                    if (res.success) {
                        showtoastr('success', res.message);
                        $(form.elements.name).val(res.data.name);
                        $(form.elements.desc).val(res.data.desc);
                        $("#saveRole").data("id", res.data.id);
                    }
                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.messages, function (index, value) {
                        show_toastr('error', index, value);
                    });
                }).always(function () {
                    $('#modalRoleTitle').text('Edit Data Role');
                    $('#modalRole').modal('show');
                });
            });

            $(document).on('click', '.access', function () {
                event.preventDefault();
                var id = $(this).data('id');
                $('#saveRole1').data("id", id);
                $.ajax({
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './rolesetting/showpermission/' + id, // the url where we want to POST
                    dataType: 'json', // what type of data do we expect back from the server
                }).done(function (data) {
                    $.each(data.data.data, function (index, value) {
                        $(".ok" + value['name']).prop("checked", true);
                    });
                    $("#role_name").val(data.data.test.name);
                    $("#rolesid").val(data.data.test.id);
                    $('#modalaccess').modal('show');
                }).fail(function (data) {
                    showtoastr('error', 'Check Connection', 'Please Check Your Connection');
                }).always(function () {

                });
            });

            $("#updateroles").submit(function (event) {
                event.preventDefault();
                var arr = $('#updateroles').serializeArray();
                let roleID = $("#saveRole1").data("id");
                var newarray = arr.map(obj => {
                    let newObj = {};
                newObj['rolesid'] = $("#roles_id").val();
                newObj['value'] = obj.value;
                newObj['sidebar'] = $(".ok" + obj.value).data('sidebar');
                return newObj;
            })
                ;
                // console.log(newarray);
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: './rolesetting/' + roleID + '/syncrnpermission', // the url where we want to POST
                    data: {'datas': newarray}, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    beforeSend: function () {
                        $('#btnUpdate').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
                    }
                }).done(function (data) {
                    $('.name').text(''); // Label Error name Role
                    showtoastr(data.status_txt, data.message, data.status_txt);
                    $('#updateroles')[0].reset();
                    $("#modalaccess").modal('hide');
                }).fail(function (data) {
                    $.each(data.responseJSON.message, function (index, value) {
                        showtoastr('error', value, index);
                        $('.label' + index).removeClass("sr-only");
                        $('.label' + index).text(value);
                    });
                }).always(function () {
                    $('#btnUpdate').attr('disabled', false).html("<i class='fa fa-save'></i> Save");
                });
            });

            @endcan

            @can(['rolesetting-C', 'rolesetting-U'])
            $('#formrole').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($("#formrole")[0]);
                // var formData = $('#formrole').serializeArray(); // our data object
                var method = "POST";
                let roleID = $("#saveRole").data("id");
                var url = (roleID != "") ? `./rolesetting/${roleID}` : `./rolesetting`;

                $.ajax({
                    type: method, // define the type of HTTP verb we want to use (POST for our form)
                    url: url, // the url where we want to POST
                    data: formData,
                    dataType: 'JSON', // what type of data do we expect back from the server
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#saveRole').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
                    }
                }).done(function (data) {
                    $("#modalRole").modal('hide');
                    showtoastr('success', data.message);
                    $("#saveRole").data("id", "");
                    $("#formrole")[0].reset();
                    datatable.reload();
                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.messages, function (index, value) {
                        show_toastr('error', index, value);
                    });
                }).always(function () {
                    $('#saveRole').attr('disabled', false).html("<i class='fa fa-save'></i> Save");
                });
            });
            @endcan

            @can('rolesetting-D')
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
                        url: './rolesetting/' + $(this).data('id'), // the url where we want to POST
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
