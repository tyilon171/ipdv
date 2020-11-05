@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{$cargo != null ? "Editar " : "Novo "}}{{ __('Cargo') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="frmCargo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="/postCargo" data-after="{{$cargo != null ? "reload" : "home"}}" data-tipo="2">
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    @csrf
                                                    <label class="col-form-label" for="cargoNome">Nome</label>
                                                    <input class="form-control" id="cargoNome" name="nome" value="{{$cargo != null ? $cargo->nome : ""}}" required>
                                                    <input type="hidden" id="id" name="idCargo" value="{{$cargo != null ? $cargo->id : ""}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label class="col-form-label" for="cargoDepartamento">Departamento</label>
                                                    <select class="form-control" id="cargoDepartamento" name="departamento" required>
                                                        @foreach($departamentos as $depart)
                                                            <option value="{{$depart->id}}" {{$cargo != null && $depart->id == $cargo->departamento->id ? "selected" : null}}>{{$depart->nome}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6 text-left">
                                                    @if($cargo != null)
                                                        <button type="button" onclick="location.href = '{{route('cargo')}}'" class="btn btn-primary btnNew">Novo</button>
                                                    @endif
                                                </div>

                                                <div class="col-md-6 text-right">
                                                    <button type="button" class="btn btn-success btnSave">Salvar</button>
                                                    @if($cargo != null)
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
                        {{ __('Lista de Cargos') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <th scope="col">Id</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Departamento</th>
                                        <th scope="col">Ação</th>
                                    </thead>
                                    <tbody>
                                        @foreach($listaCargos as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->nome}}</td>
                                                <td>{{$item->departamento->nome}}</td>
                                                <td>
                                                    <a href="{{route('cargo', $item->id)}}">Editar</a>
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
