@extends('layouts.app')
@section('title')
  Contents
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Contents</h1>
      <div class="section-header-breadcrumb">
        <a href="{{ route('admin.contents.create') }}" class="btn btn-primary form-btn">Content <i
            class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          @include('admin.contents.table')
        </div>
      </div>
    </div>

    @include('stisla-templates::common.paginate', ['records' => $contents])

  </section>
@endsection
