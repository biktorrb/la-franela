<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            @foreach ($headers as $header)
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse ($data as $item)
            <tr class="{{ $striped && $loop->even ? 'bg-gray-50' : '' }} {{ $hoverable ? 'hover:bg-gray-100' : '' }}">
                @foreach ($rows as $col)
                    <td class="px-6 py-4 whitespace-nowrap">
                        {!! is_callable($col) ? $col($item) : e($col) !!}
                    </td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headers) }}" class="px-6 py-4 text-center text-gray-500">
                    No hay datos disponibles.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>