<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use App\Models\Cliente;
use App\Models\Entrega;
use App\Models\Motorista;
use App\Models\Pedidos;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entregas = Entrega::orderBy('id', 'desc')->paginate(10);
        return view('entregas.index', compact('entregas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $caminhoes = Caminhao::get();
        $motoristas = Motorista::get();
        $pedidos = Pedidos::get();
        return view('entregas.create', compact('caminhoes', 'motoristas', 'pedidos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrega $entrega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrega $entrega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrega $entrega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrega $entrega)
    {
        //
    }
}
