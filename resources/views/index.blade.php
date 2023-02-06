@extends('layoutLanding.main')

@section('title', 'Home')

@section('css_page')
<!-- Fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
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

        /* Annual Report*/

        .cards-wrapper-annual {
            display: flex;
            justify-content: center;
        }
        .card-annual img {
            max-width: 100%;
            max-height: 100%;
            min-width: 20rem;
        }
        .card-annual {
            margin: 20 10em;
            box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
            border: none;
            border-radius: 0;
        }
        .carousel-inner {
            padding: 1em;
        }
        .carousel-control-prev,
        .carousel-control-next {
            background-color: #000;
            width: 5vh;
            height: 5vh;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }
        @media (min-width: 768px) {
            .card-annual img {
                height: 100%;
            }
        }

        /* Daftar Aplikasi Internal */
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
        min-width: 13rem;
        max-width: 13rem;
        height: 10rem;
        transform: translateX(-3rem);
        position: relative;
        background-color: #fff;
    }

    .blog-post__img img{
        max-width: 120px;
        max-height: 120px;
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
        font-size: 1.1rem;
        font-weight: 700;
        color: rgba(0, 0, 0, 0.5);
        margin: .2rem 0;
    }

    .blog-post__title{
        font-size: 1.3rem;
        font-weight: 700;
        color: #40a400;
        margin: .5rem 0 .5rem;
        text-transform: uppercase;
    }

    .blog-post__text{
        font-size: 0.8rem;
        font-weight: 400;
        color: rgba(0, 0, 0, 0.7);
        margin-bottom: 1rem;
    }

    .blog-post__cta{
        display: inline-block;
        font-size: 0.5rem;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
        background-image: linear-gradient(to right, #40a400, #9bdc02);
        padding: .9rem 1.3rem;
        border-radius: .8rem;
        transition: all .3s;
    }

    .blog-post__cta:hover{
        transform: translateY(-.2rem);
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
        padding: 25px;
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
<div class="hero-header bg-light mb-5" style="position: relative;">
    <!-- Slider main container -->
    <div style="position: absolute; z-index: 2; width: 100%; text-align: right;">
        <div class="top-corner shadow">
            <img src="{{ asset('landingPage/img/logobumnterbaru2020.png') }}" alt="" style="width: 100px;">
            <img src="{{ asset('landingPage/img/logo-petro.png') }}" alt=" " style="width: 100px;">
            <img src="{{ asset('landingPage/img/PUPUK_INDONESIA.png') }}" alt="" style="width: 100px;">
        </div>
    </div>
    <div class="left-bottom shadow">
    </div>
    <div class="left-bottom2 p-4">
        <h1 class="px-4 text-white">Website TI</h1>
        <h4 class="px-4 mt-2 mb-4 text-white">Melayani dengan sepenuh hati</h4>
    </div>
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide" style="background-image:url({{url('landingPage/img/1.jpg')}}); background-repeat: no-repeat; background-size: cover;">
                
            </div>
            <div class="swiper-slide" style="background-image:url({{url('landingPage/img/2.jpg')}}); background-repeat: no-repeat; background-size: cover;">
                
            </div>
            <div class="swiper-slide" style="background-image:url({{url('landingPage/img/3.jpg')}}); background-repeat: no-repeat; background-size: cover;">
                
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Header End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">About Us</h1>
            <p class="text-success fs-5 mb-5"></p>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <img class="img-fluid" src="{{ asset('landingPage/img/2.jpg') }}" alt="">
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="h-100">
                    <p  class="text-black text-justify">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum placeat, natus dicta quam officiis voluptates laborum commodi fugiat delectus debitis ipsa qui fugit rem alias asperiores optio non cupiditate. Iusto excepturi dolorum eum modi numquam harum dolores culpa molestias laboriosam itaque enim facere a, perferendis doloribus. Veritatis, quibusdam id facere quae saepe similique vel autem fugit blanditiis maxime quis reprehenderit numquam qui accusantium aut obcaecati quo nihil ex. Asperiores, earum? Pariatur et ratione illo, earum quae similique quis velit nam sapiente, atque repellendus a blanditiis. Illo vero minima similique eveniet est maxime? Labore, magni dolor? Repudiandae qui dolorem voluptas, id rem at autem pariatur voluptates animi impedit, esse molestiae placeat maiores sapiente non? Ut harum at tempora libero facere. Doloremque deleniti dolore odit sapiente quia reiciendis ea minus saepe nobis at facere aliquam tenetur assumenda ratione minima eius, adipisci magni quas sit. Hic incidunt odit voluptate aliquid! Necessitatibus, quos illum.
                    </p>
                    
                    <a class="btn btn-success py-3 px-4" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Awarding Start -->
<div class="container-xxl py-5 my-5 bg-light">
    <div class="container py-5">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">Awarding</h1>
            <p class="text-success fs-5 mb-5">Penghargaan yang pernah diraih</p>
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="card rounded border-none">
                    <div class="text-center p-3">
                        <img data-enlargeable width="200" style="cursor: zoom-in; display: block; margin-left: auto; margin-right: auto;" 
                                    src="{{ asset('LandingPage/img/throphy.jpeg') }}" />
                        <span class="text-success fs-5 " >Penghargaan A<br></span>
                    </div>
                </div>
            </div>
          
            <div class="col-6 col-md-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="card rounded border-none">
                    <div class="text-center p-3">
                        <img data-enlargeable width="200" style="cursor: zoom-in; display: block; margin-left: auto; margin-right: auto;" 
                                    src="{{ asset('LandingPage/img/throphy.jpeg') }}" />
                        <span class="text-success fs-5 " >Penghargaan B<br></span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="card rounded border-none">
                    <div class="text-center p-3">
                        <img data-enlargeable width="200" style="cursor: zoom-in; display: block; margin-left: auto; margin-right: auto;" 
                                    src="{{ asset('LandingPage/img/throphy.jpeg') }}" />
                        <span class="text-success fs-5 " >Penghargaan C<br></span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="card rounded border-none">
                    <div class="text-center p-3">
                        <img data-enlargeable width="200" style="cursor: zoom-in; display: block; margin-left: auto; margin-right: auto;" 
                                    src="{{ asset('LandingPage/img/throphy.jpeg') }}" />
                        <span class="text-success fs-5 " >Penghargaan D<br></span>
                    </div>
                </div>
            </div>
    
            <div class="col-6 col-md-3 wow fadeIn more" data-wow-delay="0.1s">
                <div class="card rounded border-none">
                    <div class="text-center p-3">
                        <img data-enlargeable width="200" style="cursor: zoom-in; display: block; margin-left: auto; margin-right: auto;" 
                                    src="{{ asset('LandingPage/img/throphy.jpeg') }}" />
                        <span class="text-success fs-5 " >Penghargaan E<br></span>
                    </div>
                </div>
            </div>
    
            <div class="col-6 col-md-3 wow fadeIn more" data-wow-delay="0.1s">
                <div class="card rounded border-none">
                    <div class="text-center p-3">
                        <img data-enlargeable width="200" style="cursor: zoom-in; display: block; margin-left: auto; margin-right: auto;" 
                                    src="{{ asset('LandingPage/img/throphy.jpeg') }}" />
                        <span class="text-success fs-5 " >Penghargaan F<br></span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 wow fadeIn more" data-wow-delay="0.1s">
                <div class="card rounded border-none">
                    <div class="text-center p-3">
                        <img data-enlargeable width="200" style="cursor: zoom-in; display: block; margin-left: auto; margin-right: auto;" 
                                    src="{{ asset('LandingPage/img/throphy.jpeg') }}" />
                        <span class="text-success fs-5 " >Penghargaan G<br></span>
                    </div>
                </div>
            </div>
    
            <div class="col-6 col-md-3 wow fadeIn more" data-wow-delay="0.1s">
                <div class="card rounded border-none">
                    <div class="text-center p-3">
                        <img data-enlargeable width="200" style="cursor: zoom-in; display: block; margin-left: auto; margin-right: auto;" 
                                    src="{{ asset('LandingPage/img/throphy.jpeg') }}" />
                        <span class="text-success fs-5 " >Penghargaan H<br></span>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center py-4">
                <button class="btn btn-success btn-lg" id="more-award" style="background-color: #1b9920;">Read More</button>
            </div>
        </div>
    </div>
</div>
<!-- Awarding End -->


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


<!-- Annual Report Start -->
<div class="container-xxl bg-light py-5 my-5">
    <div class="container py-5">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">Annual Report</h1>
            <p class="text-success fs-5 mb-5"></p>
        </div>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="cards-wrapper-annual">
                        <a class="p-4" target="_blank" alt="StackExchange Handbook" title="StackExchange Handbook" href="/template/pdf/SERTIFIKAT HIMA FIX.pdf">
                            <div class="bg-white text-center card-annual mb-4 p-2">
                                <img src="{{ asset('LandingPage/img/download.jpeg') }}" class="card-img-top" alt="">
                                <div class="card-body" style=""> 
                                    <h5 class="card-title">Annual Report 2015</h5>
                                </div>
                            </div>
                        </a>
                        <a class="p-4" target="_blank" alt="StackExchange Handbook" title="StackExchange Handbook" href="/template/pdf/SERTIFIKAT HIMA FIX.pdf">
                            <div class="bg-white text-center card-annual mb-4 d-none d-md-block p-2">
                                <img src="{{ asset('LandingPage/img/download.jpeg') }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Annual Report 2016</h5>
                                </div>
                            </div>
                        </a>
                        <a class="p-4" target="_blank" alt="StackExchange Handbook" title="StackExchange Handbook" href="/template/pdf/SERTIFIKAT HIMA FIX.pdf">
                            <div class="bg-white text-center card-annual mb-4 d-none d-md-block p-2">
                                <img src="{{ asset('LandingPage/img/download.jpeg') }}" class="card-img-top" alt="">
                                <div class="card-body"> 
                                    <h5 class="card-title">Annual Report 2017</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="cards-wrapper-annual">
                        <a class="p-4" target="_blank" alt="StackExchange Handbook" title="StackExchange Handbook" href="/template/pdf/SERTIFIKAT HIMA FIX.pdf">
                            <div class="bg-white text-center card-annual mb-4 p-2">
                                <img src="{{ asset('LandingPage/img/download.jpeg') }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Annual Report 2018</h5>
                                </div>
                            </div>
                        </a>
                        <a class="p-4" target="_blank" alt="StackExchange Handbook" title="StackExchange Handbook" href="/template/pdf/SERTIFIKAT HIMA FIX.pdf">
                            <div class="bg-white text-center card-annual mb-4 p-2">
                                <img src="{{ asset('LandingPage/img/download.jpeg') }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Annual Report 2019</h5>
                                </div>
                            </div>
                        </a>
                        <a class="p-4" target="_blank" alt="StackExchange Handbook" title="StackExchange Handbook" href="/template/pdf/SERTIFIKAT HIMA FIX.pdf">
                            <div class="bg-white text-center card-annual mb-4 p-2">
                                <img src="{{ asset('LandingPage/img/download.jpeg') }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Annual Report 2020</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <button class="carousel-control-prev" style="background-color: #1b9920;" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" style="background-color: #1b9920;" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>        
        </div>
    </div>
</div>
<!-- Annual Report End -->


<!-- Telp Ext Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">Telp Ext</h1>
            <p class="text-primary fs-5 mb-5"></p>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex align-items-start">
                    <div class="p-3" style="border-radius: 50px; background-color: #1b9920;">
                        <i class="fas fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-3">Layanan Kesehatan</h5>
                        <h4>778901</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex align-items-start">
                    <div class="p-3" style="border-radius: 50px; background-color: #1b9920;">
                        <i class="fas fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-3">Layanan Keamanan</h5>
                        <h4>7789034</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex align-items-start">
                    <div class="p-3" style="border-radius: 50px; background-color: #1b9920;">
                        <i class="fas fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-3">Layanan Administrasi</h5>
                        <h4>7789035</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex align-items-start">
                    <div class="p-3" style="border-radius: 50px; background-color: #1b9920;">
                        <i class="fas fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-3">Layanan Keamanan</h5>
                        <h4>7789034</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex align-items-start">
                    <div class="p-3" style="border-radius: 50px; background-color: #1b9920;">
                        <i class="fas fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-3">Layanan Keamanan</h5>
                        <h4>7789034</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex align-items-start">
                    <div class="p-3" style="border-radius: 50px; background-color: #1b9920;">
                        <i class="fas fa-phone-alt fa-2x text-white"></i>
                    </div>                       
                     <div class="ps-4">
                        <h5 class="mb-3">Layanan Keamanan</h5>
                        <h4>7789034</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Telp Ext End -->


<!-- Berita Start -->
<div class="container-xxl bg-light py-5 my-5">
    <div class="container py-5">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">Berita</h1>
            <p class="text-primary fs-5 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-white p-5">
                    <img class="img-fluid mb-4" src="{{ asset('LandingPage/img/3.jpg') }}" alt="">
                    <h5 class="mb-3">Currency Wallet</h5>
                    <div class="news-meta">
                        <i class="fas fa-clock mr-1"></i>
                        <span>07 Juli 2022</span>
                        <span class="mx-1">/</span>
                        <i class="fas fa-user mr-1"></i>
                        <span>Meeting</span>
                    </div>
                    <p>Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo
                        justo</p>
                    <a href="" style="color: #1b9920;">Read More <i class="fa fa-arrow-right ms-2" ></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-white p-5">
                    <img class="img-fluid mb-4" src="{{ asset('LandingPage/img/3.jpg') }}" alt="">
                    <h5 class="mb-1">Currency Wallet</h5>
                    <label class="label text-while mb-1 p-1" style="background: #b80600">
                        <small class="text-uppercase text-white">new</small>
                    </label>
                    <div class="news-meta">
                        <i class="fas fa-clock mr-1"></i>
                        <span>07 Juli 2022</span>
                        <span class="mx-1">/</span>
                        <i class="fas fa-user mr-1"></i>
                        <span>Meeting</span>
                    </div>
                    <p>Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo
                        justo</p>
                    <a href="" style="color: #1b9920;">Read More <i class="fa fa-arrow-right ms-2" ></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-white p-5">
                    <img class="img-fluid mb-4" src="{{ asset('LandingPage/img/3.jpg') }}" alt="">
                    <h5 class="mb-3">Currency Wallet</h5>
                    <div class="news-meta">
                        <i class="fas fa-clock mr-1"></i>
                        <span>07 Juli 2022</span>
                        <span class="mx-1">/</span>
                        <i class="fas fa-user mr-1"></i>
                        <span>Meeting</span>
                    </div>
                    <p>Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo
                        justo</p>
                    <a href="" style="color: #1b9920;">Read More <i class="fa fa-arrow-right ms-2" ></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-white p-5">
                    <img class="img-fluid mb-4" src="{{ asset('LandingPage/img/3.jpg') }}" alt="">
                    <h5 class="mb-3">Currency Wallet</h5>
                    <div class="news-meta">
                        <i class="fas fa-clock mr-1"></i>
                        <span>07 Juli 2022</span>
                        <span class="mx-1">/</span>
                        <i class="fas fa-user mr-1"></i>
                        <span>Meeting</span>
                    </div>
                    <p>Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo
                        justo</p>
                    <a href="" style="color: #1b9920;">Read More <i class="fa fa-arrow-right ms-2" ></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-white p-5">
                    <img class="img-fluid mb-4" src="{{ asset('LandingPage/img/3.jpg') }}" alt="">
                    <h5 class="mb-3">Currency Wallet</h5>
                    <div class="news-meta">
                        <i class="fas fa-clock mr-1"></i>
                        <span>07 Juli 2022</span>
                        <span class="mx-1">/</span>
                        <i class="fas fa-user mr-1"></i>
                        <span>Meeting</span>
                    </div>
                    <p>Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo
                        justo</p>
                    <a href="" style="color: #1b9920;">Read More <i class="fa fa-arrow-right ms-2" ></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-white p-5">
                    <img class="img-fluid mb-4" src="{{ asset('LandingPage/img/3.jpg') }}" alt="">
                    <h5 class="mb-3">Currency Wallet</h5>
                    <div class="news-meta">
                        <i class="fas fa-clock mr-1"></i>
                        <span>07 Juli 2022</span>
                        <span class="mx-1">/</span>
                        <i class="fas fa-user mr-1"></i>
                        <span>Meeting</span>
                    </div>
                    <p>Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo
                        justo</p>
                    <a href="" style="color: #1b9920;">Read More <i class="fa fa-arrow-right ms-2" ></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Berita Start -->

<!-- Aplikasi Interal Start -->
<div class="container-xxl py-5 my-5">
    <div class="container py-5">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">Aplikasi TI</h1>
            <p class="text-success fs-5 mb-5"></p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 content">
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
            <div class="col-lg-4 content">
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
            <div class="col-lg-4 content">
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
        </div>
    </div>
</div>
<!-- Aplikasi Interal Start -->

<!-- Roadmap Start -->
<div class="container-xxl py-5 my-5 bg-light">
    <div class="container py-5">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">Roadmap</h1>
            <p class="text-primary fs-5 mb-5">We Translate Your Dream Into Reality</p>
        </div>
        <div class="owl-carousel roadmap-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="roadmap-item">
                <div class="roadmap-point"><span></span></div>
                <h5>January 2045</h5>
                <span>Diam dolor ipsum sit amet erat ipsum lorem sit</span>
            </div>
            <div class="roadmap-item">
                <div class="roadmap-point"><span></span></div>
                <h5>March 2045</h5>
                <span>Diam dolor ipsum sit amet erat ipsum lorem sit</span>
            </div>
            <div class="roadmap-item">
                <div class="roadmap-point"><span></span></div>
                <h5>May 2045</h5>
                <span>Diam dolor ipsum sit amet erat ipsum lorem sit</span>
            </div>
            <div class="roadmap-item">
                <div class="roadmap-point"><span></span></div>
                <h5>July 2045</h5>
                <span>Diam dolor ipsum sit amet erat ipsum lorem sit</span>
            </div>
            <div class="roadmap-item">
                <div class="roadmap-point"><span></span></div>
                <h5>September 2045</h5>
                <span>Diam dolor ipsum sit amet erat ipsum lorem sit</span>
            </div>
            <div class="roadmap-item">
                <div class="roadmap-point"><span></span></div>
                <h5>November 2045</h5>
                <span>Diam dolor ipsum sit amet erat ipsum lorem sit</span>
            </div>
        </div>
    </div>
</div>
<!-- Roadmap Start -->

<!-- Roadmap Start -->
<div class="container-xxl py-5 my-5">
    <div class="container py-5">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6">FAQ</h1>
            <p class="text fs-5 mb-5" style="color:#1b9920">Frequently Asked Questions</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.1s">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                How to build a website?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Dolor nonumy tempor elitr et rebum ipsum sit duo duo. Diam sed sed magna et magna
                                diam aliquyam amet dolore ipsum erat duo. Sit rebum magna duo labore no diam.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How long will it take to get a new website?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Dolor nonumy tempor elitr et rebum ipsum sit duo duo. Diam sed sed magna et magna
                                diam aliquyam amet dolore ipsum erat duo. Sit rebum magna duo labore no diam.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.3s">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Do you only create HTML websites?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Dolor nonumy tempor elitr et rebum ipsum sit duo duo. Diam sed sed magna et magna
                                diam aliquyam amet dolore ipsum erat duo. Sit rebum magna duo labore no diam.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                Will my website be mobile-friendly?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Dolor nonumy tempor elitr et rebum ipsum sit duo duo. Diam sed sed magna et magna
                                diam aliquyam amet dolore ipsum erat duo. Sit rebum magna duo labore no diam.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Will you maintain my site for me?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Dolor nonumy tempor elitr et rebum ipsum sit duo duo. Diam sed sed magna et magna
                                diam aliquyam amet dolore ipsum erat duo. Sit rebum magna duo labore no diam.
                            </div>
                        </div>
                    </div>
                    <a href="#" role="button" style="color: #1b9920;">Selengkapnya >></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Roadmap Start -->

@endsection
@section('js_page')
<script src="{{ asset('LandingPage/js/mixitup.js') }}"></script>
<script>
    $(".more").css("display", "none");
    $('#more-award').on('click', function () {
        let text = $(this).html();
        if (text == "Show More") {
            $(this).html("Show Less");
            $(".more").css("display", "block");
        } else {
            $(this).html("Show More");
            $(".more").css("display", "none");
        }
     });
</script>
@endsection