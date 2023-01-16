@extends('layouts.main')

@section('title', 'User Management')

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
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">User Management</h5>
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
                            <h3 class="card-label">Data User
                                <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">
                                <button type="button" class="btn btn-light-primary font-weight-bolder"
                                    data-toggle="modal" data-target="#importModal" aria-haspopup="true" aria-expanded="false">
                                    Import
                                </button>
                            </div>
                            <!--end::Dropdown-->
                            <!--begin::Button-->
                            @can('rolesetting-C')
                                <button id="addUser" name="addUser" class="btn btn-primary font-weight-bolder">
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
                                        <div class="col-lg-5 col-xl-4 mt-5 mt-lg-0">
                                            <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--end::Search Form-->
                        <!--end: Search Form-->
                        <!--begin: Datatable-->
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
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
    <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserTitle">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formUsers" id="formUsers" enctype="multipart/formdata" method="">
                    <div class="modal-body">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Username:</label>
                                <div class="col-lg-9">
                                    <input type="text" id="username" class="form-control" name="username"
                                           placeholder="e.g: jhondoe"/>
                                    <span class="form-text text-muted">Please enter your username</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Firstname:</label>
                                <div class="col-lg-9">
                                    <input  type="text" id="firstName" class="form-control" name="first_name"
                                           placeholder="e.g: jhondoe"/>
                                    <span class="form-text text-muted">Please enter your First Name</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Lastname:</label>
                                <div class="col-lg-9">
                                    <input  type="text" id="lastName" class="form-control" name="last_name"
                                           placeholder="e.g: jhondoe"/>
                                    <span class="form-text text-muted">Please enter your Last Name</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Email address:</label>
                                <div class="col-lg-9">
                                    <input type="email" id="email" class="form-control" name="email"
                                           placeholder="e.g: example@gmail.com"/>
                                    <span class="form-text text-muted">We'll never share your email with anyone else</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Roles:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select" id="roles" name="roles"
                                            data-placeholder="Select a role" style="width: 100%;">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Company:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select" id="company" name="company"
                                            data-placeholder="Select a company" style="width: 100%;">
                                        @foreach ($company as $detail)
                                        <option value="{{$detail->company_code}}">{{$detail->company_name}}</option>
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
                        @can(['rolesetting-C' , 'rolesetting-U'])
                            <button type="submit" id="saveUser" data-id="" class="btn btn-primary font-weight-bold">
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
    <div class="modal fade" id="modalUserEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserTitleEdit">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formUsersEdit" id="formUsersEdit" enctype="multipart/formdata" method="">
                    <div class="modal-body">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Username:</label>
                                <div class="col-lg-9">
                                    <input readonly type="text" id="usernameEdit" class="form-control" name="usernameEdit"
                                           placeholder="e.g: jhondoe"/>
                                    <span class="form-text text-muted">Please enter your username</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Firstname:</label>
                                <div class="col-lg-9">
                                    <input  type="text" id="firstNameEdit" class="form-control" name="firstNameEdit"
                                           placeholder="e.g: jhondoe"/>
                                    <span class="form-text text-muted">Please enter your First Name</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Lastname:</label>
                                <div class="col-lg-9">
                                    <input  type="text" id="lastNameEdit" class="form-control" name="lastNameEdit"
                                           placeholder="e.g: jhondoe"/>
                                    <span class="form-text text-muted">Please enter your Last Name</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Email address:</label>
                                <div class="col-lg-9">
                                    <input readonly type="email" id="emailEdit" class="form-control" name="emailEdit"
                                           placeholder="e.g: example@gmail.com"/>
                                    <span class="form-text text-muted">We'll never share your email with anyone else</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Roles:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select" id="rolesEdit" name="rolesEdit"
                                            data-placeholder="Select a role" style="width: 100%;">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Company:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select" id="companyEdit" name="companyEdit"
                                            data-placeholder="Select a company" style="width: 100%;">
                                        @foreach ($company as $detail)
                                        <option value="{{$detail->company_code}}">{{$detail->company_name}}</option>
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
                        @can(['rolesetting-U'])
                            <button type="submit" id="saveUserEdit" data-id="" class="btn btn-primary font-weight-bold">
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

    <!--begin:Modal Reset Password-->
    <div class="modal fade" id="modalResetPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!--begin:Form-->
                <form role="form" class="form" name="formresetpassword" id="formresetpassword"
                      enctype="multipart/formdata" method="">
                    <div class="modal-body">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">New Password:</label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" id="password_first" name="password"
                                           placeholder="e.g: New Password"/>
                                    <span class="form-text text-muted">Please enter your password</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Confirm Password:</label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" id="password_second" name="re-password"
                                           placeholder="e.g: Confirm Password"/>
                                    <span class="form-text text-muted">Please enter your confrm password</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                                    class="fa fa-times"></i>Cancel
                        </button>
                        @can('rolesetting-U')
                            <button type="submit" id="saveResetPass" data-user=""
                                    class="btn btn-primary font-weight-bold">
                                <i class="fa fa-save"></i> Save changes
                            </button>
                        @endcan
                    </div>
                </form>
                <!--end:Form-->
            </div>
        </div>
    </div>
    <!--end:Modal Reset Password-->

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" class="form" enctype="multipart/form-data" action="{{url('uploaduser')}}">
                    <div class="modal-body">
                        <div class="mb-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Template:</label>
                                <div class="col-lg-9">
                                    <button type="button" class="btn btn-primary font-weight-bolder download-excel"
                                        data-toggle="modal" data-target="#importModal" aria-haspopup="true" aria-expanded="false">
                                        Download Template
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Upload:</label>
                                <div class="col-lg-9">
                                    <div class="custom-file">
                                        {{ csrf_field() }}
                                        <input required type="file" name="excel" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><i
                                    class="fa fa-times"></i>Cancel
                        </button>
                        @can('rolesetting-U')
                            <button type="submit" data-user=""
                                    class="btn btn-primary font-weight-bold">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        @endcan
                    </div>
                </form>
                <!--end:Form-->
            </div>
        </div>
        </div>
    </div>
