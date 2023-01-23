<div class="table-responsive">
  <table class="table" id="lessons-table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Course Id</th>
        <th>Posisition</th>
        <th>Published</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($lessons as $lesson)
        <tr>
          <td>{{ $lesson->title }}</td>
          <td>{{ $lesson->description }}</td>
          <td>{{ $lesson->course->course_name }}</td>
          <td>{{ $lesson->posisition }}</td>
          <td>{{ $lesson->published }}</td>
          <td class=" text-center">
            {!! Form::open(['route' => ['admin.lessons.destroy', $lesson->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
              <a href="{!! route('admin.lessons.show', [$lesson->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
              <a href="{!! route('admin.lessons.edit', [$lesson->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
                  class="fa fa-edit"></i></a>
              {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}
            </div>
            {!! Form::close() !!}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
