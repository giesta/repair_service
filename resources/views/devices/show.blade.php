@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Informacija apie įrenginį</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('devices.index') }}"> Atgal</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pavadinimas:</strong>
                {{ $device->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Aprašymas:</strong>
                {{ $device->detail }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Serijos numeris:</strong>
                {{ $device->series_number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Registracijos data:</strong>
                {{ $device->registration_date }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pataisytas:</strong>
                @if($device->repaired != null)
                TAIP({{ $device->repaired }})
                @else
                NE
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Atsiimtas:</strong>
                @if($device->taken_back != null)
                TAIP({{ $device->taken_back }})
                @else
                NE
                @endif
            </div>
        </div>
    </div>
@endsection