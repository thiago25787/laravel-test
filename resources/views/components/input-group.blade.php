@props(['label', 'tooltip', 'required' => true])

<fieldset x-data="{ tooltipOpen: false }">
    <div class="flex flex-row justify-between">
        <legend class="block text-sm font-medium text-gray-700">
            {{ __($label) }} 
            @if ($required === false)
                <p class="inline text-xs italic text-gray-300">- {{ __('Optional') }}</p>
            @endif
        </legend>

        <div 
            x-on:mouseenter="tooltipOpen = true"
            x-on:mouseleave="tooltipOpen = false"
            class="relative cursor-pointer">
            <x-icons.question-mark-circle class="z-10 w-4 h-4 text-gray-500" />

            <div
                x-show="tooltipOpen"
                x-transition:enter="transition-transform transition-opacity ease-out duration-500"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-end="opacity-0 transform -translate-y-3"
                class="absolute right-0 z-20 p-4 mt-2 text-sm text-white transition duration-500 ease-in-out bg-gray-700 rounded-md w-96">
                {{ __($tooltip) }}
            </div>
        </div>
    </div>
    <div class="mt-1">
        {{ $input }}
    </div>
</fieldset>
