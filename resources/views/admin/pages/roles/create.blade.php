@extends('adminlte::page')

@section('title', 'Cadastrar Nova Função')

@section('content_header')
    <h1>Cadastrar Nova Função </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" class="form" method="post">
                @csrf
                
                @include('admin.pages.roles._partials.form')
            </form> 
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
