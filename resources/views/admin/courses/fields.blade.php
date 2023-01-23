<!-- Course Name Field -->
<div class="form-group col-sm-6">
  {!! Form::label('course_name', 'Course Name:') !!}
  {!! Form::text('course_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
  {!! Form::label('image', 'Image:') !!}
  {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Published Field -->
<div class="form-group col-sm-6">
  {!! Form::label('published', 'Published:') !!}
  {!! Form::text('published', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('admin.courses.index') }}" class="btn btn-light">Cancel</a>
</div>
