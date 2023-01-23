@extends('layouts.front')
@section('content')
  <div>
    <h3>My report</h3>
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            Your badge
            <h3>{{ $current_badge->name }} <img src="/image_upload/{{ $current_badge['file'] }}" width="50px"></h3>

          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            Your Score
            <h3>{{ $total_score }}</h3>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            Your progress
            <h3>{{ $percentage }} %</h3>
            <div class="progress mt-2">
              <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            Finished test
            <h3>{{ sizeof($finish_code_tests) }} Test</h3>
          </div>
        </div>
      </div>
    </div><br />

    <h3>Code Test Report</h3>
    @foreach ($code_score as $sc)
      <div class="row mb-1">
        <div class="col-md-12">
          @php
            $q = \App\Models\Question::find($sc->question_id);
          @endphp

          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <h6>{{ $q->question_name }}</h6>
                  Question Name
                </div>

                <div class="col-md-5">
                  @php
                    $f = \Carbon\Carbon::parse($sc->started_at);
                    $t = \Carbon\Carbon::parse($sc->ended_at);
                    $h = $t->diff($f)->format('%Hh %Im %Ss');
                  @endphp

                  <span class="badge badge-info">
                    On Timer {{ $sc->on_timer }}
                  </span>
                  <span class="badge badge-success">
                    Duration: {{ $h }}
                  </span>
                  <br />
                  <div class="mt-1">
                    {{ $sc->started_at }} <i class="fa fa-arrow-right mx-2 text-primary"></i>
                    {{ $sc->ended_at }}
                  </div>
                </div>

                <div class="col-md-2">
                  @php
                    $err = \App\Models\ErrorCodeLog::where(['user_id' => Auth::id(), 'question_id' => $sc->question_id]);
                  @endphp
                  <span class="badge badge-danger mt-2">
                    {{ $err->count() }} Errors
                  </span><br />
                </div>

                <div class="col-md-2">
                  <span class="badge badge-success mt-2">
                    Question Score: {{ $sc->score }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach


  </div>
@endsection
