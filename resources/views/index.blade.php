@extends('layouts.app')

@section('content')

  @include('partials/home/slider')
  <section>
    <div class="row m-0">
      @php(dynamic_sidebar('sidebar-primary'))
    </div>
  </section>
@endsection
