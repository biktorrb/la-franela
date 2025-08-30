@props(['action', 'method' => 'POST', 'enctype' => null])

<form action="{{ $action }}" method="POST" {{ $enctype ? 'enctype=' . $enctype : '' }} {{ $attributes }}>
    @csrf
    @if (strtoupper($method) !== 'POST')
        @method($method)
    @endif

    {{ $slot }}
</form>