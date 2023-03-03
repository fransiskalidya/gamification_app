<!-- Title Field -->
<div class="form-group col-sm-6">
  {!! Form::label('title', 'Title:') !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Course Id Field -->
<div class="form-group col-sm-6">
  {!! Form::label('course_id', 'Course:') !!}
  {!! Form::select('course_id', $courses, null, ['class' => 'form-control']) !!}
</div>
<!-- level Id Field -->
<div class="form-group col-sm-6">
  {!! Form::label('level_id', 'Level:') !!}
  {!! Form::select('level_id', $level, null, ['class' => 'form-control']) !!}
</div>

<!-- Posisition Field -->
<div class="form-group col-sm-6">
  {!! Form::label('posisition', 'Posisition:') !!}
  {!! Form::number('posisition', null, ['class' => 'form-control']) !!}
</div>

<!-- Published Field -->
<div class="form-group col-sm-6">
  {!! Form::label('published', 'Published:') !!}
  {!! Form::number('published', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('admin.lessons.index') }}" class="btn btn-light">Cancel</a>
</div>
