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
    //Función para obtener un sólo estudiante
    public function show($id){
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            $data =[
                'mensaje'=>'Estudiante no encontrado',
                'estado'=> 404
            ]; 
            return response()->json($data, 404);
        }

        $data = [
            'estudiante'=>$estudiante,
            'estado'=>200
        ];
        return response()->json($data, 200);
    }
    //Función para eliminar un estudiante
    public function destroy($id){
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            $data =[
                'mensaje'=>'Estudiante no encontrado',
                'estado'=> 404
            ]; 
            return response()->json($data, 404);
        }
        $estudiante->delete();
        $data = [
            'mensaje'=>'Estudiante eliminado',
            'estado' => 200
        ];
        return response()->json($data, 200);
    }

    //Función para actualizar un estudiante
    public function update(Request $request, $id){

        $estudiante = Estudiante::find($id);
        
        if (!$estudiante) {
            $data =[
                'mensaje'=>'Estudiante no encontrado',
                'estado'=> 404
            ]; 
            return response()->json($data, 404);
        }

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
        
        $estudiante->nombre = $request->nombre; 
        $estudiante->email = $request->email; 
        $estudiante->telefono = $request->telefono; 
        $estudiante->lenguaje = $request->lenguaje; 

        $estudiante->save();

        $data = [
            'estudiante'=>$estudiante,
            'estado'=>200
        ];

        return response()->json($data, 200);
    }
}
