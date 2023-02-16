<?php
namespace App\Http\Controllers;
use SimpleXMLElement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportXmlController extends Controller
{
    public function exportTableToXml()
    {
		//Aquí se conecta a la DB y busca los valores
		$employees = DB::table('crear_empleados')->select('name', 'codigo_empleado', 'rol')->get();
		//Aqui se crea la cabecera del XML
        $xml = new SimpleXMLElement('<ns0:empleados xmlns:ns0="http://www.arcosdorados.com/integrationservices/cdm"/>');

		
			//Aqui se le da formato al XML
			foreach ($employees as $employee) {
			  $xmlElement = $xml->addChild("ns0:empleado", null, null);
			  $xmlElement->addChild("ns0:employeeID", $employee->codigo_empleado);
			  $xmlElement->addChild("ns0:employeeName", $employee->name);
			  $xmlElement->addChild("ns0:securityLevel", $employee->rol);
			}
		

		   // Obtener la salida XML
		$output = $xml->asXML();

		// Eliminar la primera línea de la salida
		$output = preg_replace('/<\?xml.*\?>/', '', $output);

		// Establecer las cabeceras de la respuesta HTTP
		header('Content-type: text/xml');
		header('Content-Disposition: attachment; filename="employees.xml"');

		// Imprimir la salida XML
		echo $output;
		exit;
		
		
    }
}
