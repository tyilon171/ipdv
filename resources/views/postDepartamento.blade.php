@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{$departamento != null ? "Editar " : "Novo "}}{{ __('Departamento') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="frmDepartamento">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="/postDepartamento" data-after="{{$departamento != null ? "reload" : "home"}}" data-tipo="1">
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    @csrf
                                                    <label class="col-form-label" for="departamentoNome">Nome</label>
                                                    <input class="form-control" id="departamentoNome" name="nome" value="{{$departamento != null ? $departamento->nome : ""}}" required>
                                                    <input type="hidden" id="id" name="idDepart" value="{{$departamento != null ? $departamento->id : ""}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label class="col-form-label" for="departamentoCentro">Centro de Custos</label>
                                                    <select class="form-control" id="departamentoCentro" name="centro" required>
                                                        @foreach($centros as $centro)
                                                            <option value="{{$centro->id}}" {{$departamento != null && $centro->id == $departamento->centroCusto->id ? "selected" : null}}>{{$centro->nome}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6 text-left">
                                                    @if($departamento != null)
                                                        <button type="button" onclick="location.href = '{{route('departamento')}}'" class="btn btn-primary btnNew">Novo</button>
                                                    @endif
                                                </div>

                                                <div class="col-md-6 text-right">
                                                    <button type="button" class="btn btn-success btnSave">Salvar</button>
                                                    @if($departamento != null)
                                                        <button type="button" class="btn btn-danger btnDel">Apagar</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Lista de Departamentos') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <th scope="col">Nome</th>
                                        <th scope="col">Centro de custos</th>
                                        <th scope="col">Ação</th>
                                    </thead>
                                    <tbody>
                                        @foreach($listaDepartamentos as $item)
                                            <tr>
                                                <td>{{$item->nome}}</td>
                                                <td>{{$item->centroCusto->nome}}</td>
                                                <td>
                                                    <a href="{{route('departamento', $item->id)}}">Editar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
