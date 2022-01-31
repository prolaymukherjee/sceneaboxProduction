  <section class="w3l-grids" style="">
    <div class="grids-main">
      <div class="container py-lg-3 custom_height" style="">
        <div class="w3l-populohny-grids">
         @foreach ($data->contents as $content)
         <div class="item vhny-grid">
          <div class="box16 mb-0">
            <a href="{{ url('/play/'.$content->contentid) }}">
              <figure>
                  <img class="img-fluid" src="{{$content->image_location}}" alt="">
               </figure>
                <div class="box-content">
                   @if( $content->isfree == 0)
                     
                   @else
                    <img class="con-img" src="{{ asset('img/c7.png') }}" >
                   @endif
                   <h3 class="title seeAllTitle" style="overflow: hidden;text-overflow: ellipsis;display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;"> {{$content->name}}</h3>
                   <h4>
                    <span class="post"><span class="fa fa-clock-o"> </span> {{$content->duration}}
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


