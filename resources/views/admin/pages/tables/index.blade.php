@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>
    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-dark">ADD <i class="fas fa-plus"></i></a></h1>    
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tables.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Identify</th>
                        <th>Descrição</th>
                        <th width=250>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>
                                {{ $table->identify }}
                            </td>
                            <td>
                                {{ $table->description }}
                            </td>
                            <td style="width=10px;">
                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('tables.qrcode', $table->identify) }}" target="_blank" class="btn btn-dark">
                                    <i class="fas fa-qrcode"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tables->appends($filters)->links() !!}
            @else
                {!! $tables->links() !!}
            @endif
        </div>
    </div>
@stop
