@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{$user != null ? "Editar " : "Novo "}}{{ __('User') }}
                        &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<button class="btn btn-warning" data-toggle="modal" data-target="#importador">Importar</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="frmUser">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="/postUser" data-after="{{$user != null ? "reload" : "home"}}" data-tipo="3">
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    @csrf
                                                    <label class="col-form-label" for="userNome">Nome</label>
                                                    <input class="form-control" id="userNome" name="nome" value="{{$user != null ? $user->name : ""}}" required>
                                                    <input type="hidden" id="id" name="idUser" value="{{$user != null ? $user->id : ""}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label class="col-form-label" for="userEmail">E-mail</label>
                                                    <input class="form-control" id="userEmail" name="email" value="{{$user != null ? $user->email : ""}}" required>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label class="col-form-label" for="userCargo">Cargo</label>
                                                    <select class="form-control" id="userCargo" name="cargo" required>
                                                        @foreach($cargos as $cargo)
                                                            <option value="{{$cargo->id}}" {{$user != null && $cargo->id == $user->cargo->id ? "selected" : null}}>{{$cargo->nome}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6 text-left">
                                                    @if($user != null)
                                                        <button type="button" onclick="location.href = '{{route('usuario')}}'" class="btn btn-primary btnNew">Novo</button>
                                                    @endif
                                                </div>

                                                <div class="col-md-6 text-right">
                                                    <button type="button" class="btn btn-success btnSave">Salvar</button>
                                                    @if($user != null)
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
                        {{ __('Lista de Usuários') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <th scope="col">Nome</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Ação</th>
                                    </thead>
                                    <tbody>
                                        @foreach($listaUsers as $item)
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->cargo->nome}}</td>
                                                <td>
                                                    <a href="{{route('usuario', $item->id)}}">Editar</a>
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

    <div class="modal" id="importador" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Importar Usuários</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <form id="frmImportador">
                            @csrf
                            <div class="col-md-12">
                                <label class="col-form-label" for="import">Selecione um arquivo</label>
                                <input type="file" id="import" name="import">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnImportar">Enviar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
