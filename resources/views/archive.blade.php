@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.archive.content-archive-'.get_post_type())
  @endwhile
@endsection
