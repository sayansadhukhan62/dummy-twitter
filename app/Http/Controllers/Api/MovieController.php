<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
     public function index()
    {
        $movie = Movie::all();
        return $movie;
    }
}
