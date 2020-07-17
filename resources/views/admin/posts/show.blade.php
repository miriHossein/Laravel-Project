@extends('layouts.admin')
@section('title')
    {{$post->title}}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-3">
            <img src="{{asset('postsImage')}}/{{$post->photo->file}}" class="img-fluid" style="width: 100%;" alt="">
        </div>
        <div class="col-sm-9">
            <p style="text-align: left;">{{$post->content}}</p>
            <h5><b>Category:</b> {{$post->category->name}} <span style="margin: 0 10px;"><b>Author:</b> {{$post->user->name}}</span> <span style="margin: 0 10px;"><b>Status:</b> {{$post->status == 1 ? 'Active' : 'Not Active'}}</span> <span style="margin: 0 10px;"><b>Created:</b> {{$post->created_at->diffForHumans()}}</span></h5>
        </div>
    </div>
    <div class="comments">
        <br>
        <h1>Leave a Comment</h1>
        <div style="margin: 15px 0 !important;" class="comment_section">
            {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}
            <div class="form-group">
                <input type="hidden" name="post_id" value="{{$post->id}}">
                {!! Form::textarea('body', null, ['class' => 'form-control', 'style' => 'margin: 10px 0', 'placeholder' => 'Content ...']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Comment!', ['class' => 'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="comments_items">
        <hr>
        @foreach($comments as $comment)
           <div>
               <div style="display: flex;">
                   <img src="{{asset('images')}}/{{$comment->file}}" style="width: 50px; height: 50px; border-radius: 100%" alt="">
                   <div style="margin: 0 10px;">
                       <p style="margin: 0;"><b>{{$comment->author}}</b></p>
                       <p style="margin: 0;">{{$comment->created_at->diffForHumans()}}</p>
                   </div>
               </div>
               <p style="margin: 0 60px;">{{$comment->content}}</p>
           </div>
            @if(count($comment->replies) > 0)
                @foreach($comment->replies->where('is_active', 1) as $reply)
                    <div style="width: 500px; margin: 10px 60px">
                        <div style="display: flex;">
                            <img src="{{asset('images')}}/{{$reply->file}}" style="width: 50px; height: 50px; border-radius: 100%" alt="">
                            <div style="margin: 0 10px;">
                                <p style="margin: 0;"><b>{{$reply->author}}</b></p>
                                <p style="margin: 0;">{{$reply->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                        <p style="margin: 0 60px;">{{$reply->content}}</p>
                    </div>
                @endforeach
            @endif
            <div class="comment_reply_container" style="position: relative;">
                <button class="toggle_reply btn btn-primary" style="margin: 10px 0;">Reply</button>
                <div class="comment_reply">
                    <div style="margin: 15px 0 !important;" class="comment_section">
                        {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}
                        <div class="form-group">
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            {!! Form::textarea('body', null, ['class' => 'form-control', 'style' => 'margin: 10px 0; height: 40px;', 'placeholder' => 'Content ...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Comment!', ['class' => 'btn btn-info']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        <hr>
        @endforeach
    </div>
    <br><br><br>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('.comment_reply').hide();
            $('.comment_reply_container .toggle_reply').click(function () {
                $(this).next().slideToggle('slow');
            })
        })
    </script>

@endsection