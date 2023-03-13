@extends('layouts.report')

@section('content')
  <style>
    .codeflask__flatten {
      position: initial !important;

    }

    .codeflask__textarea {
      color: #0c0c0c;
    }

    #output {
      color: white;
      background: #444444;
      padding: 10px;
    }
  </style>
  <div style="margin-top: 70px">
    <div class="row">
    <div class="col-md-7 p-5">
          <h3>Exercise Logs ({{ $exercise_logs->count() }})</h3>
          <div>
            @foreach ($exercise_logs as $i => $exer)
              <div class="card card-sm">
                <div class="card-body">
                  @if($exer->is_error == 1)
                    <span class="badge badge-danger mb-2"> Error</span><br />
                  @else
                    <span class="badge badge-success mb-2"> Success</span><br />
                  @endif
                    <pre>{{ $exer->message }}</pre>
                </div>
              </div>
            @endforeach
          </div>
        </div>

      <div class="col-md-5 p-5">
        <div>
          <h3 class="card-title">Exercise</h3>
          {!! $question->question !!}
        </div><br />
        
      </div>
    </div>
  </div>

@endsection


@section('scripts')
  <script src="{{ asset('js/codeflask.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
@endsection
