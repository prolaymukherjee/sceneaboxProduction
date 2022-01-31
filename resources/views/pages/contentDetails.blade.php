@extends('layouts.master')
@section('title', $data[0]->name)
@section('viewport', $conMeta)
@section('img-location', Session::get('img-location')) 
@section('name', Session::get('name')) 
@section('url', Session::get('url')) 
@section('description', Session::get('description'))


@section('content')
<input type="hidden" id="cookie_value_msisdn" name="{{$cookie_value_msisdn}}" value="{{$cookie_value_msisdn}}">
<input type="hidden" id="cookie_value_play" name="{{$cookie_value_play}}" value="{{$cookie_value_play}}">



<div class="container">
  <div class="align-middle">
     <div id="loading" class="align-middle" style="fixed:absolute;z-index: 999;">
            <img class="img-responsive" style="text-align: center;margin-top: 380px;margin-left: 250px;height: 240px;" src="{{ asset('frontend/assets/images/p6.gif') }}" />  
        </div>
  </div>
</div>

<div id="preloaderIdCon">
<div class="container content_details_height_show">
 <div class="w3l-about4" id="about" style="width:0px!important;">
  <div class="new-block" style="margin-left: 3px!important;">
    <div class="pop-img-ab position-relative">
      <div class="history-info">
       <video id='my-player' data-setup='{"fluid": true, "autoplay":true, "playbackRates": [0.5,1,1.25,1.5, 2]
        }'class='video-js' controls autoplay preload='auto'
        poster='{{$data[0]->image_location}}' data-setup='{}' style="">

        @if($data[0]->freecontent == "1")
          <source src='{{$data[0]->url}}' type='application/x-mpegURL'>
        @else

          @if($cookie_value_play == 1)
            <source src='{{$data[0]->url."?token=".$cookie_value_token}}' type='application/x-mpegURL'>
          @else
            <source src='{{$data[0]->urlpreview}}' type='application/x-mpegURL'>
          @endif
        @endif

          <p class='vjs-no-js'>
            To view this video please enable JavaScript, and consider upgrading to a web browser that
            <a href='https://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
          </p>
        </video>

        <a href="{{$data[0]->url}}"
          class="popup-with-zoom-anim play-view text-center position-absolute">
          <span class="">
            <span class=""></span>
          </span>
        </a>

      </div>
    </div>
  </div>
</div>


