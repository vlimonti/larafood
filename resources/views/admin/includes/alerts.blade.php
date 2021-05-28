@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('message'))
    <div class="alrt alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session('error'))
    <div class="alrt alert-warning">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="alrt alert-info">
        {{ session('info') }}
    </div>
@endif