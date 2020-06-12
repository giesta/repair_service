@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        @hasrole('Administratorius')
            <h2>Užregistruoti naują naudotoją</h2>
        @else
        <h2>Užregistruoti naują klientą</h2>
        @endhasrole
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Atgal</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> Yra problemų su jūsų įvestais duomenimis.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Vardas:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Vardas','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>E-paštas:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Epaštas','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Slaptažodis:</strong>
            {!! Form::password('password', array('placeholder' => 'Slaptažodis','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Patvirtinti slaptažodį:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Patvirtinti slaptažodį','class' => 'form-control')) !!}
        </div>
    </div>
    @hasrole('Priėmėjas')
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        {{ Form::hidden('roles', 'Klientas', array('id' => 'invisible_id')) }}
        </div>
    </div>
    @else
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Rolė:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    @endhasrole
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Patvirtinti</button>
    </div>
</div>
{!! Form::close() !!}


@endsection