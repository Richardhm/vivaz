<?php

namespace App\Http\Controllers;

use App\Models\Administradora;
use App\Models\Plano;
use App\Models\Tabela;
use App\Models\TabelaOrigens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
       return view('dashboard');
    }
}
