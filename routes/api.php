<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Importo el controlador de estudiante
use App\Http\Controllers\EstudianteController;

Route::get('estudiantes', [EstudianteController::class,'index']);
Route::post('estudiantes', [EstudianteController::class,'store']);
Route::get('estudiante/{id}', [EstudianteController::class,'show']);
Route::delete('estudiante/{id}', [EstudianteController::class,'destroy']);
Route::put('estudiante/{id}', [EstudianteController::class,'update']);