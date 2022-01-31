@extends('layouts.master')
@section('title', "Info")
@section('content')

<div class="w3l-breadcrumbs">
    <nav id="breadcrumbs" class="breadcrumbs">
      <div class="container page-wrapper">
        <a href="{{ url('/') }}">Home</a> » <span class="breadcrumb_last" aria-current="page">About</span>
      </div>
    </nav>
  </div>
  <!--//breadcrumbs -->
  <div style="margin: 8px auto; display: block; text-align:center;">
</div>


<div class="container" style="margin-top:50px;">
    <div class="d-grid grid-colunm-2 mt-lg-5 mt-4">
        <div class="single-left">
          <div class="single-left1">
             <div class="btom-cont" style="font-size: 15px!important;">
               <h5 class="card-title" style="font-weight:700;color:black;">{{ucfirst($tag)}}</h5>
               <p class="" style="font-weight:600;color:black;font-size: 17px;">{!!$data->details!!}</p>
             </div>
           </div>
        </div>
     </div>
</div>
@endsection
