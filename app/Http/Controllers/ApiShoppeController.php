<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Requests\StoreProduto;
use App\Models\Produtos;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiShoppeController extends Controller
{

    public function index()
    {
        dd('teste');
        return view('pages.formulario');
    }

    public function store()
    {
      try{

            // Log::info('Importação finalizada! Produtos importados: '.$importados);

        } catch (Exception $ex) {
            // Log::error('Erro de importação: '.$ex->getMessage(). ' Produtos importados: '.$importados);
        }

    }
}
