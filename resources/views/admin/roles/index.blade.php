@extends('layouts.admin')

@section('title')
    All Roles
@endsection

@section('content')
    <div class="tables">
        <div class="container">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th style="text-align: center" scope="col">id</th>
                    <th style="text-align: center" scope="col">Name</th>
                    <th style="text-align: center">Delete</th>
                </tr>
                </thead>
                <tbody>
                @if ($roles)
                    @foreach ($roles as $item)
                        <tr>
                            <th style="text-align: center" scope="row">{{$item->id}}</th>
                            <td style="text-align: center">{{$item->name}}</td>
                            <td style="text-align: center">
                                <form action="{{ route('roles.destroy', $item->id ) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" onclick="return window.confirm('Are you Sure?');"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection