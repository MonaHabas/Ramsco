@if( is_home() )
  @php($img = get_field('footer_img','option'))
  <div style="background-image: url('{{ $img }}')" class="home-background"></div>
@endif
<!-- End Background Image -->

<footer class="mt-5">
  <div class="container">
    <div class="row">

      @if (has_nav_menu('footer_navigation'))
        <div class="mb-3 mb-sm-0 px-3 px-sm-0 col-12 col-sm-3 col-md-4">
          {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav menu-footer list-group ']) !!}
        </div>
      @endif
      
      <div class="col-12 col-sm-5 col-md-4">
        <span class="text-capitalize">{{ _e('newsletter','ramsco') }}</span>
        <p>{{ _e('subscribe to greenolic newsletter to know our products updates, special offers and news','ramsco') }}</p>
      </div>

      <div class="col-12 col-sm-4">
        <span class="text-capitalize">{{ _e('contact us','ramsco') }}</span>
        <p>{{ the_field('website_address','option') }}</p>
        <p>{{ the_field('website_email','option') }}</p>
        <p>{{ the_field('website_phone','option') }}</p>
      </div>

    </div>
  </div>
  <section class="copyright">
    <div class="container">
      <div class="row justify-content-between align-items-center">

        <p class="copy-right">{{ get_field('copyright','option') }}</p>

        @if($site_social)
          <div class="site-social text-center ml-auto mr-3 mb-3 pl-2">
            <span>{{ _e('our social media','ramsco') }}</span>
            @foreach ($site_social as $social)
            <a class="" href="{{ $social['icon_link'] }}" title="{{ _e('Social Media', 'ramsco') }}" target="_blank">
              @if($social['icon_name'] == 'Facebook')
              <i class="fa fa-facebook fa-fw"></i>
              @elseif($social['icon_name'] == 'Twitter')
              <i class="fa fa-twitter fa-fw"></i>
              @elseif($social['icon_name'] == 'Youtube')
              <i class="fa fa-youtube fa-fw"></i>
              @elseif($social['icon_name'] == 'Instgram')
              <i class="fa fa-instagram fa-fw"></i>
              @endif
            </a>
            @endforeach
          </div>
        @endif <!-- End Social Media -->

      </div>
    </div>
  </section>
</footer>