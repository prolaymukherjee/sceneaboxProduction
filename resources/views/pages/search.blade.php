@extends('layouts.master')
@section('title', 'A great source of Bangla video and audio contents')
@section('content')


<style type="text/css">
	.cat-name {
    font-size: 18px;
    font-style: normal;
    color: #141414;
    margin-left: 5px;
    padding: 15px;
    width: 1050px;
}
.searchContainer{
	margin-top:100px;
}
@media (max-width: 650px) {
	.searchContainer{
	margin-top:30px!important;
}
}

</style>

<div class="container"> 
	<div class="p-1 searchContainer">
	  @if (count($data->contents) > 0)
	    <div class="row">
	      <div class="cat-name">
	        Showing all results for '{{$data->catname}}'
	      </div>
	    </div>
	    <div class="row" id="post-data">
	      @include('pages.moredata', ['data' => $data])
	    </div>
	   @endif
	</div>
</div>	

<!-- <div class="ajax-load text-center" style="display:none">
	<p><img src="/img/loader.gif"> Loading More...</p>
</div> -->
<div id="snackbar"></div>

<script type="text/javascript">
	var page = 1;
  var key = "{{$key}}";
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
      url: "{{ url('search') }}",
      data:{_token: "{{ csrf_token() }}",
        key:key,
        page:page
      },beforeSend: function(){
	        // $('.ajax-load').show();
	      }
	   }).done(function(data){
	       if(data == ""){
	          $('.ajax-load').html("No more records found");
            $('.ajax-load').hide();
           showtoast('No More Item to Load');
	         return;
	       }
	       // $('.ajax-load').hide();
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
