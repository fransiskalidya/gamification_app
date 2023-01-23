@extends('layouts.app')
@section('title')
    Badge Settings
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Badge Settings</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.badgeSettings.create')}}" class="btn btn-primary form-btn">Badge Setting <i class="fas fa-plus"></i></a>
            </div>
        </div>
    <div class="section-body">
       <div class="card">
            <div class="card-body">
                @include('admin.badge_settings.table')
            </div>
       </div>
   </div>

        @include('stisla-templates::common.paginate', ['records' => $badgeSettings])

    </section>
@endsection

