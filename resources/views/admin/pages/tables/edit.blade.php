@extends('adminlte::page')

@section('title', "Editar mesa {$table->identify}")

@section('content_header')
    <h1>Editar mesa {{ $table->identify }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="post">
                @csrf
                @method('PUT')
                
                @include('admin.pages.tables._partials.form')
            </form> 
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop
