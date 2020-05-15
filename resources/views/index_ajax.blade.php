<div class="table-responsive">

    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($lists as $list)
                <tr>
                    <td><a href="#" data-toggle="modal"> {{$list->name}} </a></td>
                    <td>{{$list->email}}</td>
                    <td>{{date('M-d-Y', strtotime($list->created_at))}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#create-register" data-id="{{$list->id}}" data-name="{{$list->name}}" data-email="{{$list->email}}">Edit</button>
                        &nbsp;<button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$list->id}}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>