<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCrearEmpleadoRequest;
use App\Http\Requests\StoreCrearEmpleadoRequest;
use App\Http\Requests\UpdateCrearEmpleadoRequest;
use App\Models\CrearEmpleado;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CrearEmpleadoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('crear_empleado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CrearEmpleado::query()->select(sprintf('%s.*', (new CrearEmpleado())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'crear_empleado_show';
                $editGate = 'crear_empleado_edit';
                $deleteGate = 'crear_empleado_delete';
                $crudRoutePart = 'crear-empleados';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('codigo_empleado', function ($row) {
                return $row->codigo_empleado ? $row->codigo_empleado : '';
            });
            $table->editColumn('rol', function ($row) {
                return $row->rol ? CrearEmpleado::ROL_SELECT[$row->rol] : '';
            });
            $table->editColumn('restaurante', function ($row) {
                return $row->restaurante ? CrearEmpleado::RESTAURANTE_SELECT[$row->restaurante] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.crearEmpleados.index');
    }

    public function create()
    {
        abort_if(Gate::denies('crear_empleado_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.crearEmpleados.create');
    }

    public function store(StoreCrearEmpleadoRequest $request)
    {
        $crearEmpleado = CrearEmpleado::create($request->all());

        return redirect()->route('admin.crear-empleados.index');
    }

    public function edit(CrearEmpleado $crearEmpleado)
    {
        abort_if(Gate::denies('crear_empleado_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.crearEmpleados.edit', compact('crearEmpleado'));
    }

    public function update(UpdateCrearEmpleadoRequest $request, CrearEmpleado $crearEmpleado)
    {
        $crearEmpleado->update($request->all());

        return redirect()->route('admin.crear-empleados.index');
    }

    public function show(CrearEmpleado $crearEmpleado)
    {
        abort_if(Gate::denies('crear_empleado_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.crearEmpleados.show', compact('crearEmpleado'));
    }

    public function destroy(CrearEmpleado $crearEmpleado)
    {
        abort_if(Gate::denies('crear_empleado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crearEmpleado->delete();

        return back();
    }

    public function massDestroy(MassDestroyCrearEmpleadoRequest $request)
    {
        CrearEmpleado::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
