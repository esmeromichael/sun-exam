<div class="table-responsive">

    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Article Title</th>
                <th>Article Content Snippet</th>
                <th>Created Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($lists as $list)
                <tr>
                    <td><a href="#" data-toggle="modal" data-target="article-votes"> {{$list->title}} </a></td>
                    <td>{{$list->content}}</td>
                    <td>{{date('M-d-Y', strtotime($list->created_at))}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#create-article" data-id="{{$list->id}}" data-title="{{$list->title}}" data-content="{{$list->content}}">Edit</button>
                        &nbsp;<button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$list->id}}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>