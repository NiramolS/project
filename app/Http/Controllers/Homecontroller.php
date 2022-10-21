<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

class Homecontroller extends Controller
{
    private string $title = 'Ban Don Luang Cotton Weaving Community';

    function show() 
    {
        return view('index', [
            'title' => "{$this->title}",
            'hello' => " Hello ",
        ]);
    }
}
