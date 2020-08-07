<?php

namespace App\Http\Controllers;

use App\Anio;
use App\ConceptoPagoAnio;
use App\Linea;
use App\Multa;
use App\Pago;
use App\Ruta;
use App\TipoMulta;
use App\TipoTransporte;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('home');
    } 
}
