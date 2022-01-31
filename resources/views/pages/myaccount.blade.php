@extends('layouts.master')

@section('title', 'My Account')

@section('content')


  <div class="w3l-breadcrumbs">
    <nav id="breadcrumbs" class="breadcrumbs">
      <div class="container page-wrapper">
        <a href="{{ url('/') }}">Home</a> » <span class="breadcrumb_last" aria-current="page">My Account</span>
      </div>
    </nav>
  </div>
  <!--//breadcrumbs -->
  <div style="margin: 8px auto; display: block; text-align:center;">

<!---728x90--->

 
</div>


<div class="container" style="margin-top:80px;margin-bottom: 180px;">

	<div class="p-2">
		<div class="row justify-content-center" style="margin-bottom:15px!important;">
				<img src="img/ic_account.png" class="rounded-circle">
		</div>

		@if($cookie_value_msisdn != '')
			<div class="row justify-content-center" >
					<p>Phone Number: {{ substr($cookie_value_msisdn,2) }}</p>
			</div>

		@if($data->subscriptionlog != null)
			<div class="mt-5 pb-2 h6" style="margin-top:35px!important;">
				Subscription History
			</div>

			<table class="table table-dark">
					<thead class="thead-light">
						 <tr>
						    <th scope="col">Date</th>
						    <th scope="col">Package</th>
						    <th scope="col">Charge Amount</th>
						 </tr>
					</thead>
					<tbody>
						@foreach($data->subscriptionlog as $subInfo)
							<tr>
							  <td>{{$subInfo->datetime}}</td>
							  <td>{{$subInfo->purpose}}</td>
								@if($subInfo->amount=="")
							  	<td>-</td>
								@else
									<td>{{$subInfo->amount}}tk</td>
								@endif
							</tr>
						@endforeach
					</tbody>
			</table>
		@else
			<div class="row justify-content-center">
					<p>Not found Subscription History</p>
			</div>
		@endif
	@else
		<div class="row justify-content-center">
				<p>Please Login to get Subscription History</p>
		</div>
	@endif

</div>
</div>

@endsection
