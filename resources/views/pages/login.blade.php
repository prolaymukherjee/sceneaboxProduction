@extends('layouts.master')
@section('title', 'Login')
@section('content')
<div class="w3l-breadcrumbs">
	<nav id="breadcrumbs" class="breadcrumbs">
			<div class="container page-wrapper">
				<a href="index.html">Home</a> » <span class="breadcrumb_last" aria-current="page">Login</span>
			</div>
		</nav>
</div>
<div style="margin: 8px auto; display: block; text-align:center;"></div>
	<section class="w3l-loginhny py-5">
		<!-- login -->
		<div class="container py-lg-3">
		  <div class="w3l-hny-login">
			<div class="w3l-hny-login-info" id="sinId1">
			  	<h2>Login to your Account</h2>
			 <form class="form-signin" action="{{ url('loginsubmit') }}" method="post">
		       @csrf
				<label>Phone No</label>
				<div class="input-group">
				  <input type="text" name="msisdn-login" id="inputEmail" class="form-control" placeholder="01xxxxxxxxx" required="" autofocus="" maxlength="11">
				</div>
				<label>Password</label>
				<div class="input-group">
				 <input type="password" name="password-login" id="inputPassword" class="form-control mt-2" placeholder="Password" required="">
				</div>
				<button class="btn read-button btn-login" type="submit">Login</button>

				<div class="row justify-content-between m-1">
					<a href="#" onclick='myFunction1()' style="color:red;">Forgot password?</a>
					<a href="#" onclick="myFunction2()" style="color:red;">Sign Up</a>
				</div>
			  </form>
			  
			</div>


          <div class="w3l-hny-login-info" id="forGetPass" style="display: none">
			  	<h2>Forgot Password</h2>
			  
			  <form action="{{ url('forgotpass')}}" class="form-reset">
		       @csrf
				
				<div class="input-group">
				 <input type="text" name="msisdn-forgot" id="resetEmail" class="form-control" placeholder="01xxxxxxxxx" required="" autofocus="" maxlength="11">
				</div>
				<p>Please enter your registered mobile number.You will get the password in the SMS inbox.</p>
				
				<button class="btn read-button btn-login" type="submit">Send</button>

				<a href="{{ url('login')}}" id="cancel_reset" style="color:red;"><i class="fa fa-angle-left mt-3"></i> Back</a>
			  </form>
			  	
			</div>

	        <div class="w3l-hny-login-info" id="sinPass" style="display: none">
			  	<h2>Sign Up</h2>
			  
			  <form action="{{ url('signupsubmit') }}" class="form-signup" method="post">
		       @csrf
					<div class="input-group">
					  <input type="text" name="msisdn-signup" id="resetEmail" class="form-control" placeholder="01xxxxxxxxx" required="" autofocus="" maxlength="11">
					</div>
				   <p>Register with your mobile number and get pincode</p>
				   <button class="btn read-button btn-login" type="submit">Sign Up</button>
				    <a href="{{ url('login')}}" id="cancel_signup" class="mt-1" style="color:red;"><i class="fa fa-angle-left mt-3"></i> Back</a>
			  </form>

			</div>




		  </div>
		</div>
	  </section>
	  <!-- //login -->
	  <div style="margin: 8px auto; display: block; text-align:center;">

<!---728x90--->
 



</div>





@endsection


@section('scripts')

	@if($msg!="")
		<script>
			swal({
				text: '{{$msg}}',
				icon: "info",
				button: "OK",
			});
		</script>
	@endif


<script>
	function myFunction1() {
	  $("#sinId1").hide();
	  $("#forGetPass").show();
	  $("#sinPass").hide();
	}

	function myFunction2() {
	  $("#sinId1").hide();
	  $("#forGetPass").hide();
	  $("#sinPass").show();
	}



</script>

@endsection