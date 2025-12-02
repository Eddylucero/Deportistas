<?php

namespace App\Http\Controllers;
use App\Models\Pais;

use Illuminate\Http\Request;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = Pais::all();
        return view('paises.index', compact('paises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paises.nuevopais');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombrepais' => 'required|min:2|max:100'
        ]);
        $nombre = strtolower(trim($request->nombrepais));

        $existe = Pais::whereRaw('LOWER(nombrepais) = ?', [$nombre])->first();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['nombrepais' => 'El país ya está registrado.'])
                ->withInput();
        }

        Pais::create([
            'nombrepais' => trim($request->nombrepais),
        ]);

        return redirect()->route('paises.index')
            ->with('success', 'País registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pais = Pais::findOrFail($id);
        return view('paises.editarpais', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nombre = trim($request->nombrepais);
        $existe = Pais::whereRaw('LOWER(nombrepais) = ?', [strtolower($nombre)])
                    ->where('idpais', '!=', $id)
                    ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['nombrepais' => 'El país ya existe en la base de datos.'])
                ->withInput();
        }

        $pais = Pais::findOrFail($id);
        $pais->nombrepais = $nombre;
        $pais->save();

        return redirect()->route('paises.index')
                        ->with('success', 'País actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pais = Pais::findOrFail($id);

        if ($pais->deportistas()->count() > 0) {
            return redirect()->route('paises.index')
                ->with('error', 'No se puede eliminar el país porque tiene deportistas registrados.');
        }

        $pais->delete();

        return redirect()->route('paises.index')
            ->with('success', 'País eliminado correctamente.');
    }
}
