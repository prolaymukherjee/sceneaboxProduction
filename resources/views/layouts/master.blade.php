<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="robots" content="@yield('robots')">
<meta property="og:url" content="@yield('current-url')">
<meta property="og:type" content="website">
<meta property="og:title" content="@yield('name')">
<meta property="og:description" content="@yield('description')">
<meta property="og:image" content="@yield('img-location')">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<title>Sceneabox-@yield('title')</title>
<!-- Template CSS -->
<link rel="icon" href="img/ic_sceneabox.png" type="image/gif" sizes="16x16">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/style-liberty.css') }}">
<!-- Template CSS -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&amp;display=swap"
	rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}">

<!-- 	<link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" /> -->

<link href="{{ asset('videojs-7.6.0/video-js.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
<link href="{{ asset('videojs-7.6.0/videojs-seek-buttons.css') }}" rel="stylesheet">
<script src="{{ asset('videojs-7.6.0/videojs-ie8.min.js') }}"></script>
<script src="{{ asset('videojs-7.6.0/video.js') }}"></script>
<script src="{{ asset('videojs-7.6.0/videojs-seek-buttons.js') }}"></script>
<!-- Template CSS -->
<script src="{{ asset('frontend/assets/js/monetization.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src='https://www.googletagmanager.com/gtag/js?id=UA-149859901-1'></script>

</head>


<body>

 <?php 
	
	$desId = Session::get('brsDevice');

 ?>


<div id="right-sidebar" class="right-sidebar-notifcations nav-collapse">
	<div class="bs-example bs-example-tabs right-sidebar-tab-notification" data-example-id="togglable-tabs">
     <div class="right-sidebar-panel-content animated fadeInRight" tabindex="5003" style="overflow: hidden; outline: none;">
     </div>
	</div>
</div>
	




	<!-- header -->
	<header id="site-header" class="w3l-header fixed-top" onload="loadFunction()">
		<nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
			<div class="container">
				 <div id="dayId" style="display:block;" value = "{{ $desId }}">
						<a class="navbar-brand" href="{{ url('/') }}" id="lightLogo" >
							
						</a>
				</div>	
				<button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="fa icon-expand fa-bars"></span>
					<span class="fa icon-close fa-times"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item  {{ url()->current() == url('/') ? 'active':'' }} ">
							<a class="nav-link" href="{{ url('/') }}">Home</a>
						</li>
						
						<li class="nav-item dropdown  {{ url()->current() == url('movie') ? 'active':'' }} {{ url()->current() == url('drama') ? 'active':'' }} {{ url()->current() == url('comedy') ? 'active':'' }} {{ url()->current() == url('music') ? 'active':'' }} {{ url()->current() == url('tvshow') ? 'active':'' }} {{ url()->current() == url('healtheducation') ? 'active':'' }}">
							<a class="nav-link dropdown-toggle" href="index.html#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Genre <span class="fa fa-angle-down"></span>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item {{ url()->current() == url('movie') ? 'active':'' }}" href="{{  url('movie') }}">Movie</a>
								<a class="dropdown-item {{ url()->current() == url('drama') ? 'active':'' }}" href="{{  url('drama') }}">Drama</a>
								<a class="dropdown-item {{ url()->current() == url('comedy') ? 'active':'' }}" href="{{  url('comedy') }}">Comedy</a>
								<a class="dropdown-item {{ url()->current() == url('music') ? 'active':'' }}" href="{{  url('music') }}">Music</a>
								<a class="dropdown-item {{ url()->current() == url('tvshow') ? 'active':'' }}" href=" {{ url('tvshow') }} ">TV Show</a>
								<a class="dropdown-item {{ url()->current() == url('healtheducation') ? 'active':'' }}" href="{{  url('healtheducation') }}">Health & Education</a>
							</div>
						</li>
						<li class="nav-item {{ url()->current() == url('subscription') ? 'active':'' }}">
							<a class="nav-link" href="{{ url('subscription') }}">Subscription</a>
						</li>
						<li class="nav-item {{ url()->current() == url('myaccount') ? 'active':'' }}">
							<a class="nav-link" href="{{ url('myaccount') }}">My Account</a>
						</li>
						<li class="nav-item {{ url()->current() == url('logout') ? 'active':'' }} {{ url()->current() == url('login') ? 'active':'' }}">
							@if($cookie_value_msisdn!="")
      		       <a href="{{ url('logout') }}" class="nav-link">Logout</a>
					    @else
					       <a href="{{ url('login') }}" class="nav-link">Login</a>
					    @endif
						</li>
					</ul>

					<div class="search-right">
						<a href="#search" class="btn search-hny mr-lg-3 mt-lg-0 mt-4" title="search" style="background: #ff0000!important;border: 1px solid #ff0000!important;">Search <span
								class="fa fa-search ml-3" aria-hidden="true"></span></a>
						<!-- search popup -->
						<div id="search" class="pop-overlay">
							<div class="popup">
								<form action="{{route('search')}}" method="post" class="search-box">
									 @csrf
									<input type="search" placeholder="Search for Movie, Drama, TV Show and Music Video" name="key"
										required="required" autofocus="">
									<button type="submit" class="btn"><span class="fa fa-search"
											aria-hidden="true"></span></button>
								</form>
								<div class="browse-items">
									<h3 class="hny-title two mt-md-5 mt-4">Browse all:</h3>
									<ul class="search-items">
										<li><a href="{{ url('movie') }}">Movie</a></li>
										<li><a href="{{ url('drama') }}">Drama</a></li>
										<li><a href="{{ url('comedy') }}">Comedy</a></li>
										<li><a href="{{ url('music') }}">Music</a></li>
										<li><a href="{{ url('tvshow') }}">TV Show</a></li>
										<li><a href="{{ url('healtheducation') }}">Health & Education</a></li>
										
									</ul>
								</div>
							</div>
							<a class="close" href="#close">×</a>
						</div>
					</div>
				</div>


				<div class="mobile-position">
					<nav class="navigation">
						<div class="theme-switch-wrapper">
							<label class="theme-switch" for="checkbox">
								<input type="checkbox" id="checkbox" >
								<div class="mode-container">
									<i class="gg-sun" ></i>
									<i class="gg-moon" ></i>
								</div>
							</label>
						</div>
					</nav>
				</div>
			</div>
		</nav>
	</header>


