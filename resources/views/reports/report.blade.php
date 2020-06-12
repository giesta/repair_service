@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ataskaita</h2>
            </div>
            <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('devices.filter') }}"> Atgal</a>
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

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nr</th>
            <th>Pavadinimas</th>
            <th>Aprašymas</th>
            <th>Būsena</th>
            @hasrole('Vadybininkas')
            <th >Kaina</th>
            <th >Remontininkas</th>
            @endhasrole
        </tr>
        
        <?php 
        $i = 0
        ?>
	    @foreach ($devices as $device)        
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $device->name }}</td>
	        <td>{{ $device->detail }}</td>
            @if($device->taken_back != null)
            <td>Atsiimtas ({{ $device->taken_back }})</td>
            @elseif($device->repaired != null)
            <td>Pataisytas ({{ $device->repaired }})</td>
            @else
            <td>Laukimo</td>
            @endif
	        
        
        @hasrole('Vadybininkas')
        <td>{{ $device->price }}</td>
        @if($device->repairers != null)
        <td>{{$device->repairers->name}}</td>
        @else
        <td></td>
        @endif
        @endhasrole
	    </tr>
	    @endforeach
        
        
    </table>
<div class="container">
  <div class="row justify-content-end">
    <div class="col-4">
    <strong>Iš viso įrenginių skaičius:</strong><br>
        
        <strong>Suremontuotų įrenginių skaičius:</strong><br>
        
        <strong>Atsiimtų įrenginių skaičius:</strong><br>
        
        <strong>Suma už remontą:</strong>
    </div>
    <div class="col-4">
    <strong>{{$count}}</strong><br>
        <strong>{{$countOfRepaired}}</strong><br>
        <strong>{{$countOfTakenBack}}</strong><br>
        <strong>{{$sum}} EUR</strong><br>
        </div>
    </div>
  </div>
  </div>

@endsection