@extends('adminlte::page')

@section('title', "Editar empresa {$tenant->name}")

@section('content_header')
    <h1>Editar empresa {{ $tenant->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.update', $tenant->id) }}" class="form" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                @include('admin.pages.tenants._partials.form')
            </form> 
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
