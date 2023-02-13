@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.crearEmpleado.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crear-empleados.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.crearEmpleado.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crearEmpleado.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="codigo_empleado">{{ trans('cruds.crearEmpleado.fields.codigo_empleado') }}</label>
                <input class="form-control {{ $errors->has('codigo_empleado') ? 'is-invalid' : '' }}" type="text" name="codigo_empleado" id="codigo_empleado" value="{{ old('codigo_empleado', '') }}" required>
                @if($errors->has('codigo_empleado'))
                    <span class="text-danger">{{ $errors->first('codigo_empleado') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crearEmpleado.fields.codigo_empleado_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.crearEmpleado.fields.rol') }}</label>
                <select class="form-control {{ $errors->has('rol') ? 'is-invalid' : '' }}" name="rol" id="rol" required>
                    <option value disabled {{ old('rol', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrearEmpleado::ROL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('rol', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('rol'))
                    <span class="text-danger">{{ $errors->first('rol') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crearEmpleado.fields.rol_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.crearEmpleado.fields.restaurante') }}</label>
                <select class="form-control {{ $errors->has('restaurante') ? 'is-invalid' : '' }}" name="restaurante" id="restaurante" required>
                    <option value disabled {{ old('restaurante', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CrearEmpleado::RESTAURANTE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('restaurante', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('restaurante'))
                    <span class="text-danger">{{ $errors->first('restaurante') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.crearEmpleado.fields.restaurante_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection