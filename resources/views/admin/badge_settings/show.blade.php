@extends('layouts.app')
@section('title')
    Badge Setting Details
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Badge Setting Details</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('admin.badgeSettings.index') }}"
                 class="btn btn-primary form-btn float-right">Back</a>
        </div>
      </div>
   @include('stisla-templates::common.errors')
    <div class="section-body">
           <div class="card">
            <div class="card-body">
                    @include('admin.badge_settings.show_fields')
            </div>
            </div>
    </div>
    </section>
@endsection
