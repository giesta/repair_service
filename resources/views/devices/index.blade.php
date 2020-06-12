@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Įtaisai</h2>
            </div>
            <div class="pull-right">
                @can('device-create')
                <a class="btn btn-success" href="{{ route('devices.create') }}"> Užregistruoti naują įrenginį</a>
                @endcan
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
            @hasrole('Administratorius')
            <th >Veiksmai</th>
            @endhasrole
            @hasrole('Priėmėjas')
            <th >Kaina</th>
            <th >Veiksmai</th>
            @endhasrole
            @hasrole('Remontininkas')
            <th >Kaina</th>
            <th >Veiksmai</th>
            @endhasrole
            @hasrole('Vadybininkas')
            <th >Kaina</th>
            <th >Remontininkas</th>
            @endhasrole
        </tr>
        
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
	        
        @hasrole('Priėmėjas')
        <td>{{ $device->price }}</td>
        <td>
            @if($device->taken_back == null)
            <div style="width:250px;">
            @else
            <div style="width:200px;">
            @endif
            <div style="float: left; width: 230px">
                <form action="{{ route('devices.destroy',$device->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('devices.show',$device->id) }}">Info</a>
                    @if($device->taken_back == null)
                    @can('device-edit')
                    
                    <a class="btn btn-primary" href="{{ route('devices.edit',$device->id) }}">Redaguoti</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('device-delete')
                    <button type="submit" class="btn btn-danger">Trinti</button>
                    @endcan
                    @endif
                </form>
                </div>
                @if($device->taken_back == null)
                <div style="float: right; width: 20px"> 
                <form action="{{ route('devices.takenBack',$device->id) }}" method="POST">
                @csrf
                    <button type="submit" class="btn btn-success">Pažymėti</button>
                </form>
	        </div>
            @endif
            </div>
            </td>
        @endhasrole
        @hasrole('Administratorius')
        <td>
                <form action="{{ route('devices.destroy',$device->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('devices.show',$device->id) }}">Info</a>                    
                    <a class="btn btn-primary" href="{{ route('devices.edit',$device->id) }}">Redaguoti</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Trinti</button>
                </form>
        </td>
        @endhasrole
        @hasrole('Remontininkas')
        <form action="{{ route('devices.repaired',$device->id) }}" method="POST">
        <td><input type="text" name="price" class="form-control" placeholder="0.00"></td>
        <td>
                
                <a class="btn btn-info" href="{{ route('devices.show',$device->id) }}">Info</a> 
                @csrf
                    <button type="submit" class="btn btn-success">Pažymėti</button>
                
        </td>
        </form>
        @endhasrole
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


    {!! $devices->links() !!}


@endsection