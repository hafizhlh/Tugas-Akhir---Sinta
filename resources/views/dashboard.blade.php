@extends('layouts.main')

@section('title', 'Dashboard')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    <span class="text-muted font-weight-bold mr-4">
                        <i class="fa fa-tachometer-alt text-warning"></i>
                    </span>
                    <!--end::Page Title-->
                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                    <!--end::Actions-->
                </div>
                <div>
                    <span class="mr-2 d-none d-lg-inline text-dark my-auto" id="time"></span>
                </div>
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
              <div style="background-color: rgb(255, 255, 255); min-height: 90vh; background-image: url({{url('assets/img/bg-testing.jpg')}}); background-repeat: no-repeat; background-size: 52%; background-position: center center;"></div>
                {{--  ==============================   --}}
                {{--  =======      ISI DASHBOARD    ==============   --}}
                {{--  ==============================   --}}
            </div>
            <!--end::Container-->
        </div>
    </div>
@endsection

@section('js_page')
@endsection
