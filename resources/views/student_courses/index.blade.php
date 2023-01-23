@extends('layouts.front')

@section('content')
    <section class="section">
        <div class="section-body">
            <h2 class="section-title">Take Your Lesson now</h2>
            <p class="section-lead">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam.<br />

            </p>
            <!-- Your content goes here -->
        </div>
        <div class="row mt-5">
            @foreach($studentCourses as $course)
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
                                <span class="badge text-bg-primary badge-primary rounded-pill">{{ $course->lessons->count() }} Lessons</span>
                                <span class="badge text-bg-primary badge-secondary rounded-pill">{{ $course->student_courses->count() }} Students</span>
                            </div>

                        </div>

                        <!-- card footer -->
                        <div class="card-footer">
                            <a href="{{ route("student_course.my_course.detail", $course->id) }}" class="btn btn-primary btn-block"><i class="fa fa-play"></i> Start Lesson</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
@endsection
