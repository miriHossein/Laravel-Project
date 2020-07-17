@extends('layouts.admin')

@section('title')
    Edit User
@endsection
@section('content')
    <div class="col-sm-3">
        <img src="{{$user->photo ? "" : 'http://placehold.it/400x400'}}" style="width: 100%; object-fit: cover" alt="" class="img-responsive img-rounded img-fluid">
        <img src="{{asset('images')}}/{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" style="width: 100%; object-fit: cover" alt="" class="img-responsive img-rounded img-fluid">

    </div>
    <div class="col-sm-9">
        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUserController@update', $user->id], 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'style' => 'margin: 10px 0', 'placeholder' => 'Name']) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'style' => 'margin: 10px 0', 'placeholder' => 'Email']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'type' => 'password', 'style' => 'margin: 10px 0', 'placeholder' => 'Password']) !!}
            {!! Form::select('role_id', ['' => 'Choose Options'] + $roles, null, ['class' => 'form-control']) !!}
            {!! Form::file('photo_id', ['class' => 'form-control', 'style' => 'margin: 10px 0']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
         @if(count($errors) > 0)

                 <div>
                     @foreach($errors->all() as $error)
                         <div class="alert alert-warning">
                             {{$error}}
                             <button class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                         </div>
                     @endforeach
                 </div>
             @endif
    </div>
@endsection