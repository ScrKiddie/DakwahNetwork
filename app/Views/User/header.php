
<!doctype html>
<html lang="en" dir="ltr">
<head>
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
    <link rel="stylesheet" href="<?=base_url()?>cropperjs/cropper.css"/>
    <style id="classAneh"></style>


    <style>
        #lengkap:focus{
            background-color: transparent !important;
        }
        #lengkap:hover{
            background-color: transparent !important;
            color: #3a57e8;
        }
        @media only screen and (min-width:1156px) {
            #imageAfterPoster{
                width: 480px !important;height: 720px !important;
            }
        }
        @media only screen and (min-width:1156px) {
            #imageAfter{
                width: 400px !important;height: 400px !important;
            }
        }
        .swal2-popup .swal2-styled:focus {
            box-shadow: none !important;
        }
        .swal2-container .swal2-styled {
            font-weight: unset !important;
        }


        .show {
            transform: translateY(0) !important;
        }
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #4b68f9;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #3a57e8;
        }
        .swal2-container .swal2-html-container{
            overflow: hidden;
        }
    </style>
</head>
<body class="theme-color-default">
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="#" class="navbar-brand" >
            <!--Logo start-->
            <!--logo End-->
            <!--Logo start-->
            <div class="logo-main" style="padding-left: 7px;">
                <div class="logo-normal">
                     <img width="30px" src="<?=base_url()?>img/logo.png" alt="">
                </div>
                <div class="logo-mini">
                    <img src="<?=base_url()?>img/logo.png" alt="">
                </div>
            </div>
            <!--logo End-->
            <h4 class="logo-title" style="margin-left:8px;">DakNet</h4>
        </a>
        <div class="sidebar-toggle" style="margin-top: 5px" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <!-- Sidebar Menu Start -->
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">


                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Home</span>
                        <span class="mini-icon">-</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="buttonDashboard" class="nav-link" aria-current="page" href="<?=base_url()?>user/dashboard">
                        <i class="icon">
                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-20">
                                <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>

                <li><hr class="hr-horizontal"></li>
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Pengelolaan</span>
                        <span class="mini-icon">-</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a id="buttonDakwah" class="nav-link" data-bs-toggle="collapse" href="#sidebar-dakwah" role="button" aria-expanded="false" aria-controls="sidebar-dakwah">
                        <i class="icon">
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path opacity="0.4" d="M16.191 2H7.81C4.77 2 3 3.78 3 6.83V17.16C3 20.26 4.77 22 7.81 22H16.191C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2Z" fill="currentColor"></path>                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.07996 6.6499V6.6599C7.64896 6.6599 7.29996 7.0099 7.29996 7.4399C7.29996 7.8699 7.64896 8.2199 8.07996 8.2199H11.069C11.5 8.2199 11.85 7.8699 11.85 7.4289C11.85 6.9999 11.5 6.6499 11.069 6.6499H8.07996ZM15.92 12.7399H8.07996C7.64896 12.7399 7.29996 12.3899 7.29996 11.9599C7.29996 11.5299 7.64896 11.1789 8.07996 11.1789H15.92C16.35 11.1789 16.7 11.5299 16.7 11.9599C16.7 12.3899 16.35 12.7399 15.92 12.7399ZM15.92 17.3099H8.07996C7.77996 17.3499 7.48996 17.1999 7.32996 16.9499C7.16996 16.6899 7.16996 16.3599 7.32996 16.1099C7.48996 15.8499 7.77996 15.7099 8.07996 15.7399H15.92C16.319 15.7799 16.62 16.1199 16.62 16.5299C16.62 16.9289 16.319 17.2699 15.92 17.3099Z" fill="currentColor"></path>                                </svg>
                        </i>
                        <span class="item-name">Dakwah</span>
                        <i class="right-icon">
                            <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </i>
                    </a>

                    <ul class="sub-nav collapse " id="sidebar-dakwah" data-bs-parent="#sidebar-menu">
                        <li  class="nav-item">
                            <a id="buttonAddDakwah" class="nav-link " href="<?=base_url()?>/user/dakwah/new">
                                <i class="icon">
                                    <svg  class="icon-10" xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> A </i>
                                <span class="item-name">Add Dakwah</span>
                            </a>
                            <a id="buttonListDakwah" class="nav-link " href="<?=base_url()?>user/dakwah">
                                <i class="icon">
                                    <svg  class="icon-10" xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> L </i>
                                <span class="item-name">List Dakwah</span>
                            </a>
                            <a id="buttonHistoriDakwah" class="nav-link " href="<?=base_url()?>user/dakwah/histori">
                                <i class="icon">
                                    <svg  class="icon-10" xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> H </i>
                                <span class="item-name">Histori Dakwah</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li><hr class="hr-horizontal"></li>
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Account</span>
                        <span class="mini-icon">-</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="buttonProfile" class="nav-link" aria-current="page" href="<?=base_url()?>user/profile">
                        <i class="icon">
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M21.101 9.58786H19.8979V8.41162C19.8979 7.90945 19.4952 7.5 18.999 7.5C18.5038 7.5 18.1 7.90945 18.1 8.41162V9.58786H16.899C16.4027 9.58786 16 9.99731 16 10.4995C16 11.0016 16.4027 11.4111 16.899 11.4111H18.1V12.5884C18.1 13.0906 18.5038 13.5 18.999 13.5C19.4952 13.5 19.8979 13.0906 19.8979 12.5884V11.4111H21.101C21.5962 11.4111 22 11.0016 22 10.4995C22 9.99731 21.5962 9.58786 21.101 9.58786Z" fill="currentColor"></path>
                                <path d="M9.5 15.0156C5.45422 15.0156 2 15.6625 2 18.2467C2 20.83 5.4332 21.5001 9.5 21.5001C13.5448 21.5001 17 20.8533 17 18.269C17 15.6848 13.5668 15.0156 9.5 15.0156Z" fill="currentColor"></path>
                                <path opacity="0.4" d="M9.50023 12.5542C12.2548 12.5542 14.4629 10.3177 14.4629 7.52761C14.4629 4.73754 12.2548 2.5 9.50023 2.5C6.74566 2.5 4.5376 4.73754 4.5376 7.52761C4.5376 10.3177 6.74566 12.5542 9.50023 12.5542Z" fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Change Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="buttonPassword" class="nav-link" aria-current="page" href="<?=base_url()?>user/password">
                        <i class="icon">
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path opacity="0.4" d="M8.23918 8.70907V7.36726C8.24934 5.37044 9.92597 3.73939 11.9989 3.73939C13.5841 3.73939 15.0067 4.72339 15.5249 6.19541C15.6976 6.65262 16.2057 6.89017 16.663 6.73213C16.8865 6.66156 17.0694 6.50253 17.171 6.29381C17.2727 6.08508 17.293 5.84654 17.2117 5.62787C16.4394 3.46208 14.3462 2 11.9786 2C8.95048 2 6.48126 4.41626 6.46094 7.38714V8.91084L8.23918 8.70907Z" fill="currentColor"></path>                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.7688 8.71118H16.2312C18.5886 8.71118 20.5 10.5808 20.5 12.8867V17.8246C20.5 20.1305 18.5886 22.0001 16.2312 22.0001H7.7688C5.41136 22.0001 3.5 20.1305 3.5 17.8246V12.8867C3.5 10.5808 5.41136 8.71118 7.7688 8.71118ZM11.9949 17.3286C12.4928 17.3286 12.8891 16.941 12.8891 16.454V14.2474C12.8891 13.7703 12.4928 13.3827 11.9949 13.3827C11.5072 13.3827 11.1109 13.7703 11.1109 14.2474V16.454C11.1109 16.941 11.5072 17.3286 11.9949 17.3286Z" fill="currentColor"></path>                                </svg>
                        </i>
                        <span class="item-name">Change Password</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="buttonPassword" class="nav-link" aria-current="page" href="<?=base_url()?>user/logout">
                        <i class="icon">
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path opacity="0.4" d="M2 6.447C2 3.996 4.03024 2 6.52453 2H11.4856C13.9748 2 16 3.99 16 6.437V17.553C16 20.005 13.9698 22 11.4744 22H6.51537C4.02515 22 2 20.01 2 17.563V16.623V6.447Z" fill="currentColor"></path>                                <path d="M21.7787 11.4548L18.9329 8.5458C18.6388 8.2458 18.1655 8.2458 17.8723 8.5478C17.5802 8.8498 17.5811 9.3368 17.8743 9.6368L19.4335 11.2298H17.9386H9.54826C9.13434 11.2298 8.79834 11.5748 8.79834 11.9998C8.79834 12.4258 9.13434 12.7698 9.54826 12.7698H19.4335L17.8743 14.3628C17.5811 14.6628 17.5802 15.1498 17.8723 15.4518C18.0194 15.6028 18.2113 15.6788 18.4041 15.6788C18.595 15.6788 18.7868 15.6028 18.9329 15.4538L21.7787 12.5458C21.9199 12.4008 21.9998 12.2048 21.9998 11.9998C21.9998 11.7958 21.9199 11.5998 21.7787 11.4548Z" fill="currentColor"></path>                                </svg>
                        </i>
                        <span class="item-name">Logout</span>
                    </a>
                </li>
            </ul>


            <!-- Sidebar Menu End -->
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>


