@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Listagem de usuários') }}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="cbCentro">Centro de custos</label>
                                    <select id="cbCentro" class="form-control" name="cbCentro">
                                        <option value="0">Selecione um centro de custos</option>
                                        @foreach($centros as $centro)
                                            <option value="{{$centro->id}}">{{$centro->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="cbDepartamento">Departamento</label>
                                    <select id="cbDepartamento" class="form-control" name="cbDepartamento">
                                        <option value="0">Selecione um departamento</option>

                                    </select>
                                </div>
                                @csrf
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success" onclick="getUsuarios()">Filtrar</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <th scope="col">Nome</th>
                                            <th scope="col">Cargo</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pageJs')
    <script type="text/javascript" src="{{asset('js/home.js')}}"></script>
@endsection
