<div class="table-responsive">
  <table class="table" id="courses-table">
    <thead>
      <tr>
        <th>Course Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Published</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($courses as $course)
        <tr>
          <td>{{ $course->course_name }}</td>
          <td>{{ $course->description }}</td>
          <td>{{ $course->image }}</td>
          <td>{{ $course->published }}</td>
          <td class=" text-center">
            {!! Form::open(['route' => ['admin.courses.destroy', $course->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
              <a href="{!! route('admin.courses.show', [$course->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
              <a href="{!! route('admin.courses.edit', [$course->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
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
