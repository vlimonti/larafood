@extends('adminlte::page')

@section('title', "Editar permissão {{ $permission->name }}")

@section('content_header')
    <h1>Editar permissão {{ $permission->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="post">
                @csrf
                @method('PUT')
                
                @include('admin.pages.permissions._partials.form')
            </form> 
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
