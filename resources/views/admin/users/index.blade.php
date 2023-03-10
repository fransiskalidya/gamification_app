@extends('layouts.app')
@section('title')
  Users
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Users</h1>
      <div class="section-header-breadcrumb">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary form-btn">User <i
            class="fas fa-plus"></i></a>
      </div>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get("message") }}</div>
    @endif
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          @include('admin.users.table')
        </div>
      </div>
    </div>



  </section>
@endsection
