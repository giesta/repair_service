@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Užregistruoti naują įtaisą</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('devices.index') }}"> Atgal</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Yra problemų su jūsų duomenimis.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('devices.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Pavadinimas:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Pavadinimas">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Aprašymas:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Aprašymas"></textarea>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Serijos numeris:</strong>
		            <input type="text" name="series_number" class="form-control" placeholder="Serijos numeris">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Registracijos data:</strong>
		            <input type="date" name="registration_date" class="form-control" value={{ date('Y-m-d') }}>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Savininkas:</strong>
            {!! Form::select('owner_id', $owners, null, array('class' => 'form-control','id' => 'id')) !!}
        </div>
    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Patvirtinti</button>
		    </div>
		</div>


    </form>


@endsection