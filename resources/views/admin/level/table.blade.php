<div class="table-responsive">
  <table class="table" id="courses-table">
    <thead>
      <tr>
        <th>Level Name</th>
        <th>Course</th>
        <th>Description</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($level as $level)
        <tr>
          <td>{{ $level->name }}</td>
          <td>{{ $level->course->course_name }}</td>
          <td>{{ $level->description }}</td>
          <td class=" text-center">
            {!! Form::open(['route' => ['admin.level.destroy', $level->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
              <a href="{!! route('admin.level.edit', [$level->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
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
