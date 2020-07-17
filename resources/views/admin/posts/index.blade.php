@extends('layouts.admin')

@section('title')
    All Posts
@endsection

@section('content')
    <div class="container">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th style="text-align: center" scope="col">id</th>
                <th style="text-align: center" scope="col">title</th>
                <th style="text-align: center" scope="col">author</th>
                <th style="text-align: center" scope="col">status</th>
                <th style="text-align: center" scope="col">Categories</th>
                <th style="text-align: center" scope="col">Image</th>
                <th style="text-align: center" scope="col">Created</th>
                <th style="text-align: center" scope="col">Updated</th>
                <th style="text-align: center" scope="col">Comments</th>
                <th style="text-align: center">Delete</th>
                <th style="text-align: center">Edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td style="text-align: center">{{$post->id}}</td>
                    <td style="text-align: center"><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></td>
                    <td style="text-align: center">{{$post->user->name}}</td>
                    <td style="text-align: center">{{$post->status == 1 ? 'Publish' : 'Draft'}}</td>
                    <td style="text-align: center">{{$post->category->name}}</td>
                    <td style="text-align: center">
                        <img src="../postsImage/{{$post->photo->file}}" width="40px" height="40px" style="object-fit: cover; border-radius: 100%;" alt="">
                    </td>
                    <td style="text-align: center">{{$post->created_at->diffForHumans()}}</td>
                    <td style="text-align: center">{{$post->updated_at->diffForHumans()}}</td>
                    <td style="text-align: center">
                        <?php
                            $comments = count($post->comments->where('is_active', 1));
                            $replies = count($post->replies->where('is_active', 1));
                            echo $comments + $replies;

                        ?>
                    </td>
                    <td style="text-align: center">
                        <form action="{{ route('posts.destroy', $post->id ) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" onclick="return window.confirm('Are you Sure?');"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                    <td style="text-align: center"><a href="{{Route('posts.edit', $post->id)}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row col-sm-6">
            {{$posts->links()}}
        </div>
    </div>
@endsection
