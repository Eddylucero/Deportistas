<?php

namespace App\Http\Controllers;
use App\Models\Deportistas;
use App\Models\Pais;
use App\Models\Disciplina;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.inicio', [
            'totalDeportistas' => Deportistas::count(),
            'totalPaises' => Pais::count(),
            'totalDisciplinas' => Disciplina::count()
        ]);
    }
}
