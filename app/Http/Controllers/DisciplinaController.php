<?php

namespace App\Http\Controllers;
use App\Models\Disciplina;

use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disciplinas = Disciplina::all();
        return view('disciplinas.index', compact('disciplinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('disciplinas.nuevadisciplina');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombredisciplina' => 'required|min:2|max:100'
        ]);

        $nombre = strtolower(trim($request->nombredisciplina));

        $existe = Disciplina::whereRaw('LOWER(nombredisciplina) = ?', [$nombre])->first();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['nombredisciplina' => 'La disciplina ya está registrada.'])
                ->withInput();
        }

        Disciplina::create([
            'nombredisciplina' => trim($request->nombredisciplina),
        ]);

        return redirect()->route('disciplinas.index')
            ->with('success', 'Disciplina registrada correctamente.');
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
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplinas.editardisciplina', compact('disciplina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nombre = trim($request->nombredisciplina);

        $existe = Disciplina::whereRaw('LOWER(nombredisciplina) = ?', [strtolower($nombre)])
                            ->where('iddisciplina', '!=', $id)
                            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['nombredisciplina' => 'La disciplina ya existe en la base de datos.'])
                ->withInput();
        }

        $disciplina = Disciplina::findOrFail($id);
        $disciplina->nombredisciplina = $nombre;
        $disciplina->save();

        return redirect()->route('disciplinas.index')
                        ->with('success', 'Disciplina actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disciplina = Disciplina::findOrFail($id);

        if ($disciplina->deportista()->count() > 0) {
            return redirect()->route('disciplinas.index')
                ->with('error', 'No se puede eliminar la disciplina porque tiene deportistas registrados.');
        }

        $disciplina->delete();

        return redirect()->route('disciplinas.index')
            ->with('success', 'Disciplina eliminada correctamente.');
    }
}
