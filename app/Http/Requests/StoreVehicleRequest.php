<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'typeVehicle' => 'required|exists:type_vehicles,id',
            'placa' => 'required',
            'cor' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'typeVehicle.required' => 'Tipo de veículo é obrigatório',
            'placa.required' => 'Placa é obrigatório',
            'cor.required' => 'Cor é obrigatório',
            'marca.required' => 'Marca é obrigatório',
            'modelo.required' => 'Modelo é obrigatório',
            'ano.required' => 'Ano é obrigatório',
        ];
    }
}
