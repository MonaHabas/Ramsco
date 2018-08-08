<section class="page-content">
  <div class="row">
    <div class="breadcrumb mb-0 col-12">
      <a href="{{ home_url() }}">{{_e('Home > ','rms')}}</a>
      <span> @php(the_title())</span>
    </div>

    <div class="col-md-8 col-12">
      <div class="content">@php(the_content())</div>
    </div>{{-- End Content Col --}}

    <div class="col-md-4 col-12">
      @php (dynamic_sidebar( 'sidebar-pages' ))
    </div>{{-- End Twitter Col --}}
  </div>{{-- End Row --}}
</section>{{-- End Page Content --}}