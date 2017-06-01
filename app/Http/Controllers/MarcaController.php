<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use Illuminate\Support\Facades\Auth;

class MarcaController extends Controller {

    public function index() {
        if (!Auth::check()) {
            return redirect('/admin');
        }
        $marcas = Marca::all();
        return view('interno.marcas_list', compact('marcas'));
    }

    public function create() {
        if (!Auth::check()) {
            return redirect('/admin');
        }
        $acao = 1;

        return view('interno.marcas_form', compact('acao'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'nome' => 'required|unique:marcas|min:2|max:60'
        ]);
        $dados = $request->all();
        $reg = Marca::create($dados);
        
        if ($reg) {
            return redirect()->route('marcas.index')->with('status', $request->nome . ' incluido.');
        }
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        if (!Auth::check()) {
            return redirect('/admin');
        }
        $marca = Marca::find($id);
        $acao = 2;
        
        return view('interno.marcas_form', compact('marca', 'acao'));
    }

    public function update(Request $request, $id) {
        $alt = Marca::find($id);
        $marca = $request->all();
        $reg = $alt->update($marca);
        
        return redirect()->route('marcas.index')->with('status', $request->nome . ' editado com sucesso');
    }

    public function destroy($id) {
        $marca = Marca::destroy($id);
        if($marca){
        
            return redirect()->route('marcas.index')->with('status', 'Marca Excluida');
            
        }
    }

}