@endsection

@section('js_page')
    <!--begin::Page Vendors(used by this page)-->
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    {{-- <script src="{{ asset('assets/js/pages/crud/ktdatatable/base/data-json.js') }}"></script> --}}
    <!--end::Page Scripts-->

    <script type="text/javascript">

        $(document).ready(function () {

            $('.select').selectpicker();

            var datatable = $('#kt_datatable');

            @can('usersetting-R')

            datatable.KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method: 'GET',
                            url: './usersetting/list'
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
                        field: 'id',
                        title: '#',
                        width: 20,
                        sortable: false,
                        type: 'number',
                        selector: {
                            class: ''
                        },
                        textAlign: 'center',
                    },
                    {
                        field: 'email',
                        title: 'Email',
                    },
                    {
                        field: 'username',
                        title: 'Username',
                    },
                    {
                        field: 'first_name',
                        title: 'First Name',
                    },
                    {
                        field: 'last_name',
                        title: 'Last Name',
                    },
                    {
                        field: 'firstname',
                        title: 'Roles',
                        template: function (row) {
                            let roles = [];
                            $.each(row.roles, function (index, value) {
                                roles.push('<span class="badge badge-primary">' + value['name'] + '</span>');
                            });
                            return roles.join(" , ");
                        }
                    },
                    {
                        field: 'status',
                        title: 'Status',
                        template: function (row) {
                            var status = {
                                'y': {
                                    'title': 'Aktif (Y)',
                                    'state': 'success'
                                },
                                'n': {
                                    'title': 'Tidak Aktif (N)',
                                    'state': 'danger'
                                },
                            };
                            return `
                                    <span class="label label-${status[row.status].state} label-dot mr-2"></span>
                                    <span class="font-weight-bold text-${status[row.status].state}">
                                        ${status[row.status].title}
                                    </span>`;
                        }
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
                                    @can('usersetting-A')
                                        "<button type='button' class='impersonate btn btn-sm btn-icon btn-outline-warning' title='Simulate User' data-toggle='tooltip' data-id=" + row.id + " ><i class='fa fa-eye'></i></button>  " +
                                    @endcan
                                    @can('usersetting-U')
                                        "<button type='button' class='editpasword btn btn-sm btn-icon btn-outline-warning' title='Reset Password' data-toggle='tooltip' data-id=" + row.id + " ><i class='fa fa-key'></i></button>  " +
                                "<button type='button' class='edits btn btn-sm btn-icon btn-outline-warning ' title='Edit' data-toggle='tooltip' data-id=" + row.id + " ><i class='fa fa-edit'></i></button>  " +
                                    @endcan
                                            @can('usersetting-D')
                                        "<button type='button' class='deletes btn-sm btn btn-icon btn-outline-danger' title='Delete' data-toggle='tooltip' alt='' data-id=" + row.id + " ><i class='fa fa-trash'></i></button>  " +
                                    @endcan
                                        "</center>";
                        },
                    }
                ],

            });

            $('#kt_datatable_search_status').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'Status');
            });

            $('#kt_datatable_search_type').on('change', function () {
                datatable.search($(this).val().toLowerCase(), 'Roles');
            });

            $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

            @endcan

            @can('usersetting-C')
            $(document).on('click', '#addUser', function () {
                $("#saveUser").data("id", "");
                $('#modalUserTitle').text('Create Data User');
                $('#modalUser').modal('show');
            });

            $('#formUsers').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($("#formUsers")[0]);
                var method = "POST";
                var url = './usersetting';

                if ($("#saveUser").data("id") != "") {
                    url = "./usersetting/" + $("#saveUser").data("id");
                }

                $.ajax({
                    type: method, // define the type of HTTP verb we want to use (POST for our form)
                    url: url, // the url where we want to POST
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#saveUser').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
                    }
                }).done(function (data) {
                    $("#modalUser").modal('hide');
                    // showtoastr('success',data.message);
                    $("#saveUser").data("id", "");
                    $("#formUsers")[0].reset();
                    var val = 'DEVELOPER';
                    $('#roles option:contains(' + val + ')').prop({selected: true});
                    datatable.reload();

                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.errors, function (index, value) {
                        show_toastr('error', index, value);
                    });

                }).always(function () {
                    $('#saveUser').attr('disabled', false).html("<i class='fa fa-save'></i> Save changes");
                });
            });

            $('#formUsersEdit').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($("#formUsersEdit")[0]);
                var method = "POST";
                var url = './usersetting';

                if ($("#saveUserEdit").data("id") != "") {
                    url = "./usersetting/" + $("#saveUserEdit").data("id");
                }

                $.ajax({
                    type: method, // define the type of HTTP verb we want to use (POST for our form)
                    url: url, // the url where we want to POST
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#saveUserEdit').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
                    }
                }).done(function (data) {
                    $("#modalUserEdit").modal('hide');
                    // showtoastr('success',data.message);
                    $("#saveUserEdit").data("id", "");
                    $("#formUsersEdit")[0].reset();
                    datatable.reload();

                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.messages, function (index, value) {
                        show_toastr('error', index, value);
                    });

                }).always(function () {
                    $('#saveUserEdit').attr('disabled', false).html("<i class='fa fa-save'></i> Save changes");
                });
            });

            @endcan

            @can('usersetting-A')
            $(document).on('click', '.impersonate', function () {
                $.ajax({
                    type: 'GET',
                    url: './usersetting/simulate/' + $(this).data('id'),
                }).done(function (res) {
                    if (res.success) {
                        showtoastr('success', res.message);
                        location.replace('<?= URL::to('/');?>');
                        // location.reload();
                    }
                })
            });
            @endcan

            @can('usersetting-U')
            // $(document).on('click','.assign', function(e){
            //     e.preventDefault();
            //     $("#uuiduser").val($(this).data('id'));
            //     var role = $(this).data('role').split(',');
            //     // console.log($(this).data('id'));
            //     $.each(role, function (index, value){
            //         $("."+value+"checkbox").prop('checked',true);
            //     })
            //     $('#modal-role').modal('show');
            // })

            $(document).on('click', '.edits', function () {
                $.ajax({
                    type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                    url: './usersetting/' + $(this).data('id'), // the url where we want to POST
                    beforeSend: function () {
                        let form = document.forms.formUsers; // <form name="formUsers"> element
                        form.reset();
                    }
                }).done(function (res) {
                    let form = document.forms.formUsersEdit; // <form name="formUsers"> element
                    if (res.success) {
                        showtoastr('success', res.message);
                        $(form.elements.usernameEdit).val(res.data.username);
                        $(form.elements.emailEdit).val(res.data.email);
                        $(form.elements.companyEdit).val(res.data.company_code);
                        $(form.elements.firstNameEdit).val(res.data.first_name);
                        $(form.elements.lastNameEdit).val(res.data.last_name);
                        $('#companyEdit').val(res.data.company_code).change();
                        $('#rolesEdit').val(res.data.role_name[0]).change();
                        $("#saveUserEdit").data("id", res.data.id);
                    }
                    // form.elements.username; // <input name="one"> element
                }).fail(function (data) {
                    show_toastr('error', data.responseJSON.status, data.responseJSON.message);
                    $.each(data.responseJSON.messages, function (index, value) {
                        show_toastr('error', index, value);
                    });
                }).always(function () {
                    $('#modalUserTitleEdit').text('Edit Data User');
                    $('#modalUserEdit').modal('show');
                });
            });

            $(document).on('click', '.editpasword', function (e) {
                e.preventDefault();
                $('#modalResetPass').modal('show');
                $('#saveResetPass').data('uuid', $(this).data('id'));
            });

            $('#formresetpassword').submit(function (event) {
                event.preventDefault();
                let uuid = $('#saveResetPass').data('uuid');
                var formdata = $('#formresetpassword').serializeArray();
                formdata.push({'name': 'uuid', 'value': uuid});

                $.ajax({
                    type: 'PUT',
                    url: './usersetting/resetpassword/' + $('#saveResetPass').data('uuid'),
                    data: formdata,
                })
                    .done(function (res) {
                        $('#modalResetPass').modal('hide');
                        if (res.success) {
                            showtoastr('success', res.data.message, 'password');
                        }
                    })
                    .fail(function (data) {
                        showtoastr('error', 'gagal di reset', 'password');
                        $.each(data.responseJSON.message, function (index, value) {
                            showtoastr('error', value, index);
                        });
                    })
                    .always(function (e) {
                        document.forms.formresetpassword.reset();
                    });

            });

            $('#modalResetPass').on('hidden.bs.modal', function (e) {
                document.forms.formresetpassword.reset();
            });

            $('#updatemenus').submit(function (event) {
                // event.preventDefault();

                // var uuid =$('#uuiduser').val();
                // var arr = $('#updatemenus').serializeArray();
                // var arrRole = [] ;
                // $.each(arr, function(index,value){
                // arrRole.push(value['value']);
                // })

                // $.ajax({
                //     type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                //     url: './usersetting/synronroles/'+uuid, // the url where we want to POST
                //     data: {'data' : arrRole}, // our data object
                //     dataType: 'json', // what type of data do we expect back from the server
                //     beforeSend:function(){
                //         $(".formlabel").addClass("sr-only");
                //         $('#btnUpdate').attr('disabled',true).html("<i class='fa fa-spinner fa-spin'></i> processing");
                //     }
                // }).done(function(data) {
                //     $('.name').text(''); // Label Error name Role
                //     showtoastr(data.status_txt, data.message, data.status_txt);
                //     $('#updatemenus')[0].reset();
                //     $("#modal-role").modal('hide');
                // }).fail(function(data) {
                //     // var datas = JSON.parse(data.re);
                //     $.each(data.responseJSON.message,function(index,value){
                //         showtoastr('error', value, index );
                //         $('.label'+index).removeClass("sr-only");
                //         $('.label'+index).text(value);
                //     });
                // }).always(function() {
                //     $('#btnUpdate').attr('disabled',false).html("<i class='fa fa-save'></i> Save");
                //     tables.ajax.reload();
                // });
            });

            @endcan
            @can('usersetting-D')
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
                        url: './usersetting/destroy/' + $(this).data('id'), // the url where we want to POST
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

            $(document).on('click', '.download-excel', function() {
                window.open('./templateuser', '_blank');
            });

        });


    </script>

@endsection
