<section class="home-slider">
  <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      @php($counter=0) 
        @if( $general_slider ) 
          @foreach($general_slider as $slider)
            <div class="carousel-item {{ $counter == 0 ? 'active' : '' }}" style="background-image:url('{{ $slider['image'] }}')">
              <div class="carousel-caption d-none d-md-block">
                <h5>{{ $slider['title'] }}</h5>
                <p>{{ $slider['content'] }}</p>
              </div>
            </div>
          @php($counter++)
        @endforeach
      @endif
    </div>
    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</section>
