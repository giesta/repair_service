<?php


namespace App\Http\Controllers;


use App\Device;
use Illuminate\Http\Request;
use App\User;
use Auth;


class DeviceController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:device-list|device-create|device-edit|device-delete', ['only' => ['index','show']]);
         $this->middleware('permission:device-create', ['only' => ['create','store']]);
         $this->middleware('permission:device-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:device-delete', ['only' => ['destroy']]);
         $this->middleware('role:Vadybininkas',['only' => ['filter', 'report']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('Remontininkas'))
        {
            $devices = Device::whereNull('repaired')->whereNull('taken_back')->latest()->paginate(5);
        }
        elseif(Auth::user()->hasRole('Vadybininkas')){
            $devices = Device::with('repairers')->latest()->paginate(5);
            //$name = $devices->repairers[0]->name;
           // dd($devices);
        }
        else{
            $devices = Device::latest()->paginate(5);
        }
        
        return view('devices.index',compact('devices'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners = User::whereHas("roles", function($q){ $q->where("name", "Klientas"); })->pluck('name', 'id', 'email');
        //dd($owners);
        return view('devices.create', compact('owners'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request);
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'series_number' =>'required',
            'registration_date' => 'required',
            'owner_id' =>'required'
        ]);


        Device::create($request->all());


        return redirect()->route('devices.index')
                        ->with('success','Įrenginys užregistruotas sėkmingai.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return view('devices.show',compact('device'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return view('devices.edit',compact('device'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',            
            'series_number' =>'required',
            'registration_date' => 'required',
        ]);


        $device->update($request->all());

        return redirect()->route('devices.index')
                        ->with('success','Įrenginys atnaujintas sėkmingai.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();


        return redirect()->route('devices.index')
                        ->with('success','Įrenginys ištrintas sėkmingai.');
    }

     /**
     * Update the taken back field in storage.
     *
     * @param  \App\device  $device
     * @return \Illuminate\Http\Response
     */
    public function takenBack($id)
    {
        //dd($device);
        $device = Device::find($id);
        $device->update(['taken_back' => date('Y-m-d')]);
        //dd($device);
        return redirect()->route('devices.index')
                        ->with('success','Įrenginys grąžintas sėkmingai');
    }
     /**
     * Update the repaired field in storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function repaired($id, Request $request)
    {
        //dd($request->price);
        request()->validate([
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        //dd($device->price);
        $device = Device::find($id);
        $device->update(['price' => $request->price, 'repaired' => date('Y-m-d'), 'repairer_id' => Auth::id()]);
        //
        return redirect()->route('devices.index')
                        ->with('success','Įrenginys pažymėtas kaip sutaisytas.');
    }

     /**
     
     *
     * @return \Illuminate\Http\Response
     */
    public function filter()
    {
        $repairers = User::whereHas("roles", function($q){ $q->where("name", "Remontininkas"); })->pluck('name', 'id', 'email');
        return view('reports.filter', compact('repairers'));
    }

    /**
    
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, Device $device)
    {
    //$devices = Device::with('repairers');
       //dd($request);
       $registration = $request->input('registration_date');
       
       $repaired = $request->input('repaired');
       $taken_back = $request->input('taken_back');
       $repairer_id = $request->input('id');
       
        $devices = Device::with('repairers')
        ->when($registration, function ($query, $registration) {
            return $query->where('registration_date','>=', $registration);
        })
        ->when($repaired, function ($query, $repaired) {
            return $query->where('repaired','>=', $repaired);
        })
        ->when($taken_back, function ($query, $taken_back) {
            return $query->where('taken_back','>=', $taken_back);
        })
        ->when($repairer_id, function ($query, $repairer_id) {
            return $query->where('repairer_id','>=', $repairer_id);
        })
          ->get(); 
        $count = count($devices);
        $countOfRepaired = $devices->where('repaired','!=', null)->count();
        $countOfTakenBack = $devices->where('taken_back','!=', null)->count();
        $sum = $devices->sum('price');
        return view('reports.report', compact('devices', 'count', 'sum', 'countOfRepaired', 'countOfTakenBack'));
    }
}