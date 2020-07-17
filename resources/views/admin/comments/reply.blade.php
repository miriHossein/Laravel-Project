@extends('layouts.admin')

@section('title')
    All Replies
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
            @foreach($replies as $reply)
                <tr>
                    <td style="line-height: 50px; text-align: center">{{$reply->id}}</td>
                    <td style="line-height: 50px; text-align: center"><img src="{{asset('images')}}/{{$reply->file}}" style="width: 50px; height: 50px; border-radius: 100%;" alt=""></td>
                    <td style="line-height: 50px; text-align: center">{{$reply->author}}</td>
                    <td style="line-height: 50px; text-align: center">{{$reply->email}}</td>
                    <td style="line-height: 50px; text-align: center">{{$reply->content}}</td>
                    <td style="line-height: 50px; text-align: center">{{$reply->created_at->diffForHumans()}}</td>
                    <td style="line-height: 50px">
                        <form action="{{ route('comments.destroy', $reply->id ) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" onclick="return window.confirm('Are you Sure?');"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                    @if($reply->is_active == 1)
                        <td style="line-height: 50px; text-align: center">
                            {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}
                        </td>
                    @else
                        <td style="line-height: 50px; text-align: center">
                            {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            {!! Form::submit('Un-approve', ['class' => 'btn btn-warning']) !!}
                            {!! Form::close() !!}
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($replies) == 0)
            <h4 style="font-size: 25px; text-align: center">No Comment</h4>
        @endif
    </div>
@endsection
