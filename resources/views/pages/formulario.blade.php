@extends('layouts.app')

@section('style')
    <style>
    </style>
@endsection

@section('content')

    <div class="col-10 mx-auto text-center">
        <div class="card mt-5">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 float-start">
                    <i class="material-icons opacity-10">assignment</i>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="mb-0 d-flex justify-content-start">Formulário</h5>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="col-12">
                    <div class="card-body">
                        <form action="{{route('formulario-store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" name="nome" class="form-control" placeholder="Nome completo" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-5">
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" name="email" class="form-control" placeholder="Email" required>  
                                    </div>
                                </div>


                                {{-- colocar type email --}}




                                <div class="col-md-6 mb-5">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="tipo" class="ms-0"><strong>Tipo pessoa</strong></label>
                                        <select class="form-control" id="tipo" name="tipo" required>
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="pf">Pessoa Física</option>
                                            <option value="pj">Pessoa Jurídica</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 d-none mb-5" id="field-cpf">
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" required>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none mb-5" id="field-cnpj">
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn bg-gradient-primary btn-icon">
                                        <span class="btn-inner--icon"><i class="material-icons">check</i></span>
                                        <span class="btn-inner--text">Salvar</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function() {
        document.getElementById('tipo').addEventListener('change', function(e){
            if(e.target.value == 'pf'){
                document.querySelector('#field-cpf').classList.remove('d-none'); //deixar required
                document.querySelector('#field-cnpj').classList.add('d-none'); //deixar required
                document.getElementById('cpf').required  = true
                document.getElementById('cnpj').required = false

            } else {
                document.querySelector('#field-cnpj').classList.remove('d-none');
                document.querySelector('#field-cpf').classList.add('d-none');
                document.getElementById('cnpj').required  = true
                document.getElementById('cpf').required = false
            }
        });

        $('#cnpj').mask('00.000.000/0000-00');
        $('#cpf').mask('000.000.000-00');
    });

</script>
