@extends('layouts.master')
@section('title', 'A great source of Bangla video and audio contents')
@section('content')

<div class="container"  style="margin-top:45px!important;">
    <div class="pd-5">
      @if (count($data->contents) > 0)
        <div class="row">
          <div class="headerhny-title">
            <h3 class="hny-title" style="margin-top: 50px;margin-left: 15px;">
              {{$data->catname}}
            </h3>
          </div>
           <div class="row" id="post-data">
              @include('pages.moredata', ['data' => $data])
           </div>
        </div>
      @endif
    </div>
  </div>
 

<div class="ajax-load text-center" style="display:none">
  <p><img src="{{ asset('frontend/assets/images/p6.gif') }}" style="padding: 0px!important;margin: 0px!important;width: 90px;"><span>Loading More...</span></p>
</div>


@endsection
@section('scripts')


<script type="text/javascript">
  var page = 1;
  var ct = "{{$ct}}";
  var tc = "{{$tc}}";
  var title ="{{$title}}";
  var res = "{{$resolution}}";
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          page++;
          loadMoreData(page);
          //alert(page);
      }
  });

function loadMoreData(page){
  $.ajax({
      type: "POST",
      url: "{{ url('contents') }}",
      data:{_token: "{{ csrf_token() }}",
        ct:ct,
        tc:tc,
        resolution:res,
        title:title,
        page:page
      },beforeSend: function(){
          $('.ajax-load').show();
        }
     }).done(function(data){
         if(data == ""){
           $('.ajax-load').html("No more records found");
           $('.ajax-load').hide();
           showtoast('No More Item to Load');
           return;
         }
         $('.ajax-load').hide();
         $("#post-data").append(data);
       }).fail(function(jqXHR, ajaxOptions, thrownError){
           alert('server not responding...');
       });
  }

function showtoast(text){
    var x = document.getElementById("snackbar");
    document.getElementById("snackbar").innerHTML = text;
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
 }


</script>


@endsection

