@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">* Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $tenant->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="logo">Logo:</label>
    <input type="file" name="logo" class="form-control">
</div>
<div class="form-group">
    <label for="email">* Email:</label>
    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $tenant->email ?? old('email') }}">
</div>
<div class="form-group">
    <label for="cnpj">* CNPJ:</label>
    <input type="number" name="cnpj" class="form-control" placeholder="CNPJ" value="{{ $tenant->cnpj ?? old('cnpj') }}">
</div>
<div class="form-group">
    <label for="active">* Ativo?</label>
    <select name="active" class="form-control">
        <option value="Y" @if (isset($tenant) && $tenant->active == 'Y') selected @endif > Sim</option>
        <option value="N" @if (isset($tenant) && $tenant->active == 'N') selected @endif >Não</option>
    </select>
</div>
<hr>
<h3>Assinatura</h3>
<div class="form-group">
    <label for="subscription">* Data Assinatura (Início):</label>
    <input type="date" name="subscription" class="form-control" placeholder="Data Assinatura" value="{{ $tenant->subscription ?? old('subscription') }}">
</div>
<div class="form-group">
    <label for="expires_at">* Expira (final):</label>
    <input type="date" name="expires_at" class="form-control" placeholder="Expira" value="{{ $tenant->expires_at ?? old('expires_at') }}">
</div>
<div class="form-group">
    <label for="subscription_id">* Identificador:</label>
    <input type="text" name="subscription_id" class="form-control" placeholder="Identificador" value="{{ $tenant->subscription_id ?? old('subscription_id') }}">
</div>
<div class="form-group">
    <label for="subscription_active">* Assinatura Ativo?</label>
    <select name="subscription_active" class="form-control">
        <option value="1" @if (isset($tenant) && $tenant->subscription_active) selected @endif > Sim</option>
        <option value="0" @if (isset($tenant) && $tenant->subscription_active) selected @endif >Não</option>
    </select>
</div>
<div class="form-group">
    <label for="subscription_suspended">* Assinatura Cancelada?</label>
    <select name="subscription_suspended" class="form-control">
        <option value="1" @if (isset($tenant) && $tenant->subscription_suspended) selected @endif > Sim</option>
        <option value="0" @if (isset($tenant) && $tenant->subscription_suspended) selected @endif >Não</option>
    </select>
</div>
<div class="form-group">
   <button type="submit" class="btn btn-success">Salvar</button>
</div>