<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
            <div class="container-fluid navbar-inner" style="padding-right: 10px;">
                <a href="#" class="navbar-brand" style="padding-top:0px">
                    <div class="logo-main">
                        <div class="logo-normal" style="margin-top: 2px;">
                            <img width="30px" src="<?=base_url()?>img/logo.png" alt="">
                        </div>
                    </div>
                    <h4 class="logo-title" style="margin-left:8px;line-height: 4px;height: 0px;">DakNet</h4>
                </a>
                <ul class="navbar-nav ms-auto align-items-center navbar-list mb-lg-0" style="flex-direction: row;" >
                    <div class="btn" style="display: flex;align-items: center;justify-content: center;width: 30px;height: 30px; border-radius: 100%;padding: 0;margin-right: 8px;" id="kuda"></div>
                    <li class="nav-item dropdown">
                        <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?=base_url()."upload/".$this->data["userData"]["profilePict"]?>" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50">
                            <div class="caption ms-3  d-none d-md-block">
                                <h6 class="mb-0 caption-title"><?=$this->data["userData"]["username"] ?></h6>
                                <p class="mb-0 caption-sub-title">Penyelenggara</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/user/profile">Change Profile</a></li>
                            <li><a class="dropdown-item" href="/user/password">Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/user/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon">
                        <svg  width="20px" class="icon-20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                        </svg>
                    </i>
                </div>
                <!-- ATAS UNTUK MOBILE -->
            </div>
        </nav>
        <!-- Nav selesai -->
        <!-- Nav Header Component Start -->
        <div class="iq-navbar-header navs-bg-color" style="height: 215px; ">
            <!-- navs-bg-color agar minimalis -->
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Hello Penyelenggara!</h1>
                                <p>Gunakan panel ini untuk mengakses dan mengelola semua aspek dari dakwah Anda dengan mudah dan efisien.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-header-img"></div>
        </div>
        <!--Nav End-->
        <div class="conatiner-fluid content-inner mt-n5 py-0">



