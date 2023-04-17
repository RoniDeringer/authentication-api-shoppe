@extends('layouts.app')

@section('style')
    <style>
    </style>
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-primary w-100 btn-icon"  style="font-size: 18px;">
                    <span class="btn-inner--icon"><i class="material-icons mb-2" style="font-size: 3rem">assignment</i></span><br>
                    <span class="btn-inner--text">Formulário</span>
                </button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary w-100 btn-icon"  style="font-size: 18px;">
                    <span class="btn-inner--icon "><i class="material-icons mb-2"style="font-size: 3rem">settings</i></span><br>
                    <span class="btn-inner--text">API Shoppe</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        //
    });
</script>
