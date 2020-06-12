@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Sudaryti ataskaitą</h2>
        </div>
        
    </div>
</div>
<form action="{{ route('devices.report') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Pasirinkti registracijos datą nuo:</strong>
		            <input type="text" name="registration_date" class="form-control" placeholder="Pasirinkti registracijos datą nuo" onfocus="(this.type='date')">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Pasirinkti sutaisymo datą nuo:</strong>
		            <input type="text" name="repaired" class="form-control" placeholder="Pasirinkti sutaisymo datą nuo" onfocus="(this.type='date')">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Pasirinkti atsiėmimo datą nuo:</strong>
		            <input type="text" name="taken_back" class="form-control" placeholder="Pasirinkti atsiėmimo datą nuo" onfocus="(this.type='date')">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Pasirinkti remontininką:</strong>
            {!! Form::select('id', $repairers, null, array('class' => 'form-control','id' => 'id', 'placeholder'=>"Pasirinkti remontininką")) !!}
        </div>
    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Sudaryti ataskaitą</button>
		    </div>
		</div>


    </form>


@endsection