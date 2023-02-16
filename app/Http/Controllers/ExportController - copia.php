<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ExportController extends Controller
{
public function exportToTxt()
{
    $data = DB::table('crear_empleados')->select('name', 'codigo_empleado', 'rol')->get();
    $txt = "";
	$file_path = storage_path('app/public/employee_data.txt');

    foreach ($data as $row) {
        $txt .= $row->name . "," . $row->codigo_empleado . "," . $row->rol . ",99991231,6719da5c9a6cb9448692dff985e2c0a5,516f169bdd1987733e3142652d563a8d\n";
    }


	file_put_contents($file_path, $txt);
	return response()->download($file_path, 'security.data', ['Content-Type' => 'text/plain']);


}
}