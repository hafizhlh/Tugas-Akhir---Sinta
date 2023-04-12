<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SINTA | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('landingPage/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingPage/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('landingPage/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('landingPage/css/style.css') }}" rel="stylesheet">

    <!--swipper-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png') }}" />
	@yield('css_page')
</head>

<body>
    <input type="hidden" value="{{ $active }}" id="active-navbar">
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <style type="text/css">

	</style>

    <!-- Navbar Start -->
    @include('layoutLanding.navbar')
    <!-- Navbar End -->

    {{-- content start --}}
    @yield('content')
    {{-- content end --}}


    <!-- Footer Start -->
    @include('layoutLanding.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landingPage/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('landingPage/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('landingPage/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('landingPage/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landingPage/lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('landingPage/js/main.js') }}"></script>

    <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
  // Optional parameters
  loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});
</script>

<script>
    $active = $('#active-navbar').val();
    $('.nav-link').removeClass('active');
    if($active == 'home'){
        $('#home').css('color', '#1b9920');
    }else if($active == 'tentangTI'){
        $('#tentangTI').css('color', '#1b9920');
    }else if($active == 'ITSC'){
        $('#ITSC').css('color', '#1b9920');
    }else if($active == 'ITAgent'){
        $('#ITAgent').css('color', '#1b9920');
    }else if($active == 'BeritaTI'){
        $('#BeritaTI').css('color', '#1b9920');
    }else if($active == 'SecurityAwareness'){
        $('#SecurityAwareness').css('color', '#1b9920');
    }else if($active == 'FAQ'){
        $('#FAQ').css('color', '#1b9920');
    }else if($active == 'Tautan'){
        $('#Tautan').css('color', '#1b9920');
    }
</script>

@yield('js_page')

</body>

</html>