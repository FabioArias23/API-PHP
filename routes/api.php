<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticuloController;
use App\Http\Controllers\Api\CategoriaController;
Route::apiResource('articulos', ArticuloController::class);
Route::apiResource('categorias', CategoriaController::class);
