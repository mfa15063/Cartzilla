@error($name, $bag)
    <div {!! $attributes->merge(['class' => 'alert alert-danger']) !!}>
        {{ $message }}
    </div>
@enderror
