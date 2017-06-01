<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Carro;
use App\Proposta;
use App\Cliente;



class SiteController extends Controller{

    public function index(){

        $destaque = Carro::all();
        $cont=0;
        for($i=0; $i<count($destaque);$i++){
            if ($destaque[$i]->destaque == "v") {
                $cont++;
            }
        }

        $lista = Carro::paginate(5);
        return view ('loja.index', compact('lista','destaque', 'cont'));
    }

    //Função que realiza a pesquisa pelo modelo requisitado
    public function pesquisa(Request $request){

        $lista = Carro::where('modelo', 'like', '%'. $request->modelo. '%')->get();;
        if($lista) {
            return view('loja.index', compact('lista'));
        }
    }

    //Chama o formulário para o cliente inserir os dados
    public function formPropostas($id){
        $carro = Carro::find($id);
        return view('loja.form_proposta', compact('carro'));
    }


     //Realiza propostaa
    public function Proposta(Request $request, $id){
        $val = str_replace('.', '', $request->valor);
        $valor = str_replace(',', '.', $val);

        $data = date('Y-m-d H:i:s');
        $idProp = DB::table('propostas')->insertGetId(
            ['valor' => "$valor", 'data' => "$data", 'idCarro' => "$id"]
        );

        DB::table('clientes')->insert(
            ['nome' => "$request->nome", 'email' => "$request->email", 'telefone' => "$request->telefone", 'idProposta' => "$idProp"]
        );

        return redirect()->route('site.index');


    }


}

