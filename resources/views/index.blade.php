@extends('layouts.app')

@section('content')

  @include('partials/home/slider')
  @include('partials/home/latest-product')

  <section>
    <div class="row m-0">
      @php(dynamic_sidebar('sidebar-primary'))
    </div>
  </section>
@endsection
