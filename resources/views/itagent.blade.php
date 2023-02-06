@extends('layoutLanding.main')

@section('title', 'IT Agent')
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

    /* it agent */
    .box-item{
        margin-bottom: 30px;
    }
    img{
        max-width: 100%;
    }
    .box-item img{
        height: 100%;
        max-height: 300px;
        width: 100%;
        object-fit: cover;
    }
    .box-menu{
        text-align: center;
    }
    .box-menu ul{
        padding: 0;
        margin: 0;
        list-style: none;
    }
    .box-menu ul li{
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 50px;
        cursor:pointer;
        margin-bottom: 60px;
        margin: 10px 4px 20px 10px;
        background: #F8C600;
        padding: 10px 30px;
        display: inline-block;
        color:#FFFFFF;

    }
    .card-it {
        width: 250px;
        min-width: 250px;
        height:auto;
        background:#fff;
        border-radius:10px;
        position:relative;
        z-index:10;
        margin:25px;
        min-height:356px;
        cursor:pointer;
        transition: all .25s ease;
        box-shadow: 0px 0px 0px 0px rgba(0,0,0, .08);
        border-top: 3px solid #1b9920;
        border-right: 3px solid #F8C600;
    }

    .card-it:hover {
        transform:translate(0, -10px);
        box-shadow: 0px 17px 35px 0px rgba(0,0,0,.07);
        border-top: 3px solid #F8C600;
        border-right: 3px solid #1b9920;
    }

    .card-it i {
        position:absolute;
        right: 0;
        top: 0;
        padding: 15px;
        font-size:1.4rem;
        line-height:3.2rem;
    }

    .card-it .card-text {
        padding: 20px;
    }

    .card-it .card-img {
        transform: translate(52px,30px);
        margin: 0 30px;
        display:flex;
        align-items: center;
        justify-content:center;
        transition: all .35s ease-out;
        margin-bottom: 40px;
    }

    .card-it img {
        position: relative;
        height:150px;
        width: 150px;
        border-radius: 50%;
        object-fit: cover;
        object-position: center;
        box-shadow: 0px 0px 0px 0px rgba(0,0,0, .08);
        transition: all .35s ease-out;
    }

    .card-it img.blur {
        position:absulute;
        filter:blur(15px);
        z-index:-1;
        opacity:.40;
        transform: translate(-160px,30px);
        transition: all .35s ease-out;
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
            <h1 class="display-4 mb-3 animated slideInDown text-center">IT Agent</h1>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- IT-Agent Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">IT Agent</h1>
            <p class="text-primary fs-5 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="box-menu">
                    <ul>
                       <li class="mixitup-control-active" data-filter="all">all</li> 
                        <li data-filter=".photo">photography</li>
                        <li data-filter=".ui">ui</li>
                        <li data-filter=".paint">painting</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row box-list justify-content-center">
            <div class="col-lg-3 min box-item mix photo">
                <!-- Card -->
                <div class="card-it">
                    <div class="card-img">
                        <img src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                        <img class="blur" src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                    </div>
                    <div class="card-text text-center">
                        <h2 style="background: radial-gradient(farthest-corner at 45px 45px,#987315, #9b7c16, #d4af37, #544411);-webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;">Julliet Valvanova</h2>
                        <hr style="height:3px;border:none;color:#5e4d13;background-color:#5e4d13; width: 50%; margin: auto; opacity: 1;" />
                        <h4 class="mt-3">CEO<h4>
                    </div>
                </div>
                <!-- Card End -->
            </div>
            <div class="col-lg-3 min box-item mix ui">
                <!-- Card -->
                <div class="card-it">
                    <div class="card-img">
                        <img src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                        <img class="blur" src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                    </div>
                    <div class="card-text text-center">
                        <h2 style="background: radial-gradient(farthest-corner at 45px 45px,#987315, #9b7c16, #d4af37, #544411);-webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;">Julliet Valvanova</h2>
                        <hr style="height:3px;border:none;color:#5e4d13;background-color:#5e4d13; width: 50%; margin: auto; opacity: 1;" />
                        <h4 class="mt-3">CEO<h4>
                    </div>
                </div>
                <!-- Card End -->
            </div>
            <div class="col-lg-3 min box-item mix paint">
               <!-- Card -->
               <div class="card-it">
                <div class="card-img">
                    <img src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                    <img class="blur" src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                </div>
                <div class="card-text text-center">
                    <h2 style="background: radial-gradient(farthest-corner at 45px 45px,#987315, #9b7c16, #d4af37, #544411);-webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;">Julliet Valvanova</h2>
                    <hr style="height:3px;border:none;color:#5e4d13;background-color:#5e4d13; width: 50%; margin: auto; opacity: 1;" />
                    <h4 class="mt-3">CEO<h4>
                </div>
            </div>
            <!-- Card End -->
            </div>
            <div class="col-lg-3 min box-item mix photo">
                 <!-- Card -->
                 <div class="card-it">
                    <div class="card-img">
                        <img src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                        <img class="blur" src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                    </div>
                    <div class="card-text text-center">
                        <h2 style="background: radial-gradient(farthest-corner at 45px 45px,#987315, #9b7c16, #d4af37, #544411);-webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;">Julliet Valvanova</h2>
                        <hr style="height:3px;border:none;color:#5e4d13;background-color:#5e4d13; width: 50%; margin: auto; opacity: 1;" />
                        <h4 class="mt-3">CEO<h4>
                    </div>
                </div>
                <!-- Card End -->
            </div>
            <div class="col-lg-3 min box-item mix ui">
                 <!-- Card -->
                 <div class="card-it">
                    <div class="card-img">
                        <img src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                        <img class="blur" src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                    </div>
                    <div class="card-text text-center">
                        <h2 style="background: radial-gradient(farthest-corner at 45px 45px,#987315, #9b7c16, #d4af37, #544411);-webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;">Julliet Valvanova</h2>
                        <hr style="height:3px;border:none;color:#5e4d13;background-color:#5e4d13; width: 50%; margin: auto; opacity: 1;" />
                        <h4 class="mt-3">CEO<h4>
                    </div>
                </div>
                <!-- Card End -->
            </div>
            <div class="col-lg-3 min box-item mix ui">
                <!-- Card -->
                <div class="card-it">
                    <div class="card-img">
                        <img src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                        <img class="blur" src="{{ asset('LandingPage/img/foto-profile.jpg') }}" alt="">
                    </div>
                    <div class="card-text text-center">
                        <h2 style="background: radial-gradient(farthest-corner at 45px 45px,#987315, #9b7c16, #d4af37, #544411);-webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;">Julliet Valvanova</h2>
                        <hr style="height:3px;border:none;color:#5e4d13;background-color:#5e4d13; width: 50%; margin: auto; opacity: 1;" />
                        <h4 class="mt-3">CEO<h4>
                    </div>
                </div>
                <!-- Card End -->
            </div>
        </div>
    </div>
</div>
<!-- IT-Agent End -->
@endsection
