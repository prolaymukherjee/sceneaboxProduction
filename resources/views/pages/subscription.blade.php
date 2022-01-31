@extends('layouts.master')
@section('title', 'Subscription')
@section('content')

<style type="text/css">
		#loader-icon {
    	position: fixed;
    	top: 20%;
    	width:100%;
    	height:100%;
    	text-align:center;
    	display:none;
	}
</style>

  <div class="w3l-breadcrumbs">
    <nav id="breadcrumbs" class="breadcrumbs">
      <div class="container page-wrapper">
        <a href="{{ url('/') }}">Home</a> » <span class="breadcrumb_last" aria-current="page">Subscription</span>
      </div>
    </nav>
  </div>
  <!--//breadcrumbs -->




<div id="preloaderIdSub">
	 <div class="container" style="margin-top:50px;">
			<div class="p-1 mt-4">
				<div class="row justify-content-center m-1">
					@if($cookie_value_msisdn=="")
						<h5 style="margin-bottom:15px;">You are subscribed to no packs!</h5>
					@else
						<p class="h5">{{$cookie_value_packtext}}</p>
					@endif
				</div>

				<ul class="list-group sub-info mx-auto subscription_table" style="">
					@foreach ($subInfo->subschemes as $info)
						 @if($cookie_value_packcode==$info->sub_pack)
							 <li class="list-group-item d-flex justify-content-between align-items-center">
						     {{$info->sub_text}}
						     <button class="btn btn-dark" onclick="unsubscribe('{{$info->pack_name}}','{{$cookie_value_msisdn}}');">Unsubscribe</button>
						   </li>
						 @else
							<li class="list-group-item d-flex justify-content-between align-items-center">
							  {{$info->sub_text}}
								@if($cookie_value_packcode=="nopack" || $cookie_value_msisdn=="")
							    <button class="btn btn-dark" onclick="subscribe('{{$info->sub_pack}}','{{$cookie_value_msisdn}}');" class="btn btn-light" value="{{$info->sub_pack}}">Subscribe</button>
								@else
									<button class="btn btn-dark" disabled >Subscribe</button>
								@endif
							 </li>
						 @endif
				  @endforeach
				</ul>
		  </div>
		</div>
	</div>	

	<div id="loader-icon">
	   <img src="{{ asset('frontend/assets/images/p6.gif') }}" />
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
function subscribe(packcode,msisdn) {
				var result = msisdn.match(/^[0-9]{13}$/);
				if(result == null){
					window.location = "{{ url('login') }}";
				} else {
					subcall(msisdn, packcode);
				}
			}

			function subcall(msisdn, packcode){
				$.ajax({
					type:"POST",
					url: "{{ url('sub') }}",
					data:{_token: "{{ csrf_token() }}",
					subrequest:"1",
					msisdn:msisdn,
					packcode :packcode
				},
				beforeSend: function(){
					$('#loader-icon').show();
				},
				complete: function(){
					$('#loader-icon').hide();
				},
				success: function(data){
					var obj = JSON.parse(data);
					if(obj['url'] != ""){
						document.location = obj['url'];
						exit;
					} else{
						swal(obj['response']);
					}
				}
			});
		}

		function unsubscribe(packtext,msisdn) {
			swal("Are you sure want to unsubscribe from " + packtext + " pack?", {
				buttons: {
					cancel: "Cancel",
					unreg: {
						text: "Confirm",
						value: "unreg",
					},
				},
			})
			.then((value) => {
				switch (value) {
					case "unreg":
					unsubcall(msisdn);
					break;
					default:
				}
			});
		}

		function unsubcall(msisdn){
				$.ajax({
					type:"POST",
					url: "{{ url('unsubNonSms') }}",
					data:{_token: "{{ csrf_token() }}",
					msisdn:msisdn
				},
				beforeSend: function(){
					$('#loader-icon').show();
				},
				complete: function(){
					$('#loader-icon').hide();
				},
				success: function(data){
					var obj = JSON.parse(data);
						if(obj['response'] != ""){
							swal(obj['response']).then((value) => {
								document.location = '{{ url('/') }}';
								exit;
							});
						} else{
							 swal(obj['response']);
							}
					}
			});
		}
	</script>

@endsection
