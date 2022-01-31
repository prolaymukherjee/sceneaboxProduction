$(document).ready(function() {
  window.scrollTo(0,0);
   $(".owl-lazyLoad-banner").owlCarousel({
      items : 3,
      autoPlay:true,
      lazyLoad : true,
      slideSpeed : 500,
      pagination: false,
      autoWidth:true,
      navigation : false,
      responsive: true,
      singleItem:false,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [979, 3],
      itemsTablet: [600,2],
      itemsMobile : [479,1],
      });
});
$(document).ready(function() {
  $(".owl-lazyLoad").owlCarousel({
      items : 5,
      autoPlay:false,
      dots:true,
      loop: false,
      rewind:true,
      pagination:false,
      lazyLoad : true,
      slideSpeed : 0,
      responsive: true,
      singleItem:false,
      itemsDesktop: [1199, 5],
      itemsDesktopSmall: [979, 3],
      itemsTablet: [600,3],
      itemsMobile : [479,2],
  });

  $( '.navbar-nav a' ).on( 'click', function () {
  	$( '.navbar-nav' ).find( 'a.active' ).removeClass( 'active' );
  	$( 'navbar-nav a' ).addClass( 'active' );
  });


  function toggleResetPswd(e){
      e.preventDefault();
      $('#logreg-forms .form-signin').toggle() // display:block or none
      $('#logreg-forms .form-reset').toggle() // display:block or none
  }

  function toggleSignUp(e){
      e.preventDefault();
      $('#logreg-forms .form-signin').toggle(); // display:block or none
      $('#logreg-forms .form-signup').toggle(); // display:block or none
  }

  $(()=>{
      // Login Register Form
      $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
      $('#logreg-forms #cancel_reset').click(toggleResetPswd);
      $('#logreg-forms #btn-signup').click(toggleSignUp);
      $('#logreg-forms #cancel_signup').click(toggleSignUp);
  })
  
});
