@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        @hasrole('Administratorius')
            <h2>Redaguoti informaciją apie naudotoją</h2>
        @else
        <h2>Redaguoti informaciją apie klientą</h2>
        @endhasrole
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Atgal</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> Yra problemų su įvestais duomenimis.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Vardas:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Vardas','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Epaštas:</strong>
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
            <strong>Patvirtinti slapatažodį:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Patvirtinti slapatažodį','class' => 'form-control')) !!}
        </div>
    </div>
    @hasrole('Administratorius')
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Rolė:</strong>
            {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    @endhasrole
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Patvirtinti</button>
    </div>
</div>
{!! Form::close() !!}

@endsection