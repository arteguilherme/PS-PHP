<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeVehicles = TypeVehicle::all();
        return view('vehicle.create', compact('typeVehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRequest $request)
    {
        $request->validated();

        $vehicle = $this->getVehicle($request->all());

        Vehicle::create([
            'user_id' => auth()->id(),
            'type_vehicle_id' => request('typeVehicle'),
            'placa' => request('placa'),
            'marca' => $vehicle->Marca,
            'modelo' => $vehicle->Modelo,
            'ano' => $vehicle->AnoModelo,
            'cor' => request('cor'),
            'criado_em' => Carbon::now()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
        $typeVehicles = TypeVehicle::all();
        return view('vehicle.edit',compact('vehicle', 'typeVehicles'));
    }

    /**
     * @param UpdateVehicleRequest $request
     * @param Vehicle $vehicle
     * @return void
     */
    public function update(StoreVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicleData = $this->getVehicle($request->all());

        $vehicle->update([
            'user_id' => auth()->id(),
            'type_vehicle_id' => request('typeVehicle'),
            'placa' => request('placa'),
            'marca' => $vehicleData->Marca,
            'modelo' => $vehicleData->Modelo,
            'ano' => $vehicleData->AnoModelo,
            'cor' => request('cor'),
            'criado_em' => Carbon::now()
        ]);

        return redirect()->route('dashboard')->with('success','Atualizado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
        $vehicle->delete();

        return redirect()->route('dashboard')->with('success','Deletado com sucesso');
    }

    public function getMarcas(TypeVehicle $typeVehicle)
    {
        $output = file_get_contents("https://parallelum.com.br/fipe/api/v1/{$typeVehicle->slug}/marcas");

        return (array) json_decode($output);
    }
    public function getModelos(TypeVehicle $typeVehicle, $marca)
    {
        $output = file_get_contents("https://parallelum.com.br/fipe/api/v1/{$typeVehicle->slug}/marcas/{$marca}/modelos");

        return json_decode($output);
    }
    public function getAno(TypeVehicle $typeVehicle, $marca, $modelo)
    {
        $output = file_get_contents("https://parallelum.com.br/fipe/api/v1/{$typeVehicle->slug}/marcas/{$marca}/modelos/{$modelo}/anos");

        return json_decode($output);
    }

    public function getVehicle($data)
    {
        $typeVehicle = TypeVehicle::findOrFail($data['typeVehicle']);

        $vehicle = file_get_contents("https://parallelum.com.br/fipe/api/v1/{$typeVehicle->slug}/marcas/{$data['marca']}/modelos/{$data['modelo']}/anos/{$data['ano']}");

        return json_decode($vehicle);
    }
}
