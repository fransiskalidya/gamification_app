<div class="table-responsive">
    <table class="table" id="badgeSettings-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
        <th>Min</th>
        <th>Max</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($badgeSettings as $badgeSetting)
            <tr>
                       <td>{{ $badgeSetting->name }}</td>
                       <td><img src="/image_upload/{{ $badgeSetting->file }}" width="100px"></td>
            <td>{{ $badgeSetting->min }}</td>
            <td>{{ $badgeSetting->max }}</td>
                       <td class=" text-center">
                           {!! Form::open(['route' => ['admin.badgeSettings.destroy', $badgeSetting->id], 'method' => 'delete']) !!}
                           <div class='btn-group'>
                               <a href="{!! route('admin.badgeSettings.show', [$badgeSetting->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
                               <a href="{!! route('admin.badgeSettings.edit', [$badgeSetting->id]) !!}" class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
                               {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}
                           </div>
                           {!! Form::close() !!}
                       </td>
                   </tr>
        @endforeach
        </tbody>
    </table>
</div>
