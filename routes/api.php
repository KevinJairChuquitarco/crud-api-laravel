<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Importo el controlador de estudiante
use App\Http\Controllers\EstudianteController;

Route::get('estudiantes', [EstudianteController::class,'index']);
Route::post('estudiantes', [EstudianteController::class,'store']);