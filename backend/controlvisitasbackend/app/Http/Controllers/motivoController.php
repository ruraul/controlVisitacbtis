<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motivo;


class motivoController extends Controller
{
    public function verMotivos(){
        $motivos = Motivo::select('motivo')
            ->orderBy('id_motivo')
            ->get();
        return response()->json($motivos);
    }
}
