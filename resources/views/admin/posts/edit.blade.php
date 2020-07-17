@extends('layouts.admin')
@section('title')
    Edit
@endsection

@section('content')
    {!! Form::model($posts, ['method' => 'PATCH', 'action' => ['AdminPostController@update', $posts->id], 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        {!! Form::text('title', null, ['class' => 'form-control', 'style' => 'margin: 10px 0', 'placeholder' => 'Title']) !!}
        {!! Form::textarea('content', null, ['class' => 'form-control', 'style' => 'margin: 10px 0', 'placeholder' => 'Content']) !!}
        {!! Form::select('status', ['1' => 'Active', '0' => 'Not Active'], null, ['class' => 'form-control', 'style' => 'margin: 10px 0']) !!}
        {!! Form::select('user_id', ['' => 'Author'] + $users, null, ['class' => 'form-control', 'style' => 'margin: 10px 0']) !!}
        {!! Form::select('category_id', ['' => 'Category'] + $categories, null, ['class' => 'form-control']) !!}
        {!! Form::file('photo_id', ['class' => 'form-control', 'style' => 'margin: 10px 0']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Edit Post', ['class' => 'btn btn-primary']) !!}
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