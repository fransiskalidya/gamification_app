@extends('layouts.app')
@section('title')
  Level
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Level</h1>
      <div class="section-header-breadcrumb">
        <a href="{{ route('admin.level.create') }}" class="btn btn-primary form-btn">Level <i
            class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          @include('admin.level.table')
        </div>
      </div>
    </div>
  </section>
@endsection
