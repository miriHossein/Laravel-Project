@extends('layouts.admin')

@section('title')
    All Medias
@endsection

@section('content')
    <div class="container">
        @if(Session::has('deleted_photo'))
            <div class="alert alert-danger"><i class="fa fa-trash" style="margin: 0 5px;"></i>{{session('deleted_photo')}}
                <button class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
            </div>
        @endif
        <div class="table">
            <table class="table table-striped table-hover">
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Delete</th>
                </tr>
                @foreach($photos as $photo)
                        <tr>
                            <td>{{$photo->id}}</td>
                            <td>{{$photo->file}}</td>
                            <td>{{$photo->created_at->diffForHumans()}}</td>
                            <td>{{$photo->updated_at->diffForHumans()}}</td>
                            <td>
                                <form action="{{ route('medias.destroy', $photo->id ) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" onclick="return window.confirm('Are you Sure?');"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
