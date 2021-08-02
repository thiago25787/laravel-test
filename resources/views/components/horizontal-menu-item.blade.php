<div>
    @if ($active)
        <a href="{{ $href }}" class="flex flex-row justify-center col-span-1 px-5 py-3 space-x-2 text-sm text-gray-200 transition duration-500 ease-in-out border-b border-green-300 hover:border-green-600">
            {{-- <x-dynamic-component class="w-5 h-5" :component="$icon" /> --}}
            <span>{{ $text }}</span>
        </a>
    @else
        <a href="{{ $href }}" class="flex flex-row justify-center col-span-1 px-5 py-3 space-x-2 text-sm text-gray-200 transition duration-500 ease-in-out border-b border-transparent hover:text-white hover:border-green-600">
            {{-- <x-dynamic-component class="w-5 h-5" :component="$icon" /> --}}
            <span>{{ $text }}</span>
        </a>
    @endif
</div>