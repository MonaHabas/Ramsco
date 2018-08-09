{{--
  Template Name: About Us
--}}

@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())

    <section class="page-content">
      <div class="container">
        <div class="row">

          <div class="custom-border col-12">
            @php($border_img = get_template_directory_uri().'/assets/images/border.png')
            <img src="{{ $border_img }}" />
          </div><!-- End Border -->

          <div class="col-12 text-center">
            @php( $mission_desc = get_field('mission_descreption'))
            @if( $mission_desc )
              <h2>{{ _e('Mission','ramsco') }}</h2>
              <p>{{ $mission_desc }}</p>
            @endif

            @php($vission_desc = get_field('vision_descreption'))
            @if( $mission_desc )
              <h2>{{ _e('Vission','ramsco') }}</h2>
              <p>{{ $vission_desc }}</p>
            @endif
          </div>{{-- End Content Col --}}

        </div>
      </div>
    </section>{{-- End Page Content --}}

  @endwhile
@endsection
