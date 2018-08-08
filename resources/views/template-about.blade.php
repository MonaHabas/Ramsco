{{--
  Template Name: About Us
--}}

@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())

    <section class="page-content">

      <div class="text-center">
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

    </section>{{-- End Page Content --}}
  @endwhile
@endsection
