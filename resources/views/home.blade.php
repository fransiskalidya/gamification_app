@extends('layouts.front')

@section('content')
  @if (Session::has('msg_error'))
    <div class="alert alert-warning">{{ Session::get('msg_error') }}</div>
  @endif

  @if (Session::has('msg_error1'))
    <div class="alert alert-success">{{ Session::get('msg_error1') }}</div>
  @endif

  <section class="section">
    <div class="section-body">
      <h2 class="section-title">Take Your Lesson now</h2>
      <p class="section-lead">
        Take one of the content materials that have been displayed in the system by pressing the take button.
      </p>
      <!-- Your content goes here -->
    </div>
    <div class="row mt-5">
      @foreach ($courses as $course)
        <div class="col-md-4">
          <div class="card">
            <!-- card header -->
            <div class="card-header">
              <!-- card title -->
              <h4>{{ $course->course_name }}</h4>
            </div>
            <!-- card body -->
            <div class="card-body">
              {{ substr($course->description, 0, 100) }}<br />
              <div class="mt-3">
                <span class="badge text-bg-primary badge-primary rounded-pill">{{ $course->lessons->count() }}
                  Lessons</span>
                <span class="badge text-bg-primary badge-secondary rounded-pill">{{ $course->student_courses->count() }}
                  Students</span>
              </div>

            </div>

            <!-- card footer -->
            <div class="card-footer">
              <div class="row">
                <div class="col-md-6">
                  <a href="{{ route('student_course.detail', [$course->id]) }}" class="btn btn-grey btn-block">See
                    Detail</a>
                </div>
                @if (!in_array($course->id, $take_ids))
                  <div class="col-md-6">
                    {!! Form::open(['route' => 'student_course.take', 'method' => 'POST']) !!}
                    @csrf
                    {!! Form::hidden('course_id', $course->id) !!}
                    <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Take</button>
                    {!! Form::close() !!}
                  </div>
                @endif

              </div>


            </div>
          </div>
        </div>
      @endforeach
    </div>

  </section>
@endsection
