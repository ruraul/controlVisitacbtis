<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Puestos;

class puestosController extends Controller
{
    public function verPuestos(){
        $puestos = DB::select('select num_puesto, nompuesto from puesto;');
        if(collect($puestos) -> isEmpty()){
            $data = [
                'message' => 'No se encontraron puestos',
                'status' => 404
            ];
            return response()-> json($data);
        }
        return response()->json($puestos);
    }
    
}
