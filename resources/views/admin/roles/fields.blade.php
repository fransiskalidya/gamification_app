<!-- Role Field -->
<div class="form-group col-sm-6">
  {!! Form::label('role', 'Role:') !!}
  {!! Form::text('role', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('admin.roles.index') }}" class="btn btn-light">Cancel</a>
</div>
