<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Importo el modelo Estudiante
use App\Models\Estudiante;

//importamos el validator para realizar las validaciones
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
    //Función para obtener todos los estudiantes
    public function index(){
        $estudiantes = Estudiante::all();

        $data = [
            'estudiantes'=>$estudiantes,
            'estado'=>200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre'=>'required|max:255',
            'email'=>'required|email|unique:estudiante',
            'telefono'=>'required|digits:10',
            'lenguaje'=>'required|in:Español,Ingles,Frances',
        ]);

        if ($validator->fails()) {
            $data = [
                'mensaje'=>'Error en la validación de datos',
                'error'=>$validator->errors(),
                'estado'=>400
            ];
            return response()->json($data, 400);
        }

        $estudiante = Estudiante::create([
            'nombre'=>$request->nombre,
            'email'=>$request->email,
            'telefono'=>$request->telefono,
            'lenguaje'=>$request->lenguaje
        ]);

        if (!$estudiante) {
            $data = [
                'mensaje'=>'Error al crear estudiante',
                'estado'=>500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'estudiante'=>$estudiante,
            'estado'=>201
        ];

        return response()->json($data, 201);

    }
}
