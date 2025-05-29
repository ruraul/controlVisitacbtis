<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;


class departamentoController extends Controller
{
    public function verDepartamentos(){
        $departamentos = DB::select('select id_dep, nombredep, horarioatencion from departamento order by id_dep;');
        if(collect($departamentos) -> isEmpty()){
            $data = [
                'message' => 'No se encontraron departamentos',
                'status' => 404
            ];
            return response()->json($data);
        }
        return response()->json($departamentos);
    }
}
