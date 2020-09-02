<div class="table-responsive-sm">
    <table class="table table-striped" id="posts-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Title</th>
        <th>Body</th>
        <th>Image</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $posts)
            <tr>
                <td>{{ $posts->user_id }}</td>
            <td>{{ $posts->title }}</td>
            <td>{{ $posts->body }}</td>
            <td>{{ $posts->image }}</td>
                <td>
                    {!! Form::open(['route' => ['posts.destroy', $posts->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('posts.show', [$posts->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('posts.edit', [$posts->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>