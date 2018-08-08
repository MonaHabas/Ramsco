<section class="page-content">
  <div class="row">
    <div class="breadcrumb mb-0 col-12">
      <a href="{{ home_url() }}">{{_e('Home > ','rms')}}</a>
      <span> @php(the_title())</span>
    </div>

    <div class="col-12">
      <div class="content">@php(the_content())</div>
    </div>{{-- End Content Col --}}

  </div>{{-- End Row --}}
</section>{{-- End Page Content --}}