<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Requests\StoreProduto;
use App\Models\Produtos;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormularioController extends Controller
{

    public function index()
    {
        return view('pages.formulario');
    }

    public function store(Request $request)
    {
      try{

        // if(user::where('cpf_cnpj', $request->cpf)->exists()){
            return back()->with(['type' => 'alert-danger', 'message' => 'CPF Já existe!']);
        // }

        if(user::where('cpf_cnpj', $request->cnpj)->exists()){
            return back()->with(['type' => 'alert-danger', 'message' => 'CNPJ Já existe!']);
        }

        

        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->tipo = $request->tipo;
        $user->cpf_cnpj = $request->cpf ?: $request->cnpj;



            // Log::info('Importação finalizada! Produtos importados: '.$importados);

        } catch (Exception $ex) {
            // Log::error('Erro de importação: '.$ex->getMessage(). ' Produtos importados: '.$importados);
        }

    }
}
