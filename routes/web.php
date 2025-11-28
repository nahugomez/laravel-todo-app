<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("index", [
        "name" => "Nahuel",
    ]);
});

Route::fallback(function () {
    return "Page Not Found";
});