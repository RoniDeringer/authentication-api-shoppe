<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
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
        try {
            //validações CPF e CNPJ
            if ($request->cpf) {
                $cpf = str_replace(array(".", "-"), "", $request->cpf);
                if ($this->verifyExistsCpf($cpf)) {
                    return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'CPF Já existe!', 'response' => $this->createJson(409, 'CPF Já existe na base de dados.')]);
                };
                if ($this->verifySizeCpf($cpf)) {
                    return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'Formato inválido de CPF', 'response' => $this->createJson(400, 'Formato inválido de CPF, necessário 11 caracteres.')]);

                    return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'Formato inválido de CPF', 'response' => $this->createJson(400, 'Formato inválido de CPF, necessário 11 caracteres.')]);
                }
            } else {
                $cnpj = str_replace(array(".", "-", "/"), "", $request->cnpj);
                if ($this->verifyExistsCnpj($cnpj)) {
                    return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'CNPJ Já existe!', 'response' => $this->createJson(409, 'CNPJ Já existe na base de dados.')]);
                };
                if ($this->verifySizeCnpj($cnpj)) {
                    return redirect()->back()->with(['type' => 'alert-danger', 'message' => 'Formato inválido de CNPJ', 'response' => $this->createJson(400, 'Formato inválido de CNPJ, necessário 14 caracteres.')]);
                }
            }

            $user = new User();
            $user->nome = $request->nome;
            $user->email = $request->email;
            $user->tipo_pessoa = $request->tipo;
            $cpfCnpj = $request->cpf ?: $request->cnpj;
            $user->cpf_cnpj = str_replace(array(".", "-", "/"), "", $cpfCnpj);
            $user->save();

            return back()->with(['type' => 'alert-success', 'message' => 'Usuário cadastrado com sucesso!', 'response' => $this->createJson(201, 'Usuário criado com sucesso.')]);
        } catch (Exception $ex) {
            Log::error('Erro ao criar usuário: ' . $ex->getMessage());
            return back()->with(['type' => 'alert-danger', 'message' => 'Erro! Tente novamente mais tarde.', 'response' => $this->createJson(500, 'Erro na inserção de usuário.')]);
        }
    }

    private function verifySizeCpf($cpf)
    {
        if (strlen($cpf) == 11) {
            return false;
        }
        return true;
    }

    private function verifySizeCnpj($cnpj)
    {
        if (strlen($cnpj) == 14) {
            return false;
        }
        return true;
    }

    private function verifyExistsCpf($cpf)
    {
        if (User::where('cpf_cnpj', $cpf)->exists()) {
            return true;
        }
        return false;
    }

    private function verifyExistsCnpj($cnpj)
    {
        if (User::where('cpf_cnpj', $cnpj)->exists()) {
            return true;
        }
        return false;
    }

    private function createJson($code, $msg)
    {
        return [
            'status_code' => $code,
            'response' =>
            [
                'status' => $msg,
                'data' => date('d/m/Y H:i:s')
            ]
        ];
    }
}
