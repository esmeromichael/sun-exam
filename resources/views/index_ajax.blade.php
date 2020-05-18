<div class="table-responsive">

    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Login Date</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($lists as $list)
                <tr>
                    <td><a href="#" data-toggle="modal"> {{$list->name}} </a></td>
                    <td>{{date('M-d-y H:i:s A', strtotime($list->updated_at))}}</td>
                    <td>
                        @if($list->status == "LoginIn")
                            Logged In
                        @else
                            Not Logged In
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#create-register" data-id="{{$list->id}}" data-name="{{$list->name}}" data-email="{{$list->email}}" data-image="{{$list->image}}">Edit</button>
                        &nbsp;<button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$list->id}}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>