<style>
  .ql-snow .ql-editor pre.ql-syntax {
    background-color: #f3f3f3;
    color: #1f1f1f;
    overflow: visible;
  }
</style>

<!-- Content Id Field -->
<div class="form-group col-sm-12">
  {!! Form::label('content_id', 'Content Id:') !!}
  {!! Form::select('content_id', $contents, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('question_name', 'Question Name:') !!}
  {!! Form::text('question_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Question Field -->
<div class="form-group col-sm-12">
  {!! Form::label('question', 'Question:') !!}
  {!! Form::hidden('question', null, ['class' => 'form-control', 'id' => 'res']) !!}

  <div>
    <div id="toolbar">
      <!-- Add font size dropdown -->
      <select class="ql-size">
        <option value="small"></option>
        <!-- Note a missing, thus falsy value, is used to reset to default -->
        <option selected></option>
        <option value="large"></option>
        <option value="huge"></option>
      </select>
      <!-- Add a bold button -->
      <button class="ql-bold"></button>
      <button class="ql-italic"></button>
      <button class="ql-list" value="ordered"></button>
      <button class="ql-list" value="bullet"></button>

      <!-- Add subscript and superscript buttons -->
      <button class="ql-script" value="sub"></button>
      <button class="ql-script" value="super"></button>
      <button class="ql-image"></button>
      <button class="ql-code-block"></button>

    </div>
    <div id="editor">
      {!! @$question->question !!}
    </div>
  </div>

</div>

<!-- Image Field -->
<div class="form-group col-sm-3">
  {!! Form::label('image', 'Image:') !!}
  {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Score Field -->
<div class="form-group col-sm-3">
  {!! Form::label('score', 'Score:') !!}
  {!! Form::number('score', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-3">
  {!! Form::label('is_essay', 'Code:') !!}
  {!! Form::checkbox('is_essay', '1') !!}
</div>

<div class="form-group col-sm-3">
  {!! Form::label('timer', 'Timer: (minutes)') !!}
  {!! Form::number('timer', null, ['class' => 'form-control']) !!}
</div>

<div class="form-divider" />

<div class="col-sm-12" id="answer_list">
  <div class="card-title">Answers</div>
  <div class="row">
    @for ($i = 0; $i < 4; $i++)
      <div class="col-sm-10">
        <textarea class="form-control" rows="3" name="answers_{{ $i }}"
          placeholder="Answer {{ $i + 1 }}">{{ @$answers[$i]->answer }}</textarea>
      </div>
      <div class="col-md-2">
        <input type="hidden" name="answer_id_{{ $i }}" value="{{ @$answers[$i]->id }}">
        <input type="checkbox" value="true" name="is_right_{{ $i }}"
          {{ @$answers[$i]->is_right == 'true' ? 'checked' : '' }}> is right?
      </div>
      <div class="form-divider"></div>
    @endfor
  </div>

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('admin.questions.index') }}" class="btn btn-light">Cancel</a>
</div>

@section('scripts')
  <script>
    if ($("#is_essay").is(":checked")) {
      $("#answer_list").hide();
    }

    $("#is_essay").change(function() {
      let is_checked = $("#is_essay").is(":checked");
      if (is_checked) {
        $("#answer_list").hide();
      } else {
        $("#answer_list").show();
      }
    })

    hljs.configure({ // optionally configure hljs
      languages: ['javascript', 'ruby', 'python', 'java']
    });

    var quill = new Quill('#editor', {
      modules: {
        syntax: true,
        toolbar: "#toolbar"
      },
      theme: 'snow',
      onChange: (value) => {
        console.log(value)
      }
    });

    quill.on('editor-change', function() {
      document.getElementById("res").value = quill.root.innerHTML;
    });
  </script>
@endsection
