@extends('layouts.front')

@section('content')
<div class="section-body pb-2">
    <h2 class="section-title">Start Your Lesson now</h2>
    <p class="section-lead">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua. Ut enim ad minim veniam.<br />

    </p>
    <!-- Your content goes here -->
</div>
<div class="row">
    @foreach($level as $level)
        <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <div class="text-center">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.413-.588T4 20V10q0-.825.588-1.413T6 8h9V6q0-1.25-.875-2.125T12 3q-1.025 0-1.813.613T9.126 5.15q-.125.375-.388.613T8.126 6q-.5 0-.8-.338t-.2-.762Q7.5 3.225 8.85 2.112T12 1q2.075 0 3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.588 1.413T18 22H6Zm6-5q.825 0 1.413-.588T14 15q0-.825-.588-1.413T12 13q-.825 0-1.413.588T10 15q0 .825.588 1.413T12 17Z"/></svg>
                        </span>
                    </div>
                    <h5 class="card-title pt-3">{{$level->name}}</h5>
                    <p class="card-text">{{$level->description}}</p>
                    <a href="{{ route('student_course.my_course.detail', [$course_id, $level->id]) }}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Start Lesson</a>
                </div>
            </div>
        </div>
    @endforeach
    {{--<div class="col-md-4">
        <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <div class="text-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.413-.588T4 20V10q0-.825.588-1.413T6 8h1V6q0-2.075 1.463-3.538T12 1q2.075 0 3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.588 1.413T18 22H6Zm6-5q.825 0 1.413-.588T14 15q0-.825-.588-1.413T12 13q-.825 0-1.413.588T10 15q0 .825.588 1.413T12 17ZM9 8h6V6q0-1.25-.875-2.125T12 3q-1.25 0-2.125.875T9 6v2Z"/></svg>
                    </span>
                </div>
                <h5 class="card-title pt-3">Medium</h5>
                <p class="card-text">Step forward to medium level</p>
                <button type="button" class="btn btn-lg btn-primary" disabled>Start Lesson</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <div class="text-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.413-.588T4 20V10q0-.825.588-1.413T6 8h1V6q0-2.075 1.463-3.538T12 1q2.075 0 3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.588 1.413T18 22H6Zm6-5q.825 0 1.413-.588T14 15q0-.825-.588-1.413T12 13q-.825 0-1.413.588T10 15q0 .825.588 1.413T12 17ZM9 8h6V6q0-1.25-.875-2.125T12 3q-1.25 0-2.125.875T9 6v2Z"/></svg>
                    </span>
                </div>
                <h5 class="card-title pt-3">Hard</h5>
                <p class="card-text"></p>
                <button type="button" class="btn btn-lg btn-primary" disabled>Start Lesson</button>
            </div>
        </div>
    </div>--}}
</div>

@endsection