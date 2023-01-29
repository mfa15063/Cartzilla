    @foreach ($cities as $item)
        <option @if (Auth::user()->city_id == $item->id) selected @endif
            value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
