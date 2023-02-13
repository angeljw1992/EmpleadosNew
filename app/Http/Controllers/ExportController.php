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
        $txt .= $row->name . "," . $row->codigo_empleado . "," . $row->rol . ",textA,textB\n";
    }


	file_put_contents($file_path, $txt);
	return response()->download($file_path, 'export.txt', ['Content-Type' => 'text/plain']);


}
}