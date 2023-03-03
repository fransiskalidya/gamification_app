@extends('layouts.code_test')

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
      @if (!$is_finish)
        <div class="col-md-7" style="min-height: 100vh">
          <div class="editor"></div>
        </div>
      @endif

      @if ($is_finish)
        <div class="col-md-7 p-5">
          <h3>Error Logs ({{ $error_logs->count() }})</h3>
          <div>
            @foreach ($error_logs as $i => $err)
              <div class="card card-sm">
                <div class="card-body">
                  <span class="badge badge-danger mb-2"> Error {{ $i + 1 }}</span><br />
                  <pre>{{ $err->error_message }}</pre>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <div class="col-md-5 p-5">
        <div>
          <h3 class="card-title">Exercise</h3>
          {!! $question->question !!}
        </div><br />
        @if (!$is_finish)
          <div>
            Run Output<br />
            <pre id="output"></pre>
          </div>
        @else
          <div>
            <span class="badge badge-info">
              Duration from {{ $user_score->started_at }} to
              {{ $user_score->ended_at }}
            </span>
            <span class="badge badge-info">
              On Timer {{ $user_score->on_timer }}
            </span>
          </div>
        @endif

      </div>
    </div>
  </div>

  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Submit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Anda yakin untuk submit?<br />
          <small>Pastikan anda sudah melakukan run code sebelum submit</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="submitCode()">Submit Pekerjaan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="confirmModal2" tabindex="-1" role="dialog" aria-labelledby="confirmModal2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Submit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Waktu anda sudah Habis<br />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="clearSession()">Ok</button>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
  <script src="{{ asset('js/codeflask.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script>
    const flask = new CodeFlask('.editor', {
      language: 'js',
      lineNumbers: true,
      handleTabs: true,
    });
    window['flask'] = flask;

    function runCode() {
      console.log("running");
      //let codes = ($('#'+id).text());
      let to_compile = {
        "code": $(".codeflask__textarea").val(),
        "user": '{{ \Illuminate\Support\Facades\Auth::user()->email }}',
      };
      $.ajax({
        // url: "https://fransiska.pythonanywhere.com/compiler/run",
        url: "http://127.0.0.1:8000/compiler/run",
        type: "POST",
        data: to_compile
      }).done(function(data) {
        $('#output').text(`${data.output.java}\n${data.output.test_output}`);
        $('#score').val(data.output.point || 0);

        if (data.output.point === 0 || data.output.point === undefined) {
          send_err_code(data.output)
        } else {
          submitCode();
        }
      }).fail(function(data, err) {
        alert("fail " + JSON.stringify(data) + " " + JSON.stringify(err));
      });
    }

    function send_err_code(err) {
      var user_id = $("#user_id").val();
      var question_id = $("#question_id").val();
      var err = err.java + "" + err.test_output;
      var data = {
        user_id: user_id,
        question_id: question_id,
        error_message: err
      }
      $.ajax({
        url: "/api/questions/error_code_log/create",
        type: "POST",
        data: data
      }).done(function(data) {
        console.log(data);
      }).fail(function(data, err) {
        console.log(data);
        console.log(err);
      });
    }

    var is_finish = "{{ $is_finish }}";

    var current_time = "";

    if (is_finish !== "1") {
      var target = moment().add('<?= $question->timer ?>', "minutes");
      var cs = localStorage.getItem("code_session");
      if (cs == null || cs == undefined || cs !== window.location.href) {
        localStorage.setItem("code_session", window.location.href);
        localStorage.setItem("time_end", target)
        localStorage.setItem("start_time", moment().format("YYYY-MM-DD HH:mm:ss"));
      } else {
        var te = localStorage.getItem("time_end")
        target = moment(te);

      }

      var x = setInterval(function() {
        diff = target.diff(moment());
        if (diff <= 0) {
          clearInterval(x);
          // If the count down is finished, write some text
          $('#timer').text("TIME OUT");
          submitCodeTO()
          $("#confirmModal2").modal();
        } else {
          current_time = moment.utc(diff).format("HH:mm:ss");
          $('#timer').text(current_time);
        }
      }, 1000);

    }

    function submitCode() {
      var user_id = $("#user_id").val();
      var question_id = $("#question_id").val();
      var content_id = $("#content_id").val();
      var course_id = $("#course_id").val();
      var score = $("#score").val();
      var _token = document.getElementsByName("_token")[0].value;
      var start_time = localStorage.getItem("start_time");
      var end_time = moment().format("YYYY-MM-DD HH:mm:ss");

      $.ajax({
        url: "{{ route('code_test.submit', [$question->id]) }}",
        method: "post",
        data: {
          user_id: user_id,
          question_id: question_id,
          content_id: content_id,
          course_id: course_id,
          score: score,
          started_at: start_time,
          ended_at: end_time,
          on_timer: current_time,
          _token: _token
        }
      }).done(res => {
        clearSession()
      }).fail(err => {
        clearSession()
      })
    }
    // localStorage.clear();

    function submitCodeTO() {
      var user_id = $("#user_id").val();
      var question_id = $("#question_id").val();
      var content_id = $("#content_id").val();
      var course_id = $("#course_id").val();
      var score = $("#score").val();
      var _token = document.getElementsByName("_token")[0].value;
      var start_time = localStorage.getItem("start_time");
      var end_time = moment().format("YYYY-MM-DD HH:mm:ss");

      $.ajax({
        url: "{{ route('code_test.submit', [$question->id]) }}",
        method: "post",
        data: {
          user_id: user_id,
          question_id: question_id,
          content_id: content_id,
          course_id: course_id,
          score: score,
          started_at: start_time,
          ended_at: end_time,
          on_timer: "00:00:00",
          _token: _token
        }
      });
    }

    function clearSession() {
      try {
        window.localStorage.removeItem("code_session");
        window.localStorage.removeItem("time_end");
      } finally {
        $("#confirmModal2").modal("hide");
        $("#confirmModal").modal("hide");
      }
    }

    $('#confirmModal2').on('hidden.bs.modal', function(e) {
      history.back();
    });

    $('#confirmModal').on('hidden.bs.modal', function(e) {
      history.back();
    });

    //console.log(session);
  </script>
@endsection
