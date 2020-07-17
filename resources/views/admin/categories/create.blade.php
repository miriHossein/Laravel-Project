@extends('layouts.admin')

@section('title')
    Add New Category
@endsection

@section('content')
    {!! Form::open(['method' => 'Post', 'action' => 'AdminCategoryController@store']) !!}

    <div class="form-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'style' => 'margin: 10px 0', 'placeholder' => 'Name']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Category', ['class' => 'btn btn-primary']) !!}
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
