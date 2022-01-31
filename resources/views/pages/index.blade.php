
@extends('layouts.master')
@section('title', 'A great source of Bangla video and audio contents')
@section('robots', 'movie, music, text, sharing photo, photo,')
@section('content')
<style type="text/css">
  .post.img{
    top: 30%;
    left: 25%;
  }

    #loader-icon {
      position: fixed;
      top: 30%;
      width:100%;
      height:100%;
      text-align:center;
      display:none;
      z-index: 999;
  }

  .w3l-grids .box16 .box-content img.pre-img{
    top: 30%;
    left: 0;
    right: 0;
  }

</style>


<div class="container">
  <div class="align-middle">
     <div id="loading" class="align-middle" style="fixed:absolute;z-index: 999;">
            <img class="img-responsive" style="text-align: center;margin-top: 380px;margin-left: 250px;height: 240px;" src="{{ asset('frontend/assets/images/p6.gif') }}" />  
        </div>
  </div>
</div>



<div id="preloaderIdd">
@if( url()->current() == url('movie') || url()->current() == url('drama') || url()->current() == url('comedy') || url()->current() == url('music') || url()->current() == url('tvshow') || url()->current() == url('healtheducation') )
<section id="home" style="margin-bottom:85px;;">
@else
<section class="w3l-main-slider position-relative custom-slider" id="home" style="margin-bottom:35px;">
@endif
  <div class="companies20-content">
    <div class="owl-one owl-carousel owl-theme">
    @foreach ($data as $section)
      @if (count($section->contents) > 0)
        @if($section->contenttype == 4)
           @foreach ($section->contents as $content)
             <div class="item">
                <li> 
                  <!-- style='background: url("{{ str_replace('yt_th_max','yt_th_spot_banglaflix', $content->image_location) }}") no-repeat center; background-size: cover;' -->

                 <!--  style='background: url("{{ $content->image_location }}") no-repeat center; background-size: cover;' --><!--  -->

                  <a href="{{ url('/play/'.$content->contentid) }}" >
                 
                  @if($browsdata == 1)
                  <div class="slider-info banner-view bg bg2" style='background:  url("{{ $content->image_location }}") no-repeat center; background-size: cover;'> 
                  @else
                    <div class="slider-info banner-view bg bg2" style='background: url("{{ str_replace('yt_th_max','yt_th_spot_banglaflix', $content->image_location) }}") no-repeat center; background-size: cover;'> 
                  @endif
             
                  <div class="banner-info">
                    <span class="play-view1">
                      <span class="video-play-icon" style="color: #ff0000!important;">
                        <span class="fa fa-play"></span>
                      </span>
                      @if(isset($content->isfree))
                       @if($content->isfree == 1)
                         <h6>Play Now</h6>
                        @else
                        <h6>Watch Trailer</h6>
                       @endif
                      @endif
                     </span>
                     <div id="small-dialog1" class="zoom-anim-dialog mfp-hide"></div>
                   </div>

                 </div>
                </a>
              </li>
            </div>
            @endforeach
          @endif
      </div>
    </div>
  </section>
  <!--grids-sec2-->
  @if($section->contenttype == 1 || $section->contenttype == 2)
  <section class="w3l-grids" style="">
    <div class="grids-main">
      <div class="container py-lg-3 custom_height" style="">
        <div class="headerhny-title">
          <div class="w3l-title-grids">
            <div class="headerhny-left">
              <h3 class="hny-title">{{$section->catname}}</h3>
            </div>
            <div class="headerhny-right text-lg-right">

              <?php  
                $dashtitle = str_replace(' ', '-', $section->catname);
                $urlLink1 = strtolower($dashtitle);
                

                $urlLink = url('content').'/'.$urlLink1 .'/'.$section->catcode.'-'.$section->tc;
               
                

              ?>

              <a href="{{ $urlLink }}" class="cat-see-all bg-color-f2 show-title" style="color: #cf0000!important;" 
              >Show all</a>

             <!--  <form action="{{ route('contents') }}" method="post">
                  @csrf
                  <input type="hidden" name="ct" id="ct" value="{{$section->catcode}}" />
                  <input type="hidden" name="tc" id="tc" value="{{$section->tc}}" />
                  <input type="hidden" name="title" id="title" value="{{$section->catname}}" />
                  <input type="hidden" name="resolution" id="resolution" value="{{$section->resolution}}" />
                 <button class="btn btn-default"><a class="cat-see-all bg-color-f2 show-title" type="submit" style="color: #cf0000!important;">Show all</a></button>
              </form> -->
            </div>
          </div>
        </div>
        <div class="owl-three owl-carousel owl-theme">
         @foreach ($section->contents as $content)
          <div class="item vhny-grid">
            <div class="box16 mb-0">
              <a href="{{ url('/play/'.$content->contentid) }}" onclick="clickLink()">
                <figure>
                  <img class="img-fluid" src="{{$content->image_location}}" alt="">
                </figure>
                 <div class="box-content">
                    @if( $content->isfree == 0)
                  
                    @else
                     <img class="pre-img" src="{{ asset('img/c7.png') }}" >
                     @endif
                   <h4> 
                    <span class="post">
                      <span class="fa fa-clock-o"></span> 
                      {{ $content->duration }} 
                    </span>
                  </h4>
                </div>
                <span class="fa fa-play video-icon" aria-hidden="true"></span>
              </a>
            </div>
            <h2> <a class="title-gd" href="/play/{{$content->contentid}}" style="overflow: hidden;text-overflow: ellipsis;display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;" >{{$content->name}}</a></h2>
          </div>
          @endforeach
        @endif
        </div>
      </div>
    </div>
  </section>
   @endif
  @endforeach
 </div>

  <div id="loader-icon">
     <img src="{{ asset('frontend/assets/images/p6.gif') }}" />
  </div>


@endsection

@section('scripts')
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

  <script >
   function clickLink(){
    $('#loader-icon').show();
   }


  function seeall(ct,tc,resolution,title){
    console.log("dshfh");

    //SetCookie('seeall');
    //SetCookie('ct_seeall',ct,'1');
    //SetCookie('tc_seeall',tc,'1');
    //SetCookie('resolution_seeall',resolution,'1');
    var dashtitle = title.replace(/\s/g , "-").toLowerCase();
    var posturl = '{{ url('contents') }}';
    $.ajax({

    type:"POST",

    url:'{{ url('contents') }}',

    data:{
        '_token': '{{ csrf_token() }}',
        "_method" : "POST",
        'ct':ct,
        
       },
       dataType: "json",
       success: function (resp) {
           console.log('success');
           header = resp.getAllResponseHeaders()
           //and use informations in header or call resp to access response body

        },

   });
    


  }


  </script>
@endsection

    

