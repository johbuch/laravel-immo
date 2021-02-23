@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="alert alert-success">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
