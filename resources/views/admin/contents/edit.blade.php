@extends('layouts.app')
@section('title')
  Edit Content
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h3 class="page__heading m-0">Edit Content</h3>
      <div class="filter-container section-header-breadcrumb row justify-content-md-end">
        <a href="{{ route('admin.contents.index') }}" class="btn btn-primary">Back</a>
      </div>
    </div>
    <div class="content">
      @include('stisla-templates::common.errors')
      <div class="section-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body ">
                {!! Form::model($content, ['route' => ['admin.contents.update', $content->id], 'method' => 'patch']) !!}
                <div class="row">
                  @include('admin.contents.fields')
                </div>

                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
