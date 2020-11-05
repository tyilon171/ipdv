@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{$centro != null ? "Editar " : "Novo "}}{{ __('Centro de custos') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="frmCentro">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="/postCentro" data-after="{{$centro != null ? "reload" : "home"}}" data-tipo="0">
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    @csrf
                                                    <label class="col-form-label" for="centroNome">Nome</label>
                                                    <input class="form-control" id="centroNome" name="nome" value="{{$centro != null ? $centro->nome : ""}}" required>
                                                    <input type="hidden" id="id" name="idCentro" value="{{$centro != null ? $centro->id : ""}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6 text-left">
                                                    @if($centro != null)
                                                        <button type="button" onclick="location.href = '{{route('centroCusto')}}'" class="btn btn-primary btnNew">Novo</button>
                                                    @endif
                                                </div>

                                                <div class="col-md-6 text-right">
                                                    <button type="button" class="btn btn-success btnSave">Salvar</button>
                                                    @if($centro != null)
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
                        {{ __('Lista de Centro de custos') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <th scope="col">Nome</th>
                                        <th scope="col">Ação</th>
                                    </thead>
                                    <tbody>
                                        @foreach($listaCentros as $item)
                                            <tr>
                                                <td>{{$item->nome}}</td>
                                                <td>
                                                    <a href="{{route('centroCusto', $item->id)}}">Editar</a>
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
