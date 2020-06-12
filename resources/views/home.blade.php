@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(Auth::user()->hasRole('Klientas'))
        <table class="table table-bordered">
        <tr>
            <th>Nr</th>
            <th>Pavadinimas</th>
            <th>Aprašymas</th>
            <th>Būsena</th>
            <th>Kaina</th>
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
	        <td>{{$device->price}}</td>
	    </tr>
	    @endforeach
    </table>
    @else
            <div class="card">
                <div class="card-header">Skelbimų lenta</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Esate prisijungęs!
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
