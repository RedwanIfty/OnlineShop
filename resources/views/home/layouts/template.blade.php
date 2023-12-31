@php
use \App\Models\Category;
use \App\Models\SubCategory;
use \App\Models\Cart;
$categories=Category::orderBy('category_name')->get();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>@yield('homeTitle')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('home/images/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>


<body>
<!-- banner bg main start -->
<div class="banner_bg_main">
    <!-- header top section start -->
    <div class="container">
        <div class="header_section_top">
            <div class="row">
                <div class="col-sm-12">
                    <div class="custom_menu">
                        <ul>
                            <li><a href="#">Best Sellers</a></li>
                            <li><a href="#">Gift Ideas</a></li>
                            <li><a href="{{route('newRelease')}}">New Releases</a></li>
                            <li><a href="{{route('todaysDeal')}}">Today's Deals</a></li>
                            <li><a href="{{route('customerService')}}">Customer Service</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top section start -->
    <!-- logo section start -->
    <div class="logo_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="logo"><a href="{{route('homePage')}}"><img src="{{asset('home/images/logo.png')}}"></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- logo section end -->
    <!-- header section start -->
    <div class="header_section">
        <div class="container">
            <div class="containt_main">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="{{route('homePage')}}">Home</a>
                    @foreach($categories as $cat)
                        <a href="{{route('category',[$cat->id,$cat->slug])}}">{{$cat->category_name}}</a>
                    @endforeach
                </div>
                <span class="toggle_icon" onclick="openNav()"><img src="{{asset('home/images/toggle-icon.png')}}"></span>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All Category
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($categories as $category)
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" onMouseOver="showSubcategories(this)">{{$category->category_name}}</a>
                                <ul class="dropdown-menu subcategories">
                                        <li><a class="dropdown-item" href="#">subcategory->subcategory_name</a></li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="main">
                    <!-- Another variation with a button -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search this blog">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button" style="background-color: #f26522; border-color:#f26522 ">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="header_box">
{{--                    <div class="lang_box ">--}}
{{--                        <a href="#" title="Language" class="nav-link" data-toggle="dropdown" aria-expanded="true">--}}
{{--                            <img src="{{asset('home/images/flag-uk.png')}}" alt="flag" class="mr-2 " title="United Kingdom"> English <i class="fa fa-angle-down ml-2" aria-hidden="true"></i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu ">--}}
{{--                            <a href="#" class="dropdown-item">--}}
{{--                                <img src="{{asset('home/images/flag-france.png')}}" class="mr-2" alt="flag">--}}
{{--                                French--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="login_menu">
                        <ul>
                            <li><a href="{{route('addToCard')}}">
                                    @auth
                                    @php
                                        $totalIteams=Cart::where('user_id',auth()->user()->id)->count();
                                    @endphp
                                    @endauth
                                    <i class="fa fa-shopping-cart" ><span class="cart-box"><sup>@guest @endguest @auth {{$totalIteams}} @endauth</sup></span></i>
                                    <span class="padding_0"></span></a>
                            </li>
                            <li><a href="{{route('login')}}">
                                    <i class="fa fa-user" aria-hidden="true" ></i>
                                    <span class="padding_10">@auth Dashboard
                                        @endauth
                                        @guest Login @endguest</span></a>
                            </li>
                            @guest
                            <li><a href="{{route('register')}}">
                                    <i class="fa fa-user" aria-hidden="true" ></i>
                                    <span class="padding_10">Register</span></a>
                            </li>
                            @endguest
                            @auth
                               @foreach(auth()->user()->roles as $role)
                                   @if($role->id==2)
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="fa fa-sign-out" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    <i class="bx bx-power-off me-2"></i>
                                                    <span class="align-middle">Log Out</span>
                                                </a>
                                            </form>
                                        </li>
                                   @endif
                               @endforeach
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header section end -->
    <!-- banner section start -->
    <div class="banner_section layout_padding">
        <div class="container">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="banner_taital">Get Start <br>Your favriot shoping</h1>
                                <div class="buynow_bt" style="padding: 10px"><a href="{{route('homePage')}}">Buy Now</a></div>
                            </div>
                        </div>
                    </div>

                </div>

        </div>
    </div>
    <div class="container" style="padding: 10px; margin: auto">
        @yield('main-content')
    </div>
    <!-- banner section end -->
</div>
<!-- banner bg main end -->
<!-- fashion section start -->
<!-- fashion section end -->
<!-- electronic section start -->

<!-- electronic section end -->
<!-- jewellery  section start -->
<!-- jewellery  section end -->
<!-- footer section start -->
<div class="footer_section layout_padding">
    <div class="container">
        <div class="footer_logo"><a href="index.html"><img src="{{asset('home/images/footer-logo.png')}}"></a></div>
        <div class="input_bt">
            <input type="text" class="mail_bt" placeholder="Your Email" name="Your Email">
            <span class="subscribe_bt" id="basic-addon2"><a href="#">Subscribe</a></span>
        </div>
        <div class="footer_menu">
            <ul>
                <li><a href="#">Best Sellers</a></li>
                <li><a href="#">Gift Ideas</a></li>
                <li><a href="{{route('newRelease')}}">New Releases</a></li>
                <li><a href="{{route('todaysDeal')}}">Today's Deals</a></li>
                <li><a href="{{route('customerService')}}">Customer Service</a></li>
            </ul>
        </div>
        <div class="location_main">Help Line  Number : <a href="#">+1 1800 1200 1200</a></div>
    </div>
</div>
<!-- footer section end -->
<!-- copyright section start -->
<div class="copyright_section">
    <div class="container">
        <p class="copyright_text">© 2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
    </div>
</div>
<!-- copyright section end -->
<!-- Javascript files-->
<!-- jquery library -->
<script src="{{ asset('home/js/jquery.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('home/js/bootstrap.bundle.js') }}"></script>
<!-- owl slider -->
<!-- custom js -->
<script src="{{ asset('home/js/custom.js') }}"></script>
<!-- Scrollbar Js Files -->
<script src="{{ asset('home/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- fancybox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('home/js/jquery.min.js') }}"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- DataTables initialization -->
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "pageLength": 5 // Display 5 items per page
        });
    });
</script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "200px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
</body>
</html>
