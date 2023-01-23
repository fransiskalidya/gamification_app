@extends('layouts.app')
@section('title')
  Lessons
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Lessons</h1>
      <div class="section-header-breadcrumb">
        <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary form-btn">Lesson <i
            class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          @include('admin.lessons.table')
        </div>
      </div>
    </div>

    @include('stisla-templates::common.paginate', ['records' => $lessons])

  </section>
@endsection