<div class="genre-single-page my-lg-5 my-4">
  <div class="row ab-grids-sec align-items-center">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 gen-right" id="#contentImg">
      <a href="#"><img class="img-fluid contentDetailsId" src="{{ $data[0]->image_location }}"></a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" >
      <h3 class="hny-title" >{{  $data[0]->name }}</h3>
      <p class="mt-2" style="overflow: hidden;text-overflow: ellipsis;display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;">{{  $data[0]->info }}</p>
      <div style="margin-top:15px;margin-bottom: 20px;">
         @if($cookie_value_play == 0)
               @if($data[0]->freecontent == 0)
                <a href="{{ url('subscription') }}" ><img class="subscribe_img" src="{{ asset('img/watch-full.png') }}" /></a>
               @else
                <a href="{{ url('subscription') }}" ><img class="subscribe_img" src="{{ asset('img/watch-unlimited.png') }}" /></a>
               @endif
         @endif
      </div>
    </div>  

    
     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" >
       <div class="gen-right-1">
          <div class="mb-3" style="height:40px;">
            <p><b>Type</b></p>
            <p>{{  $data[0]->type }} </p>
          </div>
          <div class="mb-3" style="height:40px;">
            <p><b>Duration</b></p>
            <p>{{  $data[0]->length2 }} </p>
          </div>
          
          <div class="mb-3" style="height:40px;">
            <p><b>By</b></p>
            <p>{{$data[0]->cp}}</p>
          </div>
       </div>
      </div>
    </div>
  </div>

  <!--grids-sec1-->

  @if($similar->contents!=null)
  <section class="w3l-grids">
    <div class="grids-main ">
      <div class="container py-lg-4">
        <div class="headerhny-title">
          <div class="w3l-title-grids">
            <div class="headerhny-left">
              <h3 class="hny-title">You May Also Like</h3>
            </div>
           
          </div>
        </div>
        <div class="w3l-populohny-grids">
       @foreach ($similar->contents as $content)
          <div class="item vhny-grid">
            <div class="box16 mb-0">
              <a href="{{ url('/play/'.$content->contentid) }}">
                <figure>
                  <img class="img-fluid" src='{{$content->image_location}}' alt="">
                </figure>



                <div class="box-content">
                  @if( $content->isfree == 0)
                  
                  @else
                   <img class="contentDetails-img" src="{{ asset('img/c7.png') }}">
                  @endif
                  <h3 class="title" style="overflow: hidden;text-overflow: ellipsis;display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;"> {{$content->name}}</h3>
                  <h4> <span class="post"><span class="fa fa-clock-o"> </span> {{$content->duration}}

                    </span>
                  </h4>
                </div>
                <span class="fa fa-play video-icon" aria-hidden="true"></span>
              </a>
            </div>
          </div>
       @endforeach
        </div>
      </div>
    </div>
  </section>

  @endif
  <!--//grids-sec1-->



      <!-- Modal HTML -->
          <div id="pointModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
              <div class="modal-content">
                <div class="modal-header justify-content-center">
                  <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                 <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                  <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_JV7NOY.json"  background="transparent" class="lottie-image"  speed="1"   loop  autoplay></lottie-player>

                  <p id="rewardpoint" style="font-weight:bold;font-size: 17px;"> </p>
                  <p id="ap_name" style="display: none;"></p>
                  <p id="ap_val" style="display: none;"></p>
                  <p id="ap_point" style="display: none;"></p>
                  <button class="btn btn-success" style="background-color:#ED1C24;color:#000;" onclick="sumbitpoint();"><span>Claim Your Reward</span></button>
                </div>
              </div>
            </div>
          </div>  


     <?php

      $campaign = $data[0]->{'campaign_details'};
      $arr = (array)$campaign;
      if (!$arr) {
        // echo "not found";
         $hasCampagain = 0;
         $adpoint1 = 0;
         $adpoint2 = 0;
         $adpoint3 = 0;
         $t_v1 = 0;
         $t_v2 = 0;
         $t_v3 = 0;
         $showad1 = 0;
         $showad2 = 0;
         $showad3 = 0;
      }else{
       // echo "found";
        $hasCampagain = 1;
        $ap1 = $data[0]->{'campaign_details'}->{'ap1'}->{'ap1'} ;
        $tv1 = $data[0]->{'campaign_details'}->{'ap1'}->{'tv1'} ;
        $show_ad1 = $data[0]->{'campaign_details'}->{'ap1'}->{'show_ad'} ;
       
        $ap2 = $data[0]->{'campaign_details'}->{'ap2'}->{'ap2'} ;
        $tv2 = $data[0]->{'campaign_details'}->{'ap2'}->{'tv2'} ;
        $show_ad2 = $data[0]->{'campaign_details'}->{'ap2'}->{'show_ad'} ;

        $ap3 = $data[0]->{'campaign_details'}->{'ap3'}->{'ap3'} ;
        $tv3 = $data[0]->{'campaign_details'}->{'ap3'}->{'tv3'} ;
        $show_ad3 = $data[0]->{'campaign_details'}->{'ap3'}->{'show_ad'} ;
        
        if($ap1==""){
          $adpoint1 = 0;
        }else{
          $adpoint1 = $ap1;
        }

        if($ap2==""){
          $adpoint2 = 0;
        }else{
          $adpoint2 = $ap2;
        }

        if($ap3==""){
          $adpoint3 = 0;
        }else{
          $adpoint3 = $ap3;
        }

        if($tv1==""){
          $t_v1 = 0;
        }else{
          $t_v1 = $tv1;
        }

        if($tv2==""){
          $t_v2 = 0;
        }else{
          $t_v2 = $tv2;
        }

        if($tv3==""){
          $t_v3 = 0;
        }else{
          $t_v3 = $tv3;
        }

        if($show_ad1==""){
          $showad1 = 0;
        }else{
          $showad1 = $show_ad1;
        }

        if($show_ad2==""){
             $showad2 = 0;
        }else{
           $showad2 = $show_ad2;
        }

        if($show_ad3==""){
            $showad3 = 0;
        }else{
          $showad3 = $show_ad3;
        }
      }
      
    ?>

