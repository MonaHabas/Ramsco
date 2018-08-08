{{--
  Template Name: About Us
--}}

@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())

    <section class="page-content">
      <div class="row">

        <div class="col-12">
          <div class="content">
            @php(the_content())
          </div>
        </div>{{-- End Content Col --}}

      </div>{{-- End Row --}}
    </section>{{-- End Page Content --}}
  @endwhile
@endsection
