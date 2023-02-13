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

		$employees = DB::table('crear_empleados')->select('name', 'codigo_empleado', 'rol')->get();
        $xml = new SimpleXMLElement('<crear-empleados/>');
		

			foreach ($employees as $employee) {
			  $xmlElement = $xml->addChild("ns0:TextA");
			  $xmlElement->addChild("ns0:employeeID", $employee->codigo_empleado);
			  $xmlElement->addChild("ns0:name", $employee->name);
			  $xmlElement->addChild("ns0:rol", $employee->rol);
			}
		

        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="employees.xml"');

        echo $xml->asXML();
        exit;
		
		
		
		        // Agrega la sentencia de texto al footer del archivo XML
        $xml->addChild('footer', 'Este archivo fue generado por el controlador de exportación de Laravel');

        // Agrega el contenido del archivo a la respuesta
        $response->setContent($xml->asXML());

        // Devuelve la respuesta HTTP
        return $response;
		
		
    }
}
