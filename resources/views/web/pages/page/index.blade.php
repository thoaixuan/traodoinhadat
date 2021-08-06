@extends('web.layouts.page')
@section('page')
<section class="content">
    <div class="service">
      <div class="sv-content">
        <div class="container">
          <div class="sv-info">
            <h2 class="sv-info__title">{{ $data->post_title }}</h2>
            <div class="sv-info__content">
                {!! $data->post_content !!}
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<br>
@include('web.includes.service_subfooter')
@endsection

