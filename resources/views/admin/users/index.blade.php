@extends('layouts.admin')

@section('title')
    All Users
@endsection

@section('content')
<div class="tables">
    <div class="container">
        @if(Session::has('deleted_user'))
            <div class="alert alert-danger"><i class="fa fa-trash" style="margin: 0 10px;"></i>{{session('deleted_user')}}
                <button class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
            </div>
        @endif
        @if(Session::has('edit_user'))
            <div class="alert alert-info"><i class="fa fa-edit" style="margin: 0 10px;"></i>{{session('edit_user')}}
                <button class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
            </div>
        @endif
            @if(Session::has('create_user'))
                <div class="alert alert-success"><i class="fa fa-check" style="margin: 0 10px;"></i>{{session('create_user')}}
                    <button class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                </div>
            @endif
        <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th style="text-align: center" scope="col">id</th>
                <th style="text-align: center" scope="col">Name</th>
                <th style="text-align: center" scope="col">Email</th>
                <th style="text-align: center" scope="col">Role</th>
                <th style="text-align: center" scope="col">is Online</th>
                <th style="text-align: center" scope="col">profile</th>
                <th style="text-align: center" scope="col">Created</th>
                <th style="text-align: center" scope="col">Updated</th>
                <th style="text-align: center">Delete</th>
                <th style="text-align: center">Edit</th>
              </tr>
            </thead>
            <tbody>
                @if ($user)
                    @foreach ($user as $item)
                      <tr>
                        <th style="text-align: center" scope="row">{{$item->id}}</th>
                        <td style="text-align: center">{{$item->name}}</td>
                        <td style="text-align: center">{{$item->email}}</td>
                        <td style="text-align: center">{{$item->role ? $item->role->name : 'subscriber'}}</td>
                        <td style="text-align: center">
                            @if($item->isOnline())
                                <div style="width: 20px; height: 20px; background-color: green; border-radius: 100%; text-align: center; margin: auto;"></div>
                            @else
                                <div style="width: 20px; height: 20px; background-color: red; border-radius: 100%; text-align: center; margin: auto;"></div>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <img src="{{$item->photo ? '' : 'http://placehold.it/400x400'}}" title="no photo" style="width: 30px; height: 30px; object-fit: cover; border-radius: 100%" alt="">
                            <img src="{{asset('images')}}/{{$item->photo ? $item->photo->file : ""}}" title="{{$item->photo ? $item->photo->file : ""}}" style="width: 30px; height: 30px; object-fit: cover; border-radius: 100%" alt="">
                        </td>
                        <td style="text-align: center">{{$item->created_at->diffForHumans()}}</td>
                        <td style="text-align: center">{{$item->updated_at->diffForHumans()}}</td>
                        <td style="text-align: center">
                            <form action="{{ route('users.destroy', $item->id ) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" onclick="return window.confirm('Are you Sure?');"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td style="text-align: center"><a href="/admin/users/{{$item->id}}/edit"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a></td>
                      </tr>
                    @endforeach
                @endif
            </tbody>
          </table>
    </div>
</div>
@endsection