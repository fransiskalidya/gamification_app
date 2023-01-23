@extends('layouts.app')
@section('title')
  Questions
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Questions</h1>
      <div class="section-header-breadcrumb">
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary form-btn">Question <i
            class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          @include('admin.questions.table')
        </div>
      </div>
    </div>

    @include('stisla-templates::common.paginate', ['records' => $questions])

  </section>
@endsection
