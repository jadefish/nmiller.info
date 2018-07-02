<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function document(string $path)
    {
        $factory = app('view');

        if (!$factory->exists($path)) {
            abort(404);
        }

        return $factory->make($path);
    }
}
