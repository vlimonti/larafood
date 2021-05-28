@extends('adminlte::page')

@section('title', "Editar Perfil {{ $profile->name }}")

@section('content_header')
    <h1>Editar Perfil {{ $profile->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update', $profile->id) }}" class="form" method="post">
                @csrf
                @method('PUT')
                
                @include('admin.pages.profiles._partials.form')
            </form> 
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
