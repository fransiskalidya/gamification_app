@extends('layouts.front')

@section('content')
    <style>

        .ql-container.ql-snow {
            border: none;
        }
        .ql-editor {
            box-sizing: border-box;
            line-height: 1.42;
            height: 100%;
            outline: none;
            overflow-y: auto;
            padding: 0px;
            tab-size: 4;
            -moz-tab-size: 4;
            text-align: left;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .ql-snow .ql-editor pre.ql-syntax {
            background-color: #f3f3f3;
            color: #1f1f1f;
            overflow: visible;
        }
    </style>
    <section class="section mt-5" id="interactive">
        <div class="row">
            <div class="col-md-8">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ $course->course_name }}</h1>
                            <div class="mt-1">
                                <span class="badge text-bg-primary badge-primary rounded-pill">{{ $course->lessons->count() }} Lessons</span>
                                <span class="badge text-bg-primary badge-secondary rounded-pill">{{ $course->student_courses->count() }} Students</span>
                            </div>
                            <p class="mt-3">{{ $course->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-1">
                  <div class="card">
                    <div class="card-body">
                      <h3>Achievement Badge</h3>
                      <div class="table-responsive">
                        <table class="table table-striped" id="sortable-table">
                          <thead>
                            <tr>
                              <th>Badge Name</th>
                              <th>Badge Point Min</th>
                              <th>Badge Point Max</th>
                            </tr>
                          </thead>
                        </tbody>
                  @foreach($current_badge as $badgeSetting)
                      <tr>
                        <td>{{ $badgeSetting->name }} <img src="/image_upload/{{ $badgeSetting->file }}" width="50px"></td>
                      <td>{{ $badgeSetting->min }}</td>
                      <td>{{ $badgeSetting->max }}</td>
                      @endforeach
                    </tr>
                  </tbody>
                  </div>
                </table>
                <i>Note: Achievement Badge di peroleh dari point yang diperoleh</i>
              </div>
            </div>
          </div>
        </div>

                <div class="mt-1">
                    <div class="card">
                        <div class="card-body">
                            <h3>Leader Board</h3>
                            <div class="table-responsive">
                              <table class="table table-striped" id="sortable-table">
                                <thead>
                                  <tr>
                                    <th>
                                      Rank
                                    </th>
                                    <th>Name</th>
                                    <th>Point</th>
                                    <th>Progress</th>
                                    <th>Badge</th>
                                  </tr>
                                </thead>
                              </tbody>

                                  <?php $no = 1; ?>
                                  @foreach($leader_board as $leader)
                                  <tr>
                                  <td> <?= $no ?> </td>
                                  <td> {{ ucfirst($leader['user']) }} </td>
                                  <td> {{ $leader['total_score'] }}
                                    <img class="" src="{{ asset('img/pngwing.com.png') }}" width="23px" alt=""/>
                                   </td>
                                  <td>
                                    <div class="progress mt-2">
                                      <div class="progress-bar" role="progressbar" style="width: {{ $leader['percentage'] }}%;"
                                        aria-valuenow="{{ $leader['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $leader['percentage'] }}%</div>
                                    </div>
                                  </td>
                                  <td>
                                    {{  $leader['badge_name']  }}
                                    <img src="/image_upload/{{ $leader['file'] }}" width="50px">
                                  </td>
                                  <?php $no += 1; ?>
                                  @endforeach
                                </tr>
                              </tbody>
                              </div>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Lesson Content
                        </h5>
                        <div class="accordion" id="accordionExample">
                            @foreach($course->lessons as $index=>$lesson)
                                <div class="accordion-item">
                                    <div  class="accordion-header" data-toggle="collapse"
                                          data-target="#item{{$index}}"
                                          aria-expanded="{{ $index==0 ? "true" : "false" }}" aria-controls="collapseOne">
                                        {{ $lesson->title }}
                                    </div>
                                    <div id="item{{$index}}"
                                         class="accordion-collapse collapse {{ $index == 0 ? "show": "" }}"
                                         aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="list-group row list-group-flush">
                                                @foreach($lesson->contents as $content)
                                                    <li
                                                       class="list-group-item list-group-item-action}}"
                                                    >
                                                        {{ $content->title }}</li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("scripts")
    <script type="text/javascript">
        hljs.configure({   // optionally configure hljs
            languages: ['javascript', 'ruby', 'python', 'java']
        });

        var quill = new Quill('#res', {
            modules: {
                syntax: true,
                toolbar: false
            },
            theme: 'snow',
            onChange:(value) => {
                console.log(value)
            },
            readOnly:true
        });

    </script>
@endsection