</div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
    var msisdn = '<?php echo $cookie_value_msisdn; ?>';
    var has_Campagain = '<?php echo $hasCampagain; ?>';
   //console.log(has_Campagain);
    var ap ;
    var tv1;
    var tv2;
    var tv3;

    if(has_Campagain=='1'){
      console.log('found');
        ad_play1 = '<?php echo  $adpoint1 ?>';
        ad_play2 = '<?php echo  $adpoint2 ?>';
        ad_play3 = '<?php echo  $adpoint3 ?>';
        tv1 = '<?php echo $t_v1; ?>';
        tv2 = '<?php echo $t_v2; ?>';
        tv3 = '<?php echo $t_v3; ?>';
        showadd1 = '<?php echo $showad1 ?>';
        showadd2 = '<?php echo $showad2 ?>';
        showadd3 = '<?php echo $showad3 ?>';
       
    }else{
      ad_play1 = '0';
      ad_play2 = '0';
      ad_play3 = '0';
      tv1 = '0';
      tv2 = '0';
      tv3 = '0';
      showadd1 = '0';
      showadd2 = '0';
      showadd3 = '0';

     // console.log('not found');
    }

     var myPlayer = videojs('my-player', {autoplay: true});
    var playtime = 0;
    var isPlaying = false;
    var playType = "";
    var number = document.getElementById("cookie_value_msisdn").value;
    var cookie_value_play = document.getElementById("cookie_value_play").value;
    var whereYouAt = myPlayer.currentTime();



    myPlayer.ready(function() {
      var playposition = {{$data[0]->playposition}}
      myPlayer.currentTime(parseInt(playposition));
    });

    myPlayer.on('playing', function() {
      $('.vjs-big-play-button').hide();
      isPlaying = true;
    });

    myPlayer.one('play', function() {
      
      setInterval(timer, 1000);
      $('.vjs-big-play-button').hide();
    });
      myPlayer.on('timeupdate', function () {
        var elem = document.getElementById("my-player");
         //console.log( 'adplay1:'+ad_play1+'adplay2:'+ad_play2+'adplay3:'+ad_play3);
           var currenttime = parseInt(myPlayer.currentTime());
           //console.log(currenttime);
            if((ad_play1!="0")&&(currenttime==ad_play1)&&(showadd1=="1")){
               if(document.fullscreenElement){
                document.exitFullscreen();
              }
             // console.log(tv1);
             aptext = 'You have got '+ tv1+ ' points from treasure hunt campaign';
             $('#rewardpoint').text(aptext);
             $('#ap_name').text('ap1');
             $('#ap_val').text(ad_play1);
             $('#ap_point').text(tv1);
             $('#pointModal').modal('show');
             myPlayer.pause();
          } 
          if((ad_play2!="0")&&(currenttime==ad_play2)&&(showadd2=="1")){
             //console.log(tv2);
               if(document.fullscreenElement){
                document.exitFullscreen();
              }
              $('#ap_name').empty();
              $('#ap_val').empty();
              $('#ap_point').empty();
             aptext = 'You have got  '+ tv2+ ' points from treasure hunt campaign';
             $('#rewardpoint').text(aptext);
             $('#ap_name').text('ap2');
             $('#ap_val').text(ad_play2);
             $('#ap_point').text(tv2);
             $('#pointModal').modal('show');
             $("#pointModal").css("display", "block");
             myPlayer.pause();
          }
          
          if((ad_play3!="0")&&(currenttime==ad_play3)&&(showadd3=="1")){
             if(document.fullscreenElement){
                document.exitFullscreen();
              }
             //console.log(tv3);
             $('#ap_name').empty();
              $('#ap_val').empty();
              $('#ap_point').empty();
             aptext = 'You have got '+ tv3+ ' points from treasure hunt campaign';
             $('#rewardpoint').text(aptext);
             $('#ap_name').text('ap3');
             $('#ap_val').text(ad_play3);
             $('#ap_point').text(tv3);
             $('#pointModal').modal('show');
             $("#pointModal").css("display", "block");
             myPlayer.pause();
          }
       
        
      });
  
    myPlayer.one('waiting', function() {
      $('.vjs-big-play-button').hide();
    });

    myPlayer.on('pause', function() {
      $('.vjs-big-play-button').show();
      $('.vjs-seek-button').show();

      // Now the issue is that we need to hide it again if we start playing
      // So every time we do this, we can create a one-time listener for play events.
    });



  myPlayer.seekButtons({
    forward: 30,
    back: 10
  });


    window.onbeforeunload = function () {
      var whereYouAt = myPlayer.currentTime();
      if(playtime > 0){
        saveProgress(playtime, whereYouAt);
      }
    };

    myPlayer.on('ended', function() {
      if(playtime > 0){
        saveProgress(playtime, 0);
      }
    });

    function timer(){
      if(isPlaying){
        playtime++;
      }
    }

    function saveProgress(ptime, time){
      var catcode = '{{$data[0]->catcode}}';
      if(catcode == 'liv'){
         return;
       }

       if ({{$data[0]->freecontent}} == 1 || cookie_value_play == 1 ) {
         playType = "play";
       }else{
         playType = "preview";
       }

      if(number == 0){
        number = "";
      }
      console.log(number);
    /*  $.ajax({
            type: "POST",
            url: "{{ url('postplaytime') }}",
            data:{_token: "{{ csrf_token() }}",
            'type' : playType,
            'contentid' : '{{$data[0]->id}}',
            'time': time,
            'msisdn': number,
            'playtime' : ptime
          }
        }).done(function(data){
            console.log(data);
            playtime = 0;
            if(data == "false"){
              location.href = "{{ url('/') }}";
            }
        })*/
      }

      function sumbitpoint(){
        var username = msisdn; 
        var ap = $('#ap_name').text();
        var apval = $('#ap_val').text();
        var point = $('#ap_point').text();
        console.log('in username'+username+ap+apval+point);
        $.ajax({
            type: "POST",
            url: "{{ url('postCampaignData') }}",
            data:{_token: "{{ csrf_token() }}",
            'username' : username          ,
            'contentid' : '{{$data[0]->id}}',
            'ap': ap,
            'apval': apval,
            'point' : point
          }
        }).done(function(data){
            console.log(data);
            var current_time = parseInt(myPlayer.currentTime());
            var response = JSON.parse(data);
            console.log(response);
            Swal.fire({
                text: response.message,
                showCancelButton: true,
                confirmButtonColor: '#ED1C24',
               
              }).then((result) => {
                myPlayer.currentTime(current_time+1);
                myPlayer.play();
                console.log('found');
                    $("#pointModal").css("display", "none");
                    $('.modal-backdrop').remove();
              })
        })
    }
  </script>

   <script>
       var $loading = $('#loading').hide();
       var $loading1 = $('#preloaderIdCon').show();
       
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

@endsection