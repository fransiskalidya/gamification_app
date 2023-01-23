@extends('layouts.app')
@section('title')
  Courses
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Courses</h1>
      <div class="section-header-breadcrumb">
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary form-btn">Course <i
            class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          @include('admin.courses.table')
        </div>
      </div>
    </div>

    @include('stisla-templates::common.paginate', ['records' => $courses])

  </section>
@endsection
