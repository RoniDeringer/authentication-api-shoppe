@extends('layouts.app')

@section('style')
    <style>
    </style>
@endsection

@section('content')
    <div class="col-10 mx-auto text-center">
        <div class="row">
           
            <div class="col-5">
                <a  href="{{route('formulario')}}">
                    <button type="button"  class="btn btn-primary w-100 btn-icon"  style="font-size: 18px;">
                        <span class="btn-inner--icon"><i class="material-icons mb-2" style="font-size: 3rem">assignment</i></span><br>
                        <span class="btn-inner--text">Formulário</span>
                    </button>
                </a>
            </div>

            <div class="col-5">
                <a  href="{{route('api-shopee')}}">
                    <button type="button" class="btn btn-primary w-100 btn-icon"  style="font-size: 18px;">
                        <span class="btn-inner--icon "><i class="material-icons mb-2"style="font-size: 3rem">settings</i></span><br>
                        <span class="btn-inner--text">API Shopee</span>
                    </button>
                </a>
            </div>

        </div>
    </div>
@endsection
