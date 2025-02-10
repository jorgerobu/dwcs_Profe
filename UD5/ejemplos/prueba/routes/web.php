<?php

use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MateriaController;


Route::get('/producto/alta',[ProductController::class, 'addProduct']);
Route::get('/producto/listar',[ProductController::class, 'getProducts']);
Route::get('/producto/listar/{id}',[ProductController::class, 'getProduct']);
Route::get('/alumno/nuevo',[AlumnoController::class, 'altaForm']);
Route::get('/alumno/listar',[AlumnoController::class, 'listAlumnos'])->name('list_alumnos');
Route::post('/alumno/alta',[AlumnoController::class, 'addAlumno'])->name('add_alumno');
Route::get('/equipo/nuevo',[EquipoController::class, 'addEquipo']);
Route::get('/materia/listar',[MateriaController::class, 'listMaterias']);
Route::post('/materia/matricular/{id}',[MateriaController::class, 'matricularAlumnos'])->name('matricular_alumnos');
Route::get('/materia/matricular/{id}',[MateriaController::class, 'matricularAlumnosForm'])->name('matricular_alumnos');

