<?php


use Illuminate\Support\Facades\Route;

dataset('public routes',function (){
    return array_values(
        // In order to access to Route::getRoutes() we need to install
        // lukeraymonddowning/pest-plugin-larastrap
      collect(Route::getRoutes())
          ->filter(fn($route) => in_array('GET',$route->methods()))
          // ignoring private routes
          ->reject( fn($route) => in_array('auth:jwt', $route->middleware()) )
          ->reject( fn($route) => in_array('admin', $route->middleware()) )
          // Ignoring base laravel routes
          ->reject( fn($route) => in_array($route->uri(),['sanctum/csrf-cookie','request-docs/_astro/{slug}']))
          ->map(fn($route) => $route->uri())
          ->toArray()
    );
});
