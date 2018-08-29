<option value="">-- Select value --</option>
@if(isset($territories) && count($territories) > 0)
    @foreach($territories as $territory)
        <option value="{{ $territory->ter_id }}">{{ $territory->ter_name }}</option>
    @endforeach
@else
    <option value="-1">Нет районов</option>
@endif