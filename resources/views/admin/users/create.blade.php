@extends('layouts.admin')

@section('title')
    Add New User
@endsection

@section('content')
    {!! Form::open(['method' => 'Post', 'action' => 'AdminUserController@store', 'enctype' => 'multipart/form-data']) !!}

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
        <div style="text-align: right; font-family: IRANSansWeb" dir="rtl">
            @foreach($errors->all() as $error)
                <div class="alert alert-warning">
                    {{$error}}
                    <button data-dismiss="alert" class="close" style="float: left;">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            @endforeach
        </div>
    @endif
@endsection