<div class="table-responsive">
  <table class="table" id="roles-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>email</th>
        <th>Role</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->role }}</td>
            <td class=" text-center">
              {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
              <div class='btn-group'>
                <a href="{!! route('admin.users.show', [$user->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
                <a href="{!! route('admin.users.edit', [$user->id]) !!}" class='btn btn-warning action-btn edit-btn'><i
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
