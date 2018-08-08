<section class="latest-product">
  <div class="container">
    <div class="row justify-content-center">

      @php
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3,
            'suppress_filters' => 0,
          );
        $product = new WP_Query($args);
      @endphp

      @if($product->have_posts()) 
        @while($product->have_posts()) 
          @php ($product->the_post())
          <div class="card mb-3 text-center border-0 col-8 col-sm-4 col-md-3">
            <img class="card-img-top" src="{{ get_the_post_thumbnail_url( get_the_ID(), 'latest-product' ) }}" alt="Product Image">
            <div class="card-body">
              <h5 class="card-title">{{ the_title() }}</h5>
              <a href="{{the_permalink()}}">{{ _e('view more','ramsco') }}</a>
            </div>
          </div>
        @endwhile
      @endif

      <div class="archive-link col-md-9 col-offset-md-3">
        <a href="{{ get_post_type_archive_link( 'product' ) }}">{{ _e('View products','ramsco') }}</a>
      </div>

    </div>
  </div>
</section>
<!-- End Product Section -->
