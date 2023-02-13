<?php

namespace App\Http\Requests;

use App\Models\CrearEmpleado;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCrearEmpleadoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('crear_empleado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:crear_empleados,id',
        ];
    }
}
