<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    public function consultarUsuario(Request $request)
    {
        $idsucursal = $request->query('idsucursal');
        $textbusqueda = $request->query('textbusqueda');

        if (!$textbusqueda || !$idsucursal) {
            return response()->json(['error' => 'Faltan parámetros'], 400);
        }

        // Aquí haces la consulta a tu base de datos real
        $usuario = DB::select("
            SELECT nombre, direccion, numero_suministro, estado_servicio
            FROM usuarios
            WHERE idsucursal = ? AND numero_suministro = ?
        ", [$idsucursal, $textbusqueda]);

        if (empty($usuario)) {
            return response()->json([], 200); // Se interpretará como vacío
        }

        return response()->json($usuario, 200);
    }
}

