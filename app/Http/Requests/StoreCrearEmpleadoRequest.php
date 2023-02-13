<?php

namespace App\Http\Requests;

use App\Models\CrearEmpleado;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCrearEmpleadoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crear_empleado_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'codigo_empleado' => [
                'string',
                'max:7',
                'required',
            ],
            'rol' => [
                'required',
            ],
            'restaurante' => [
                'required',
            ],
        ];
    }
}
