@extends('layoutLanding.main')

@section('title', 'Security')
@section('css_page')
<!-- datatable bootstrap-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

<style>
    .page-item.active .page-link{
        z-index: 3;
        color: #fff;
        background-color: #1b9920 !important;
        border-color: #1b9920 !important;
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        --bs-table-accent-bg: rgb(76 175 80 / 30%);
        color: var(--bs-table-striped-color);
    }
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }

    .blog-post{
        width: 100%;
        max-width: 60rem;
        padding: 1rem;
        background-color: #fff;
        box-shadow: 0 1.4rem 8rem rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        border-radius: .8rem;
    }

    .blog-post__img{
        min-width: 20rem;
        max-width: 20rem;
        height: 15rem;
        transform: translateX(-5rem);
        position: relative;
        background-color: #fff;
    }

    .blog-post__img img{
        max-width: 150px;
        max-height: 150px;
        width: 100%;
        position: absolute;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .blog-post__img::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: .8rem;
        box-shadow: .5rem .5rem 3rem 1px rgba(0, 0, 0, 0.5);
    }

    .blog-post__date span{
        display: block;
        font-size: 1.2rem;
        font-weight: 700;
        color: rgba(0, 0, 0, 0.5);
        margin: .2rem 0;
    }

    .blog-post__title{
        font-size: 1.4rem;
        font-weight: 700;
        color: #40a400;
        margin: 1rem 0 1rem;
        text-transform: uppercase;
    }

    .blog-post__text{
        font-size: 0.9rem;
        font-weight: 400;
        color: rgba(0, 0, 0, 0.7);
        margin-bottom: 2rem;
    }

    .blog-post__cta{
        display: inline-block;
        font-size: 0.6rem;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
        background-image: linear-gradient(to right, #40a400, #9bdc02);
        padding: 1rem 2rem;
        border-radius: .8rem;
        transition: all .3s;
    }

    .blog-post__cta:hover{
        transform: translateY(-.3rem);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.2);
        background-image: linear-gradient(to right, #9bdc02, #40a400);
        color: #fff;
    }

    .launch{
        background-image: linear-gradient(to right, #0048ff, #02cedc);
    }

    .launch:hover{
        background-image: linear-gradient(to right, #02cedc, #0048ff);
    }

    .content{
        padding: 40px;
    }

    .py-6{
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }

    @media screen and (max-width: 868px){
        .blog-post{
            max-width: 30rem;
        }

    }

    @media screen and (max-width: 768px){
        .blog-post{
            padding: 1rem;
            flex-direction: column;
        }

        .blog-post__img{
            min-width: 100%;
            max-width: 100%;
            transform: translate(0, -5rem);
        }

        .content{
            padding: 50px;
        }
    }
</style>
@endsection

@section('content')

     <!-- Header Start -->
     <div style="position: absolute; z-index: 2; width: 100%; text-align: right;">
        <div class="top-corner">
            <img src="{{ asset('LandingPage/img/logobumnterbaru2020.png') }}" alt="" style="width: 100px;">
            <img src="{{ asset('LandingPage/img/logo-petro.png') }}" alt=" " style="width: 100px;">
            <img src="{{ asset('LandingPage/img/PUPUK_INDONESIA.png') }}" alt="" style="width: 100px;">
        </div>
    </div>
    <div class="container-fluid hero-header bg-light py-5 mb-5" style="background-image: url('/LandingPage/img/Frame 15.png'); background-size: cover; background-repeat: no-repeat;">
        <div class="container py-6">
            <div style="margin: auto; width: 50%; padding: 10px;">
                <h1 class="display-4 mb-3 animated slideInDown text-center">Security Awarness</h1>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- FAQs Start -->
    <div class="container-xxl py-5" id="poster">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">POSTER</h1>
                <p class="text-primary fs-5 mb-5">Frequently Asked Questions</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>

                <div class="col-lg-3">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
                <div class="col-lg-3 more">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
                <div class="col-lg-3 more">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
                <div class="col-lg-3 more">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
                <div class="col-lg-3 more">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
                <div class="col-lg-3 more">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
                <div class="col-lg-3 more">
                    <div class="card mb-4 mt-4 shadow-lg wow fadeInLeft" style="width: 18rem;">
                        <img src="{{ asset('LandingPage/img/poster.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body">
                          <h5 class="card-title">Special title treatment</h5>
                          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer text-muted">
                            12 Januari 2023
                        </div>
                      </div>
                </div>
            </div>
            <div class="text-center m-5">
                <button class="btn btn-success btn-lg" id="more-poster">Show More</button>
            </div>
        </div>
    </div>;
    <!-- FAQs Start -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">Download Materi</h1>
                <p class="text-primary fs-5 mb-5">Frequently Asked Questions</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped" id="materi-security">
                            <thead class="bg-success">
                                <tr>
                                  <th scope="col" class="text-white">#</th>
                                  <th scope="col" class="text-white">NAMA</th>
                                  <th scope="col" class="text-white">FITUR</th>
                                  <th scope="col" class="text-white">LINK DOWNLOAD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <th class="text-dark" scope="row">1</th>
                                  <td class="text-dark">E-book perjanjian kerja bersama 2021-2023</td>
                                  <td class="text-dark fst-italic">Administrasi</td>
                                  <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                </tr>
                                <tr>
                                  <th class="text-dark" scope="row">2</th>
                                  <td class="text-dark">Surat Pernyataan Pengunduran diri sebagai peserta penerima bantuan</td>
                                  <td class="text-dark fst-italic">Administrasi</td>
                                  <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                </tr>
                                <tr>
                                  <th class="text-dark" scope="row">3</th>
                                  <td class="text-dark">Form persetujuan peserta JKN-KIS</td>
                                  <td class="text-dark fst-italic">Administrasi</td>
                                  <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                </tr>
                                <tr>
                                    <th class="text-dark" scope="row">4</th>
                                    <td class="text-dark">E-book perjanjian kerja bersama 2021-2023</td>
                                    <td class="text-dark fst-italic">Administrasi</td>
                                    <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                  </tr>
                                  <tr>
                                    <th class="text-dark" scope="row">5</th>
                                    <td class="text-dark">Surat Pernyataan Pengunduran diri sebagai peserta penerima bantuan</td>
                                    <td class="text-dark fst-italic">Administrasi</td>
                                    <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                  </tr>
                                  <tr>
                                    <th class="text-dark" scope="row">6</th>
                                    <td class="text-dark">Form persetujuan peserta JKN-KIS</td>
                                    <td class="text-dark fst-italic">Administrasi</td>
                                    <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                  </tr>
                                  <tr>
                                    <th class="text-dark" scope="row">7</th>
                                    <td class="text-dark">E-book perjanjian kerja bersama 2021-2023</td>
                                    <td class="text-dark fst-italic">Administrasi</td>
                                    <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                  </tr>
                                  <tr>
                                    <th class="text-dark" scope="row">8</th>
                                    <td class="text-dark">Surat Pernyataan Pengunduran diri sebagai peserta penerima bantuan</td>
                                    <td class="text-dark fst-italic">Administrasi</td>
                                    <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                  </tr>
                                  <tr>
                                    <th class="text-dark" scope="row">9</th>
                                    <td class="text-dark">Form persetujuan peserta JKN-KIS</td>
                                    <td class="text-dark fst-italic">Administrasi</td>
                                    <td><button class="btn btn-warning btn-sm">Link Download</button></td>
                                  </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_page')
<!--Datatable-->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#materi-security');
        var otable = table.DataTable({
            "ordering": false,
            "searching": false,
        });
    $('.dataTables_length').addClass('bs-select');

    // show more
    $(".more").css("display", "none");
    $('#more-poster').on('click', function () {
        let text = $(this).html();
        if (text == "Show More") {
            $(this).html("Show Less");
            $(".more").css("display", "block");
        } else {
            $(this).html("Show More");
            $(".more").css("display", "none");
        }
    });
});
</script> 
@endsection