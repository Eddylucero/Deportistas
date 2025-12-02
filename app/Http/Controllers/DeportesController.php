<?php

namespace App\Http\Controllers;
use App\Models\Deportistas;
use App\Models\Pais;
use App\Models\Disciplina;

use Illuminate\Http\Request;

class DeportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deportistas = Deportistas::with(['pais', 'disciplina'])->get();
        return view('deportistas.index', compact('deportistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = Pais::all();
        $disciplinas = Disciplina::all();
        return view('deportistas.nuevodeportista', compact('paises', 'disciplinas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:150',
            'fechanacimiento' => 'required|date',
            'estatura' => 'required|numeric|min:50|max:300',
            'peso' => 'required|numeric|min:20|max:300',
            'idpais' => 'required',
            'iddisciplina' => 'required'
        ]);

        $nombre = strtolower(trim(preg_replace('/\s+/', ' ', $request->nombre)));

        $existe = Deportistas::whereRaw('LOWER(TRIM(nombre)) = ?', [$nombre])->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['nombre' => 'El deportista ya está registrado.'])
                ->withInput();
        }

        Deportistas::create([
            'nombre' => ucwords($nombre),
            'fechanacimiento' => $request->fechanacimiento,
            'estatura' => $request->estatura,
            'peso' => $request->peso,
            'idpais' => $request->idpais,
            'iddisciplina' => $request->iddisciplina
        ]);

        return redirect()->route('deportistas.index')
            ->with('success', 'Deportista registrado correctamente.');
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
    public function edit($id)
    {
        $deportista = Deportistas::findOrFail($id);

        $paises = \App\Models\Pais::all();
        $disciplinas = \App\Models\Disciplina::all();

        return view('deportistas.editardeportista', compact('deportista', 'paises', 'disciplinas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:150',
            'fechanacimiento' => 'required|date',
            'estatura' => 'required|numeric|min:50|max:300',
            'peso' => 'required|numeric|min:20|max:300',
            'idpais' => 'required|integer',
            'iddisciplina' => 'required|integer'
        ]);

        $nombreNormalizado = trim(preg_replace('/\s+/', ' ', $request->nombre));

        $existe = Deportistas::whereRaw('LOWER(REPLACE(nombre, "  ", " ")) = ?', 
                [strtolower($nombreNormalizado)])
            ->where('iddeportista', '!=', $id)
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['nombre' => 'Ya existe un deportista con este nombre.'])
                ->withInput();
        }

        $deportista = Deportistas::findOrFail($id);

        $deportista->update([
            'nombre' => $nombreNormalizado,
            'fechanacimiento' => $request->fechanacimiento,
            'estatura' => $request->estatura,
            'peso' => $request->peso,
            'idpais' => $request->idpais,
            'iddisciplina' => $request->iddisciplina
        ]);

        return redirect()->route('deportistas.index')
            ->with('success', 'Deportista actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deportista = Deportistas::findOrFail($id);
            $deportista->delete();

            return redirect()->route('deportistas.index')
                ->with('success', 'Deportista eliminado correctamente.');

        } catch (\Exception $e) {
            return redirect()->route('deportistas.index')
                ->with('error', 'No se pudo eliminar el deportista. Verifique relaciones o contacte soporte.');
        }
    }
}
