@extends('layouts.app')

@section('content')

  <section class="product-archive">
    <div class="container">

      <div class="search mb-3">
        <form action="" class="d-flex flex-row-reverse">
          <div class="form-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search">
          </div>
        </form>
      </div><!-- End Search -->

      <div class="row">
        @if(have_posts()) 
          @while(have_posts()) @php(the_post())
            <div class="card mb-3 text-center border-0 col-12 col-sm-4 col-md-3">
              <a href="{{ the_permalink() }}">
                <img class="card-img-top" src="{{ get_the_post_thumbnail_url( get_the_ID(), 'latest-product' ) }}" alt="Product Image">
              </a>
              <div class="card-body">
                <a href="{{ the_permalink() }}">
                  <h5 class="card-title">{{ the_title() }}</h5>
                </a>
                <p class="card-text"> {{ wp_trim_words( get_the_content() , 15, '...' ) }} </p>
              </div>
            </div>
          @endwhile
        @endif
      </div><!-- End Row -->

    </div>
  </section><!-- End Product -->

  <div style="background-image: url(' {{ get_template_directory_uri().'/assets/images/logo.png' }} ')" class="footer-image"></div><!-- End Background Image -->

@endsection