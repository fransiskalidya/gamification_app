@extends('layouts.app')
@section('title')
  Roles
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Roles</h1>
      <div class="section-header-breadcrumb">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary form-btn">Role <i
            class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          @include('admin.roles.table')
        </div>
      </div>
    </div>

    @include('stisla-templates::common.paginate', ['records' => $roles])

  </section>
@endsection
