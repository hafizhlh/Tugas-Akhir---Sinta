@extends('layoutLanding.main')

@section('title', 'Tentang TI')

@section('css_page')
    <!-- BEGIN Page Level CSS-->
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
    
        .card {
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
    
        .card:hover {
            transform:translate(0, -10px);
            box-shadow: 0px 17px 35px 0px rgba(0,0,0,.07);
            border-top: 3px solid #F8C600;
            border-right: 3px solid #1b9920;
        }
    
        .card i {
            position:absolute;
            right: 0;
            top: 0;
            padding: 15px;
            font-size:1.4rem;
            line-height:3.2rem;
        }
    
        .card .card-text {
            padding: 20px;
        }
    
        .card .card-img {
            transform: translate(52px,30px);
            margin: 0 30px;
            display:flex;
            align-items: center;
            justify-content:center;
            transition: all .35s ease-out;
            margin-bottom: 40px;
        }
    
        .card img {
            position: relative;
            height:150px;
            width: 150px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
            box-shadow: 0px 0px 0px 0px rgba(0,0,0, .08);
            transition: all .35s ease-out;
        }
    
        .card img.blur {
            filter:blur(15px);
            z-index:-1;
            opacity:.40;
            transform: translate(-160px,30px);
            transition: all .35s ease-out;
        }
    
        .card-content {
            display:flex;
            align-items:center;
            justify-content:flex-start;
            width:100%;
            overflow:auto;
            padding-left:60px;
            padding-right: 50px;
            scroll-behavior:smooth;
        }
    
        .card-content::-webkit-scrollbar {
            height:0px;
        }
    
        .card-content:after {
            content:'';
            display:block;
            min-width:20px;
            height:100px;
            position:relative;
        }
    
        .btn-slider{
            min-width:40px;
            margin:auto 30px;
            height:40px;
            border-radius:10px;
            background:#fff;
            border:0px;
            outline: none;
            cursor:pointer;
            z-index:3;
            box-shadow: 0px 0px 0px 0px rgba(0,0,0,.08);
            background: linear-gradient(to right, #3b9901, #16c602);
            transition: all .25s ease;
            color: #fff;
        }
    
        .btn-slider:hover{
            box-shadow: 0px 17px 35px 0px rgba(0,0,0,.07);
        }
    
        .btn-slider i {
            font-size:1.2rem;
        }
    
        .slider {
            display:flex;
            align-items:center;
            justify-content:center;
            width:100%;
            overflow:hidden;
        }
    
        .slider:after {
            content:'';
            left:98px;
            position:absolute;
            width:150px;
            z-index:100;
            pointer-events:none;
        }
    
        .slider:before {
            content:'';
            right:98px;
            position:absolute;
            width:150px;
            z-index:100;
            pointer-events:none;
        }
    </style>
    <!-- END Page Level CSS-->
@endsection

@section('content')
        <!-- Header Start -->
        <div class="container-fluid hero-header bg-light py-5 mb-5" style="background-image: url('/LandingPage/img/Frame 15.png'); background-size: cover; background-repeat: no-repeat;">
            <div class="container py-6">
                <div style="margin: auto; width: 50%; padding: 10px;">
                    <h1 class="display-4 mb-3 animated slideInDown text-center">Tentang TI</h1>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- FAQs Start -->
        <div class="container-xxl py-5" id="SejarahTI">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-6">Sejarah TI</h1>
                    <p class="text-success fs-5 mb-5">Frequently Asked Questions</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 p-4">
                        <div class="text-center wow fadeInUp p-4 d-block m-auto" data-wow-delay="0.1s">
                            <img src="{{ asset('LandingPage/img/1.jpg') }}" alt="" class="img-fluid shadow">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4">
                            <p class="text-dark wow fadeInRight" style="text-align: justify;">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime nemo magni quaerat laboriosam nisi nulla, eaque rerum delectus aperiam omnis quas perspiciatis voluptatem accusamus, dolores repudiandae voluptate quisquam sed officiis ullam explicabo doloremque saepe optio, possimus cumque! Esse nihil consequatur voluptates, soluta molestias, architecto ducimus, consequuntur nemo minus dolores hic illum atque? Mollitia voluptatem laborum quisquam aliquid autem obcaecati laudantium pariatur ipsum neque magnam cum a eum omnis eos natus modi debitis nostrum, doloremque tempora assumenda earum! Aut, atque aspernatur. Sapiente doloremque molestias ab a necessitatibus! Libero sequi, ipsa delectus asperiores et odit vero eos, aliquid minus culpa officia omnis velit similique repellat dolorem quos! Iure aspernatur alias sint velit rem deleniti, error sit cum adipisci doloremque quaerat modi eum incidunt cupiditate officia voluptatem distinctio. Perferendis sit distinctio dicta fugit nemo maxime exercitationem. Perferendis minus temporibus rerum impedit commodi! Quas consectetur voluptas dolorum, excepturi quis officiis? Voluptates tenetur rerum sapiente laborum illo quis ullam odio, enim libero iusto quae harum quas, debitis voluptate, esse accusamus! Numquam vero nemo corrupti rerum quos nostrum ipsa molestiae veritatis corporis nisi, nobis autem tempora, magni enim possimus! Iusto veniam, est debitis quod, dolorem hic reiciendis repellendus, dolorum enim ea voluptatum repellat eligendi optio velit?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5 bg-light" id="tugas-dan-tanggung-jawab-TI">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-6">Tugas dan Tanggung Jawab Bagian</h1>
                    <p class="text-success fs-5 mb-5">Frequently Asked Questions</p>
                </div>
                <div>
                    <div class="row">
                        <div class="col-lg-6 p-4 text-dark" style="text-align: justify;">
                            <p class="text-dark wow fadeInRight p-4">
                                Tugas dan tanggung jawab bagian TI adalah sebagai berikut:
                                <ul>
                                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta laboriosam harum temporibus quis repudiandae illum iste officiis aliquid fugiat accusamus?</li>
                                    <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit laborum sint aut pariatur quam rerum?</li>
                                    <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis beatae consequatur error quaerat animi expedita vel iste accusamus.</li>
                                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, rerum?</li>
                                    <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit laborum sint aut pariatur quam rerum?</li>
                                    <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit laborum sint aut pariatur quam rerum?</li>
                                </ul>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-4">
                                <div class="text-center wow fadeInUp p-4 d-block m-auto" data-wow-delay="0.1s">
                                    <img src="{{ asset('LandingPage/img/2.jpg') }}" alt="" class="img-fluid shadow">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5" id="struktur-organisasi-ti">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-6">Struktur Organisasi TI</h1>
                    <p class="text-success fs-5 mb-5">Frequently Asked Questions</p>
                </div>
                <div class="slider">
                    <button id="prev" class="btn-slider">
                        <i class="fa fa-angle-left"></i>
                    </button>

                    <div class="card-content" id="struktur-organisasi">
                        <!-- Card -->
                        <div class="card">
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

                        <!-- Card -->
                        <div class="card">
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

                        <!-- Card -->
                        <div class="card">
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

                        <!-- Card -->
                        <div class="card">
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

                        <!-- Card -->
                        <div class="card">
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

                        <!-- Card -->
                        <div class="card">
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

                        <!-- Card -->
                        <div class="card">
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
                    <button id="next" class="btn-slider">
                    <i class="fa fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- FAQs End -->
@endsection

@section('js_page')
    <script src="{{ asset('landingPage/js/main.js') }}"></script>
    <script type="text/javascript">
        const next= document.getElementById('next')
        const prev=document.getElementById('prev')
    
        function handleScrollNext (direction) {
            const cards = document.getElementById('struktur-organisasi')
            cards.scrollLeft=cards.scrollLeft += window.innerWidth / 2 > 600 ? window.innerWidth /2 : window.innerWidth -100
        }
    
        function handleScrollPrev (direction) {
            const cards = document.getElementById('struktur-organisasi')
            cards.scrollLeft=cards.scrollLeft -= window.innerWidth / 2 > 600 ? window.innerWidth /2 : window.innerWidth -100
        }
    
        next.addEventListener('click', handleScrollNext)
        prev.addEventListener('click', handleScrollPrev)
    </script>
    
@endsection
