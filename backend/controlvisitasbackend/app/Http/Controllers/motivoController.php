<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Motivo;
//use Illuminate\Support\Facades\Validator;


class motivoController extends Controller
{
    public function verMotivos(Request $request){
        $id_dep = $request->input('id_dep');
        $motivos = DB::select('select id_motivo, motivo from motivo where id_dep = ? order by id_motivo', [$id_dep]);
        if(collect($motivos)->isEmpty()){
            $data = [
                'message' => 'No se encontraron motivos',
                'status' => 404
            ];
            return response()->json($data);
        }
        return response() ->json($motivos);
    }
}




