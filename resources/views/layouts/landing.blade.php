<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Create a stylish landing page for your business startup and get leads for the offered services with this free HTML landing page template.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Capy - Internet Of Things</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext"
        rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
    <link href="css/magnific-popup.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="images/capybaralogo4.png">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Evolo</a> -->

        <!-- Image Logo -->
        {{-- <a class="navbar-brand logo-image" href="index.html"><img src="images/capybaralogo4.png" alt="alternative"></a> --}}
        {{-- <a class="navbar-brand logo-text" href="index.html">Internet Of Things</a> --}}
        <a class="navbar-brand logo-container" href="index.html">
            <img src="images/capylogo8.png" alt="logo" class="logo-image">
            {{-- <span class="logo-text">Nama Perusahaan Anda</span> --}}
        </a>
        <a class="navbar-brand logo-text" href="index.html">Internet Of Things</a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="https://github.com/RickyPhandeirot">Contact</a>
                </li>
                {{-- mengecek jika sudah login --}}
                @if (Auth::check())
                    {{-- jika sudah tampilan menu dashboard dan logout --}}
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('logout') }}">Logout</a>
                    </li>
                @else
                    {{-- jika belum tampilkan register dan login --}}
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
            <span class="nav-item social-icons">
                <span class="fa-stack">
                    <a href="https://www.linkedin.com/in/ricky-phandeirot-a34a43297/">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-linkedin-in fa-stack-1x"></i>
                    </a>
                </span>
                {{-- <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x twitter"></i>
                        <i class="fab fa-twitter fa-stack-1x"></i>
                    </a>
                </span> --}}
            </span>
        </div>
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-container">
                            <h1><span class="turquoise">Internet Of Things</span> Join With Us</h1>
                            {{-- <p class="p-large">Use Evolo free landing page template to promote your business startup and generate leads for the offered services</p> --}}
                            @if (Auth::check())
                                <a class="btn-solid-lg page-scroll" href="{{ route('dashboard') }}">Dashboard</a>
                            @else
                                <a class="btn-solid-lg page-scroll" href="{{ route('login') }}">Login</a>
                            @endif
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="images/capybaralogo4.png" alt="alternative">
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <!-- end of header -->

    </div> <!-- end of col -->
    </div> <!-- end of row -->
    </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of services -->

    <!-- About -->
    <div id="about" class="basic-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>About Me</h2>
                    <p class="p-heading p-large">Hello, I'm Ricky. I'm from Sam Ratulangi University</p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Team Member -->
                    <div class="team-member">
                        <div class="image-wrapper">
                            <img class="img-fluid" src="images/Ricky-Picture.jpeg" alt="alternative">
                        </div> <!-- end of image-wrapper -->
                        <p class="p-large"><strong>Ricky Phandeirot</strong></p>
                        <p class="job-title">IoT Developer</p>
                        <span class="social-icons">
                            <span class="fa-stack">
                                <a href="https://www.linkedin.com/in/ricky-phandeirot-a34a43297/">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-linkedin-in fa-stack-1x"></i>
                                </a>
                            </span>
                            {{-- <span class="fa-stack">
                                <a href="#your-link">
                                    <i class="fas fa-circle fa-stack-2x twitter"></i>
                                    <i class="fab fa-twitter fa-stack-1x"></i>
                                </a>
                            </span> --}}
                        </span> <!-- end of social-icons -->
                    </div> <!-- end of team-member -->
                    <!-- end of team member -->



                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-4 -->
    <!-- end of about -->

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col">
                        <h4>About Capy</h4>
                        <p>We Build Internet Of Things with Capy</p>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        {{-- <h4>Important Links</h4>
                        <ul class="list-unstyled li-space-lg"> --}}
                            {{-- <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Our business partners <a class="turquoise"
                                        href="#your-link">startupguide.com</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Read our <a class="turquoise"
                                        href="terms-conditions.html">Terms & Conditions</a>, <a class="turquoise"
                                        href="privacy-policy.html">Privacy Policy</a></div>
                            </li> --}}
                        {{-- </ul> --}}
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Social Media</h4>
                        {{-- <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-google-plus-g fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span> --}}
                        <span class="fa-stack">
                            <a href="https://www.linkedin.com/in/ricky-phandeirot-a34a43297/">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin-in fa-stack-1x"></i>
                            </a>
                        </span>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © Evolo - StartUp HTML Landing Page Template by <a
                            href="https://inovatik.com">Inovatik</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>
