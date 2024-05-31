<!DOCTYPE html>
<html lang="en" dir="ltr" class="landing-pages"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DakNet | Dakwah Network</title>
    <link rel="shortcut icon" href="<?=base_url()?>img/logo.png" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/core/libs.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/aos/dist/aos.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/hope-ui.min.css?v=2.0.0" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/custom.min.css?v=2.0.0" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/dark.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/customizer.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/rtl.min.css"/>

    <style>
        .swal2-loading {
            margin-bottom: 50px;
        }
        .swal2-title{
            padding-top: 3px;
        }
        .placeholder {
            text-align: center;
            padding: 50px;
            color: #666;
        }

        .placeholder p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .loadera {
            border: 16px solid #ffffff;
            border-radius: 50%;
            border-top: 16px solid #3a57e8;
            width: 100px;
            height: 100px;
            animation: spin 2s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .banner-one-app{
            padding-top: 50px !important;
            padding-bottom: 100px !important;
        }
        @media only screen and (max-width:480px) {
            .keduax{
                display: none; !important;
                visibility: hidden; !important;
            }
        }
        @media only screen and (max-width:1027px) {
            .rowku{
                flex-direction: column;
            }
            .rowmedia{
                margin-left: 10%;
            }
            .rowmediaaneh{
                margin-top:25px
            }
        }
        .sub-header {
            bac
            background-repeat: no-repeat;
            padding: 100px 0px;
            background-color: #3a57e8;
            -webkit-background-size: cover;
            background-size: cover;
            color: #fff
        }
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #4b68f9;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #3a57e8;
        }

    </style>

    <!-- SwiperSlider css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/landing-pages.min.css">
    <style class="fslightbox-styles">.fslightbox-absoluted{position:absolute;top:0;left:0}.fslightbox-fade-in{animation:fslightbox-fade-in .3s cubic-bezier(0,0,.7,1)}.fslightbox-fade-out{animation:fslightbox-fade-out .3s ease}.fslightbox-fade-in-strong{animation:fslightbox-fade-in-strong .3s cubic-bezier(0,0,.7,1)}.fslightbox-fade-out-strong{animation:fslightbox-fade-out-strong .3s ease}@keyframes fslightbox-fade-in{from{opacity:.65}to{opacity:1}}@keyframes fslightbox-fade-out{from{opacity:.35}to{opacity:0}}@keyframes fslightbox-fade-in-strong{from{opacity:.3}to{opacity:1}}@keyframes fslightbox-fade-out-strong{from{opacity:1}to{opacity:0}}.fslightbox-cursor-grabbing{cursor:grabbing}.fslightbox-full-dimension{width:100%;height:100%}.fslightbox-open{overflow:hidden;height:100%}.fslightbox-flex-centered{display:flex;justify-content:center;align-items:center}.fslightbox-opacity-0{opacity:0!important}.fslightbox-opacity-1{opacity:1!important}.fslightbox-scrollbarfix{padding-right:17px}.fslightbox-transform-transition{transition:transform .3s}.fslightbox-container{font-family:Arial,sans-serif;position:fixed;top:0;left:0;background:linear-gradient(rgba(30,30,30,.9),#000 1810%);touch-action:pinch-zoom;z-index:1000000000;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-tap-highlight-color:transparent}.fslightbox-container *{box-sizing:border-box}.fslightbox-svg-path{transition:fill .15s ease;fill:#ddd}.fslightbox-nav{height:45px;width:100%;position:absolute;top:0;left:0}.fslightbox-slide-number-container{display:flex;justify-content:center;align-items:center;position:relative;height:100%;font-size:15px;color:#d7d7d7;z-index:0;max-width:55px;text-align:left}.fslightbox-slide-number-container .fslightbox-flex-centered{height:100%}.fslightbox-slash{display:block;margin:0 5px;width:1px;height:12px;transform:rotate(15deg);background:#fff}.fslightbox-toolbar{position:absolute;z-index:3;right:0;top:0;height:100%;display:flex;background:rgba(35,35,35,.65)}.fslightbox-toolbar-button{height:100%;width:45px;cursor:pointer}.fslightbox-toolbar-button:hover .fslightbox-svg-path{fill:#fff}.fslightbox-slide-btn-container{display:flex;align-items:center;padding:12px 12px 12px 6px;position:absolute;top:50%;cursor:pointer;z-index:3;transform:translateY(-50%)}@media (min-width:476px){.fslightbox-slide-btn-container{padding:22px 22px 22px 6px}}@media (min-width:768px){.fslightbox-slide-btn-container{padding:30px 30px 30px 6px}}.fslightbox-slide-btn-container:hover .fslightbox-svg-path{fill:#f1f1f1}.fslightbox-slide-btn{padding:9px;font-size:26px;background:rgba(35,35,35,.65)}@media (min-width:768px){.fslightbox-slide-btn{padding:10px}}@media (min-width:1600px){.fslightbox-slide-btn{padding:11px}}.fslightbox-slide-btn-container-previous{left:0}@media (max-width:475.99px){.fslightbox-slide-btn-container-previous{padding-left:3px}}.fslightbox-slide-btn-container-next{right:0;padding-left:12px;padding-right:3px}@media (min-width:476px){.fslightbox-slide-btn-container-next{padding-left:22px}}@media (min-width:768px){.fslightbox-slide-btn-container-next{padding-left:30px}}@media (min-width:476px){.fslightbox-slide-btn-container-next{padding-right:6px}}.fslightbox-down-event-detector{position:absolute;z-index:1}.fslightbox-slide-swiping-hoverer{z-index:4}.fslightbox-invalid-file-wrapper{font-size:22px;color:#eaebeb;margin:auto}.fslightbox-video{object-fit:cover}.fslightbox-youtube-iframe{border:0}.fslightbox-loader{display:block;margin:auto;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:67px;height:67px}.fslightbox-loader div{box-sizing:border-box;display:block;position:absolute;width:54px;height:54px;margin:6px;border:5px solid;border-color:#999 transparent transparent transparent;border-radius:50%;animation:fslightbox-loader 1.2s cubic-bezier(.5,0,.5,1) infinite}.fslightbox-loader div:nth-child(1){animation-delay:-.45s}.fslightbox-loader div:nth-child(2){animation-delay:-.3s}.fslightbox-loader div:nth-child(3){animation-delay:-.15s}@keyframes fslightbox-loader{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}.fslightbox-source{position:relative;z-index:2;opacity:0}</style></head>
<body class=" body-bg landing-pages">
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
<span class="screen-darken"></span>
<!-- loader-Start -->
<div id="loading">
    <div class="loader simple-loader animate__animated animate__fadeOut d-none">
        <div class="loader-body">
        </div>
    </div>    </div>
<!-- loader-END -->
<!-- Wrapper-start -->
<main class="main-content">
    <div class="position-relative">
        <!-- Nav-Start -->
        <nav class="nav navbar navbar-expand-xl navbar-light iq-navbar header-hover-menu">
            <div class="container-fluid navbar-inner">
                <div class="d-flex align-items-center justify-content-between w-100 landing-header">
                    <a href="#" class="navbar-brand m-0 d-xl-flex d-none">
                        <!--Logo start-->
                        <img width="32px" src="<?=base_url()?>img/logo.png" alt="">
                        <!--logo End--><h5  style="margin-left:5px" class="logo-title">DakNet</h5>
                    </a>
                    <div class="d-flex align-items-center d-xl-none">
                        <button data-trigger="navbar_main" class="d-xl-none btn btn-primary rounded-pill p-1 pt-0" type="button">
                            <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
                            </svg>
                        </button>

                        <a href="#" class="navbar-brand ms-3  d-xl-none">
                            <!--Logo start-->
                            <img width="32px" src="<?=base_url()?>img/logo.png" alt="">
                            <!--logo End--><h5  style="margin-left:5px" class="logo-title">DakNet</h5>
                        </a>
                    </div>


                    <!-- Horizontal Menu Start -->
                    <nav id="navbar_main" class="mobile-offcanvas nav navbar navbar-expand-xl hover-nav horizontal-nav">
                        <div class="container-fluid p-lg-0">
                            <div class="offcanvas-header px-0">
                                <a href="#" class="navbar-brand ms-3  d-xl-none">
                                    <!--Logo start-->
                                    <!--Logo start-->
                                    <img width="32px" src="<?=base_url()?>img/logo.png" alt="">
                                    <!--logo End--><h5  style="margin-left:5px" class="logo-title">DakNet</h5>
                                </a>
                                <button class="btn-close float-end px-3"></button>
                            </div>
                            <ul class="navbar-nav iq-nav-menu  list-unstyled" id="header-menu">
                                <li class="nav-item"><a class="nav-link " href="/beranda">Beranda</a></li>
                                <li class="nav-item"><a class="nav-link " href="/dakwah">Dakwah</a></li>
                                <li class="nav-item"><a class="nav-link " href="/contact">Contact Us</a></li>
                            </ul>
                        </div> <!-- container-fluid.// -->
                    </nav>
                    <!-- Sidebar Menu End -->
                </div>
            </div>
        </nav>        <!--Nav-End-->
    </div>