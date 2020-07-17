@extends('layouts.admin')

@section('title')
    All Comments
@endsection

@section('content')
    <div class="container">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th style="text-align: center" scope="col">id</th>
                <th style="text-align: center" scope="col">Profile</th>
                <th style="text-align: center" scope="col">Author</th>
                <th style="text-align: center" scope="col">Email</th>
                <th style="text-align: center" scope="col">Body</th>
            </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td style="line-height: 50px; text-align: center">{{$comment->id}}</td>
                        <td style="line-height: 50px; text-align: center"><img src="{{asset('images')}}/{{$comment->file}}" style="width: 50px; height: 50px; border-radius: 100%;" alt=""></td>
                        <td style="line-height: 50px; text-align: center">{{$comment->author}}</td>
                        <td style="line-height: 50px; text-align: center">{{$comment->email}}</td>
                        <td style="line-height: 50px; text-align: center">{{$comment->content}}</td>
                        <td style="line-height: 50px; text-align: center">{{$comment->created_at->diffForHumans()}}</td>
                        <td style="line-height: 50px">
                            <form action="{{ route('comments.destroy', $comment->id ) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" onclick="return window.confirm('Are you Sure?');"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td style="line-height: 50px; text-align: center"><a target="_blank" href="{{route('posts.show', $comment->post_id)}}"><button class="btn btn-info"><i class="fa fa-eye"></i></button></a></td>
                        @if($comment->is_active == 1)
                            <td style="line-height: 50px; text-align: center">
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                                <input type="hidden" name="is_active" value="0">
                                {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            </td>
                        @else
                            <td style="line-height: 50px; text-align: center">
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                                <input type="hidden" name="is_active" value="1">
                                {!! Form::submit('Un-approve', ['class' => 'btn btn-warning']) !!}
                                {!! Form::close() !!}
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($comments) == 0)
            <h4 style="font-size: 25px; text-align: center">No Comment</h4>
        @endif
    </div>
@endsection
