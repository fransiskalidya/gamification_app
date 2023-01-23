<nav class="navbar navbar-secondary fixed-top navbar-expand-lg navbar-light" style="background: #ffffff; left:0">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        @if (!$is_finish)
          <button id="run-btn" onclick="runCode()" class="btn-primary btn"><i class="fa fa-play"></i> Run </button>
        @else
          <span class="badge badge-primary badge-lg">
            <b>Score: {{ $score }}</b>
          </span>
        @endif
      </li>
    </ul>
    <div class="d-flex">
      <ul class="navbar-nav">
        @if (!$is_finish)
          <li>
            <div id="timer" style="font-size: 20px;font-weight:bold"></div>
          </li>
        @endif
        <li class="nav-item">
          @if ($is_finish)
            <span class="badge badge-success">
              Duration : {{ $duration }}
            </span>
          @else
            <form action="{{ route('code_test.submit', [$question->id]) }}" method="post">
              @csrf
              <input type="hidden" value="{{ \Illuminate\Support\Facades\Auth::id() }}" name="user_id" id="user_id">
              <input type="hidden" value="{{ $question->id }}" name="question_id" id="question_id">
              <input type="hidden" value="{{ request()->get('content_id') }}" name="content_id" id="content_id">
              <input type="hidden" value="{{ request()->get('course_id') }}" name="course_id" id="course_id">
              <input type="hidden" value="0" name="score" id="score" id=score>
              <button type="button" class="btn-success btn" style="margin-left: 20px" data-target="#confirmModal"
                data-toggle="modal" data-target="#confirmModal"><i class="fa fa-save"></i> Submit
              </button>
            </form>
          @endif
        </li>
        @auth
          <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
              <i class="far fa-user-circle"></i>
              <span>{{ \Illuminate\Support\Facades\Auth::user()->email }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="nav-item">
                <a class="nav-link" href="">Total Score: <b>{{ \App\Models\UserScore::getScore() }}</b></a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              @if (\Illuminate\Support\Facades\Auth::user()->role_id == 1)
                <li class="nav-item">
                  <a href="{{ route('admin.dashboard') }}" class="nav-link">Goto Admin</a>
                </li>
              @endif
              <br />
              <li class="nav-item">
                <div class="nav-link">
                  {!! Form::open(['route' => 'logout', 'method' => 'POST']) !!}
                  @csrf
                  <button class="btn btn-danger btn-block">Logout <i class="fa fa-unlock"></i> </button>
                  {!! Form::close() !!}
                </div>

              </li>
            </ul>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
