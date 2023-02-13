@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.crearEmpleado.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crear-empleados.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.crearEmpleado.fields.name') }}
                        </th>
                        <td>
                            {{ $crearEmpleado->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crearEmpleado.fields.codigo_empleado') }}
                        </th>
                        <td>
                            {{ $crearEmpleado->codigo_empleado }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crearEmpleado.fields.rol') }}
                        </th>
                        <td>
                            {{ App\Models\CrearEmpleado::ROL_SELECT[$crearEmpleado->rol] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crearEmpleado.fields.restaurante') }}
                        </th>
                        <td>
                            {{ App\Models\CrearEmpleado::RESTAURANTE_SELECT[$crearEmpleado->restaurante] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crear-empleados.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection