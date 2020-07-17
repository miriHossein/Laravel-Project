@extends('layouts.admin')

@section('title')
    All Categories
@endsection

@section('content')
    <div class="container">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th style="text-align: center" scope="col">id</th>
                <th style="text-align: center" scope="col">name</th>
                <th style="text-align: center" scope="col">Created</th>
                <th style="text-align: center" scope="col">Updated</th>
                <th style="text-align: center">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td style="text-align: center">{{$category->id}}</td>
                    <td style="text-align: center">{{$category->name}}</td>
                    <td style="text-align: center">{{$category->created_at->diffForHumans()}}</td>
                    <td style="text-align: center">{{$category->updated_at->diffForHumans()}}</td>
                    <td style="text-align: center">
                        <form action="{{ route('categories.destroy', $category->id ) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" onclick="return window.confirm('Are you Sure?');"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
