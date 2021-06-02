@include('admin.includes.alerts')

<div class="form-group">
    <label for="identify">Identificação:</label>
    <input type="text" name="identify" class="form-control" placeholder="Identificação" value="{{ $table->identify ?? old('identify') }}">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea name="description" class="form-control" ols="30" rows="5" placeholder="Descrição">{{ $table->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
   <button type="submit" class="btn btn-success">Salvar</button>
</div>