@yield('content')

	<!-- footer-66 -->
	<footer class="w3l-footer">
		<section class="footer-inner-main">
			<div class="footer-hny-grids py-5">
				<div class="container py-lg-4">
					<div class="text-txt">
						<div class="right-side">
							<div class="row footer-links">
								<div class="col-md-3 col-sm-6 sub-two-right mt-5">
									<h6>Genre</h6>
									<ul>
										<li><a href="{{ url('movie') }}">Movies</a></li>
										<li><a href="{{ url('drama') }}">Drama</a></li>
										<li><a href="{{ url('comedy') }}">Comedy</a></li>
										<li><a href="{{ url('music') }}">Music</a></li>
									</ul>
								</div>
								<div class="col-md-3 col-sm-6 sub-two-right mt-5">
									<h6>Information</h6>
									<ul>
										<li><a href="{{ url('about') }}">About</a> </li>
										<li><a href="{{ url('privacy') }}">Privacy Policy</a></li>
										<li><a href="{{ url('license') }}">License</a></li>
										<li><a href="{{ url('help') }}">Help</a></li>
									</ul>
								</div>

								<div class="col-md-3 col-sm-6 sub-two-right mt-5">
									<h6>Others</h6>
									<ul>
									<li><a href="{{ url('myaccount') }}">My Account</a></li>
									<li><a href="{{ url('subscription') }}">Subscription</a></li>
								</ul>
								</div>
								<div class="col-md-3 col-sm-6 sub-two-right mt-5">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="below-section">
				<div class="container">
					<div class="copyright-footer">
						<div class="columns text-lg-left">
							<p>&copy;<?php echo  date('Y'); ?> E.B. Solutions Limited. All rights reserved  </p>
						</div>
					</div>
				</div>
			</div>

			<button onclick="topFunction()" id="movetop" title="Go to top">
				<span class="fa fa-arrow-up" aria-hidden="true"></span>
			</button>
			<script>
				// When the user scrolls down 20px from the top of the document, show the button
				window.onscroll = function () {
					scrollFunction()
				};

				function scrollFunction() {
					if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
						document.getElementById("movetop").style.display = "block";
					} else {
						document.getElementById("movetop").style.display = "none";
					}
				}

				// When the user clicks on the button, scroll to the top of the document
				function topFunction() {
					document.body.scrollTop = 0;
					document.documentElement.scrollTop = 0;
				}
			</script>
			<!-- /move top -->

		</section>
	</footer>
	<!--//footer-66 -->



	</body>

</html>
<script src="{{ asset('frontend/assets/js/jquery-1.9.1.min.js') }}"></script>
<!-- <script src="{{ asset('frontend/assets/js/main.js') }}"></script> -->
<script src="{{ asset('frontend/assets/js/easyResponsiveTabs.js') }}"></script>
<script src="{{ asset('frontend/assets/js/theme-change.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
<script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
@yield('scripts')


<script>
	$(document).ready(function () {
		$('.owl-one').owlCarousel({
			stagePadding:280,
			loop: true,
			margin: 20,
			nav: true,
			responsiveClass: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 1,
					stagePadding:40,
					nav: false
				},
				480: {
					items: 1,
					stagePadding:60,
					nav: true
				},
				667: {
					items: 1,
					stagePadding:80,
					nav: true
				},
				1000: {
					items: 1,
					nav: true
				}
			}
		})
	})
