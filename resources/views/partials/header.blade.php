<header>
  <div class="container">
    <nav class="navbar navbar-light justify-content-between align-items-center row pl-md-0 pr-md-0">
    
      <a class="navbar-brand" href="{{ home_url('/') }}">
        <img src="{{ get_template_directory_uri().'/assets/images/logo.png' }}" alt="logo">
      </a>

      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif

      {{-- @if($site_social)
        <div class="site-social text-center ml-auto mr-3 mb-3 pl-2">
          @foreach ($site_social as $social)
          <a class="text-white" href="{{ $social['icon_name'] }}" title="{{ _e('Social Media', 'ramsco') }}" target="_blank">
            {!! $social['icon_image'] !!}
          </a>
          @endforeach
        </div>
      @endif --}}

    </nav>
  </div>
</header>
