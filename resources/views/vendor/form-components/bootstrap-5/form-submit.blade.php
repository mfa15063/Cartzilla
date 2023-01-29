<button
    {!! $attributes->merge([
        'class' => 'btn btn-success',
        'type' => 'submit'
    ]) !!}
>
    {!! trim($slot) ?: __('Submit') !!}
</button>