</script>
<!-- //script -->
<script>
	$(document).ready(function () {
		$('.owl-three').owlCarousel({
			loop: true,
			margin: 20,
			nav: false,
			responsiveClass: true,
			/*autoplay: true,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,*/
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 2,
					nav: false
				},
				480: {
					items: 2,
					nav: true
				},
				667: {
					items: 3,
					nav: true
				},
				1000: {
					items: 4,
					nav: true
				}
			}
		})
	})
</script>
<script>
	$(document).ready(function () {
		$('.owl-mid').owlCarousel({
			loop: true,
			margin: 0,
			nav: false,
			responsiveClass: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 1,
					nav: false
				},
				480: {
					items: 1,
					nav: false
				},
				667: {
					items: 1,
					nav: true
				},
				1000: {
					items: 1,
					nav: true
				}
			}
		})
	})
</script>
<script>
	$(document).ready(function () {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});

		$('.popup-with-move-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-slide-bottom'
		});
	});
</script>
<script>
	$(function () {
		$('.navbar-toggler').click(function () {
			$('body').toggleClass('noscroll');
		})
	});
</script>
<script>
	$(window).on("scroll", function () {
		var scroll = $(window).scrollTop();

		if (scroll >= 80) {
			$("#site-header").addClass("nav-fixed");
		} else {
			$("#site-header").removeClass("nav-fixed");
		}
	});

	//Main navigation Active Class Add Remove
	$(".navbar-toggler").on("click", function () {
		$("header").toggleClass("active");
	});
	$(document).on("ready", function () {
		if ($(window).width() > 991) {
			$("header").removeClass("active");
		}
		$(window).on("resize", function () {
			if ($(window).width() > 991) {
				$("header").removeClass("active");
			}
		});
	});
</script>

  <script type="text/javascript">
    $(document).ready(function () {
      //Horizontal Tab
      $('#parentHorizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        tabidentify: 'hor_1', // The tab groups identifier
        activate: function (event) { // Callback function if tab is switched
          var $tab = $(this);
          var $info = $('#nested-tabInfo');
          var $name = $('span', $info);
          $name.text($tab.text());
          $info.show();
        }
      });
    });
  </script>  

  <script>
       var $loading = $('#loading').hide();
       var $loading1 = $('#preloaderIdd').show();
       
       $(document)
         .ajaxStart(function () {
            //ajax request went so show the loading image
             $loading.show();
             $loading1.hide();
         })
       .ajaxStop(function () {
           //got response so hide the loading image
            $loading.hide();
            $loading.show();
        });
  </script>

<script>
$(document).ready(function(){

	var disDiv = document.getElementById('dayId').getAttribute('value');

	console.log("test",disDiv);
	
   if(disDiv ==0 ){

   	 if(localStorage.getItem('theme') == 'dark'){
			$('#lightLogo').html('<img src="{{ asset('img/l2.png') }}" alt="Your logo" title="Your logo" style="height:35px;margin-top:-10px;" />');
		}else{
			$('#lightLogo').html('<img src="{{ asset('img/l1.png') }}" alt="Your logo" title="Your logo" style="height:35px;margin-top:-10px;" />');
		}
		$('#checkbox').on('change',function (){
			if(localStorage.getItem('theme') == 'dark'){
			
				$('#lightLogo').html('<img class="img-position" src="{{ asset('img/l2.png') }}" alt="Your logo" title="Your logo" style="height:35px;margin-top:-10px;" />');
			}else{
				$('#lightLogo').html('<img class="img-position" src="{{ asset('img/l1.png') }}" alt="Your logo" title="Your logo" style="height:35px;margin-top:-10px;" />');
			}
	 })

   }else{

   	 if(localStorage.getItem('theme') == 'dark'){
			$('#lightLogo').html('<img src="{{ asset('img/l2.png') }}" alt="Your logo" title="Your logo" style="height:25px;margin-top:-10px;" />');
		}else{
			$('#lightLogo').html('<img src="{{ asset('img/l1.png') }}" alt="Your logo" title="Your logo" style="height:25px;margin-top:-10px;" />');
		}
		$('#checkbox').on('change',function (){
			if(localStorage.getItem('theme') == 'dark'){
			
				$('#lightLogo').html('<img class="img-position" src="{{ asset('img/l2.png') }}" alt="Your logo" title="Your logo" style="height:25px;margin-top:-10px;" />');
			}else{
				$('#lightLogo').html('<img class="img-position" src="{{ asset('img/l1.png') }}" alt="Your logo" title="Your logo" style="height:25px;margin-top:-10px;" />');
			}
	 })

   }

});
</script>


<!--//MENU-JS-->

