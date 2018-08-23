<select name="{{ $name }}" id="{{ $id }}">
    @if(isset($territories) && is_array($territories))
        @foreach($territories as $territory)
            <option value="{{ $territory->ter_id }}">{{ $territory->ter_name }}</option>
        @endforeach
    @endif
</select>