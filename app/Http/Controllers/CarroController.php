<?php

namespace App\Http\Controllers;

use App\Mail\AvisoPromocao;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Carro;
use App\Marca;
use App\Cliente;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CarroController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return redirect('/');
        }
        $carros = Carro::paginate(5);
        return view('interno.carros_list', compact('carros'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        // indica inclusão
        $acao = 1;
        // obtém as marcas para exibir no form de cadastro
        $marcas = Marca::orderBy('nome')->get();
        return view('interno.carros_form', compact('acao', 'marcas'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'modelo' => 'required|unique:carros|min:2|max:60',
            'cor' => 'required|min:4|max:40',
            'ano' => 'required|numeric|min:1970|max:2020',
            'preco' => 'required'
        ]);
        // recupera todos os campos do formulário
        $dados = $request->all();
        // insere os dados na tabela
        $car = Carro::create($dados);
        if ($car) {
            return redirect()->route('carros.index')
                ->with('status', $request->modelo . ' Incluído!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        // obtém os dados do registro a ser editado 
        $reg = Carro::find($id);
        // obtém as marcas para exibir no form de cadastro
        $marcas = Marca::orderBy('nome')->get();
        // indica ao form que será alteração
        $acao = 2;
        return view('interno.carros_form', compact('reg', 'acao', 'marcas'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'modelo' => ['required', 'unique:carros,modelo,' . $id, 'min:2', 'max:60'],
            'cor' => 'required|min:4|max:40',
            'ano' => 'required|numeric|min:1970|max:2020',
            'preco' => 'required'
        ]);
        $reg = Carro::find($id);
        $dados = $request->all();
        $alt = $reg->update($dados);
        if ($alt) {
            return redirect()->route('carros.index')
                ->with('status', $request->modelo . ' Alterado!');
        }
    }

    public function destroy($id)
    {
        $carro = Carro::find($id);
        if ($carro->delete()) {
            return redirect()->route('carros.index')
                ->with('status', $carro->modelo . ' Excluído!');
        }
    }

    public function foto($id)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        // obtém os dados do registro a ser exibido
        $reg = Carro::find($id);
        // obtém as marcas para exibir no form de cadastro
        $marcas = Marca::orderBy('nome')->get();
        return view('interno.carros_foto', compact('reg', 'marcas'));
    }

    public function storefoto(Request $request)
    {

        // recupera todos os campos do formulário
        $dados = $request->all();
        $id = $dados['id'];

        if (isset($dados['foto'])) {
            $fotoId = $id . '.jpg';
            $request->foto->move(public_path('fotos'), $fotoId);
        }

        return redirect()->route('carros.index')
            ->with('status', $request->modelo . ' com Foto Cadastrada!');
    }

    public function destaque(Request $request, $id)
    {
        $car = Carro::find($id);
        $destaque = $request->all();
        $reg = $car->update($destaque);


        return redirect()->route("carros.index");
    }

    public function pesq()
    {
        // se não estiver autenticado, redireciona para login
        if (!Auth::check()) {
            return redirect('/');
        }
        $carros = Carro::paginate(3);
        return view('interno.carros_pesq', compact('carros'));
    }

    public function filtro(Request $request)
    {
        // obtém dados do form de pesquisa
        $modelo = $request->modelo;
        $precomax = $request->precomax;

        $cond = array();

        if (!empty($modelo)) {
            array_push($cond, array('modelo', 'like', '%' . $modelo . '%'));
        }

        if (!empty($precomax)) {
            array_push($cond, array('preco', '<=', $precomax));
        }
        $carros = Carro::where($cond)
            ->orderBy('modelo')->paginate(3);
        return view('interno.carros_pesq', compact('carros'));
    }

    public function filtro2(Request $request)
    {
        // obtém dados do form de pesquisa
        $modelo = $request->modelo;
        $precomax = $request->precomax;
        if (empty($precomax)) {
            $carros = Carro::where('modelo', 'like', '%' . $modelo . '%')
                ->orderBy('modelo')->paginate(3);
        } else {
            $carros = Carro::where('modelo', 'like', '%' . $modelo . '%')
                ->where('preco', '<=', $precomax)
                ->orderBy('modelo')->paginate(3);
        }
        return view('interno.carros_pesq', compact('carros'));
    }

    public function graf()
    {
        $carros = DB::table('carros')
            ->join('marcas', 'carros.marca_id', '=', 'marcas.id')
            ->select('marcas.nome as marca', DB::raw('count(*) as num'))
            ->groupBy('marcas.nome')
            ->get();

        return view('interno.carros_graf', compact('carros'));
    }

    public function grafProposta()
    {
        $graf = DB::table('carros')
            ->join('propostas', 'carros.id', '=', 'propostas.idCarro')
            ->select('carros.modelo as modelo', DB::raw('count(*) as num'))
            ->groupBy('carros.modelo')
            ->get();

        return view('interno.carros_grafprop', compact('graf'));
    }


    public function relatorio()
    {
        $relatorio = DB::table('carros')
            ->join('propostas', 'carros.id', '=', 'propostas.idCarro')
            ->join('clientes', 'propostas.id', '=', 'clientes.idProposta')
            ->select('carros.modelo as modelo', 'propostas.valor as valor', 'clientes.id as id', 'clientes.telefone as fone', 'clientes.nome as nome', 'clientes.email as email')
            ->get();

        return view('interno.vendas_relatorios', compact('relatorio'));

    }

    public function mensagemEmail($id)
    {
        $cliente = Cliente::find($id);
        return view('mail.mensagem', compact('cliente'));
    }


    public function enviaMensagem(Request $request)
    {
        $destinatario = "alexandrep.schmidt@gmail.com";
        Mail::to($destinatario)->send(new AvisoPromocao());
    }
}
