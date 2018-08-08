<section class="about-section">
  <div class="container">
    <div class="row">

      <div class="custom-border col-12">
        @php($border_img = get_template_directory_uri().'/assets/images/border.png')
        <img src="{{ $border_img }}" />
      </div><!-- End Border -->

      <div class="content offset-6">

        <div class="title">
          <span>{{ _e('about','ramsco') }}</span>
          @if(get_field('website_logo','option'))
            <img src="{{ get_field('website_logo','option') }}" alt="Website logo">
          @else
            <img src="{{ get_template_directory_uri().'/assets/images/logo.png' }}" alt="Website logo">
          @endif
        </div><!-- End Title -->

        <div class="descreption">
          @php( $content = new WP_Query( 'pagename=about' ) )
            @while ( $content->have_posts() ) @php($content->the_post())
              {{ the_content() }}
            @endwhile
          @php(wp_reset_postdata())
          <p>
            <a href="{{ get_permalink( get_page_by_path( 'about' ) ) }}">{{ _e('read more','ramsco') }}</a>
          </p>
        <div><!-- End descreption -->

      </div><!-- End Content -->

    </div>
  </div>
</section>


@if(get_field('about_img','option'))
  @php($img = get_field('about_img','option'))
@else
  @php($img = get_template_directory_uri().'/assets/images/about-img.png')
@endif
<div style="background-image: url('{{ $img }}')" class="home-background"></div><!-- End Background Image -->