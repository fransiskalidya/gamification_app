<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $content->id }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $content->title }}</p>
</div>

<!-- Lesson Id Field -->
<div class="form-group">
    {!! Form::label('lesson_id', 'Lesson Id:') !!}
    <p>{{ $content->lesson->title }}</p>
</div>

<!-- Url Video Field -->
<div class="form-group">
    {!! Form::label('url_video', 'Url Video:') !!}
    <p>{{ $content->url_video }}</p>
</div>

<!-- Published Field -->
<div class="form-group">
    {!! Form::label('published', 'Published:') !!}
    <p>{{ $content->published }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $content->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $content->updated_at }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $content->description !!} </p>
</div>

