<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $badgeSetting->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $badgeSetting->name }}</p>
</div>

<!-- Min Field -->
<div class="form-group">
    {!! Form::label('min', 'Min:') !!}
    <p>{{ $badgeSetting->min }}</p>
</div>

<!-- Max Field -->
<div class="form-group">
    {!! Form::label('max', 'Max:') !!}
    <p>{{ $badgeSetting->max }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $badgeSetting->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $badgeSetting->updated_at }}</p>
</div>

