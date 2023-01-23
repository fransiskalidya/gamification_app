<div class="table-responsive">
  <table class="table" id="questions-table">
    <thead>
      <tr>
        <th>Content Id</th>
        <th>Question</th>
        <th>Question Name</th>
        <th>Score</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($questions as $question)
        <tr>
          <td>{{ $question->content->title }}</td>
          <td>{{ $question->question_name }}</td>
          <td>{{!! $question->question !!}}</td>
          <td>{{ $question->score }}</td>
          <td class=" text-center">
            {!! Form::open(['route' => ['admin.questions.destroy', $question->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
              <a href="{!! route('admin.questions.show', [$question->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
              <a href="{!! route('admin.questions.edit', [$question->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
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
