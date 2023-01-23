<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">

          {!! Form::label('name', 'Name:') !!}
            <div class="fallback">
              <input name="file" type="file" class="form-control" />
            </div>
          </form>

  </div>
<!-- Min Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min', 'Min:') !!}
    {!! Form::number('min', null, ['class' => 'form-control']) !!}
</div>

<!-- Max Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max', 'Max:') !!}
    {!! Form::number('max', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.badgeSettings.index') }}" class="btn btn-light">Cancel</a>
</div>
