<header>
  <div class="container">
    <nav class="navbar navbar-light justify-content-between align-items-center row pl-md-0 pr-md-0">
      <a class="navbar-brand" href="{{ home_url('/') }}">
        @if(get_field('website_logo','option'))
          <img src="{{ get_field('website_logo','option') }}" alt="Website logo">
        @else
          <img src="{{ get_template_directory_uri().'/assets/images/logo.png' }}" alt="Website logo">
        @endif
      </a>
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
      @if($site_social)
        <div class="site-social text-center ml-auto mr-3 mb-3 pl-2">
          @foreach ($site_social as $social)
          <a class="" href="{{ $social['icon_link'] }}" title="{{ _e('Social Media', 'ramsco') }}" target="_blank">
            @if($social['icon_name'] == 'Facebook') <i class="fa fa-facebook fa-fw"></i>
            @elseif($social['icon_name'] == 'Twitter') <i class="fa fa-twitter fa-fw"></i>
            @elseif($social['icon_name'] == 'Youtube') <i class="fa fa-youtube fa-fw"></i>
            @elseif($social['icon_name'] == 'Instgram') <i class="fa fa-instagram fa-fw"></i>
            @endif
          </a>
          @endforeach
        </div>
      @endif
    </nav>
  </div>
</header>
