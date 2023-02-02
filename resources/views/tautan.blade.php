@extends('layoutLanding.main')

@section('title', 'Tautan')
@section('css_page')
<!-- Fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
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
                <h1 class="display-4 mb-3 animated slideInDown text-center">Tautan</h1>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- FAQs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">Daftar Aplikasi Internal</h1>
                <p class="text-primary fs-5 mb-5">Frequently Asked Questions</p>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-6 content">
                    <div class="blog-post">
                        <div class="blog-post__img">
                            <img src="{{ asset('LandingPage/img/logo-petro.png') }}" alt="">
                        </div>
                        <div class="blog-post__info">
                            <div class="blog-post__date">
                                <span>
                                    <i class="fa-solid fa-globe text-primary p-2"></i>
                                    <i class="fa-brands fa-android text-success p-2"></i>
                                    <i class="fa-brands fa-apple text-dark p-2"></i>
                                </span>
                            </div>
                            <h1 class="blog-post__title">Petrokimia gresik</h1> <hr>
                            <div class="blog-post__text">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="card-text">URL</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text"><a href="https://petrokimia-gresik.com/">https://petrokimia-gresik.com/</a></p>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <p class="card-text">Status</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text">
                                            <span class="badge bg-success">Active</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-toolbar">
                                <a href="#" class="blog-post__cta launch">launch</a>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="col-lg-6 content">
                    <div class="blog-post">
                        <div class="blog-post__img">
                            <img src="{{ asset('LandingPage/img/logopetroport.png') }}" alt="">
                        </div>
                        <div class="blog-post__info">
                            <div class="blog-post__date">
                                <span>
                                    <i class="fa-solid fa-globe text-primary p-2"></i>
                                    <i class="fa-brands fa-android text-success p-2"></i>
                                    <i class="fa-brands fa-apple text-dark p-2"></i>
                                </span>
                            </div>
                            <h1 class="blog-post__title">Petroport</h1> <hr>
                            <div class="blog-post__text">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="card-text">URL</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text"><a href="https://petrokimia-gresik.com/">https://petrokimia-gresik.com/</a></p>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <p class="card-text">Status</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text">
                                            <span class="badge bg-danger">Inactive</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="blog-post__cta launch">launch</a>
                        </div>
                    </div> 
                </div>

                <div class="col-lg-6 content">
                    <div class="blog-post">
                        <div class="blog-post__img">
                            <img src="{{ asset('LandingPage/img/logo-petro.png') }}" alt="">
                        </div>
                        <div class="blog-post__info">
                            <div class="blog-post__date">
                                <span>
                                    <i class="fa-solid fa-globe text-primary p-2"></i>
                                    <i class="fa-brands fa-android text-success p-2"></i>
                                    <i class="fa-brands fa-apple text-dark p-2"></i>
                                </span>
                            </div>
                            <h1 class="blog-post__title">Petrokimia gresik</h1> <hr>
                            <div class="blog-post__text">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="card-text">URL</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text"><a href="https://petrokimia-gresik.com/">https://petrokimia-gresik.com/</a></p>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <p class="card-text">Status</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text">
                                            <span class="badge bg-success">Active</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-toolbar">
                                <a href="#" class="blog-post__cta launch">launch</a>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="col-lg-6 content">
                    <div class="blog-post">
                        <div class="blog-post__img">
                            <img src="{{ asset('LandingPage/img/logopetroport.png') }}" alt="">
                        </div>
                        <div class="blog-post__info">
                            <div class="blog-post__date">
                                <span>
                                    <i class="fa-solid fa-globe text-primary p-2"></i>
                                    <i class="fa-brands fa-android text-success p-2"></i>
                                    <i class="fa-brands fa-apple text-dark p-2"></i>
                                </span>
                            </div>
                            <h1 class="blog-post__title">Petroport</h1> <hr>
                            <div class="blog-post__text">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="card-text">URL</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text"><a href="https://petrokimia-gresik.com/">https://petrokimia-gresik.com/</a></p>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <p class="card-text">Status</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text">
                                            <span class="badge bg-success">Active</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="blog-post__cta launch">launch</a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs Start -->
@endsection
