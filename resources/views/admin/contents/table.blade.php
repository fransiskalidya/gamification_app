<div class="table-responsive">
  <table class="table" id="contents-table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Lesson</th>
        <th>Url Video</th>
        <th>Published</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contents as $content)
        <tr>
          <td>{{ $content->title }}</td>
          <td>{{ $content->lesson->title }}</td>
          <td>{{ $content->url_video }}</td>
          <td>{{ $content->published }}</td>
          <td class=" text-center">
            {!! Form::open(['route' => ['admin.contents.destroy', $content->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
              <a href="{!! route('admin.contents.show', [$content->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
              <a href="{!! route('admin.contents.edit', [$content->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
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
