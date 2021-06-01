@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">* Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $product->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="image">* Imagem:</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label for="price">* Price:</label>
    <input type="text" name="price" class="form-control" value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group">
    <label for="description">* Descrição:</label>
    <textarea name="description" class="form-control" ols="30" rows="5" placeholder="Descrição">{{ $product->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
   <button type="submit" class="btn btn-success">Salvar</button>
</div>