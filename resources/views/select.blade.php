@if(isset($territories))
    <option value="">-- Select value --</option>
    @foreach($territories as $territory)
        <option value="{{ $territory->ter_id }}">{{ $territory->ter_name }}</option>
    @endforeach
@endif