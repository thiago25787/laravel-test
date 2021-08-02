<div class="px-5">
    <x-jet-dropdown align="center" width="96">
        <x-slot name="trigger">
            <div class="px-4 flex flex-row justify-center col-span-1 py-3 text-sm text-gray-200 align-middle transition duration-500 ease-in-out border-b {{ $active ? 'border-b border-green-300' : 'border-transparent' }} cursor-pointer hover:text-white hover:border-green-600">
                <div class="flex flex-row justify-between space-x-2">
                    <span>{{ $text }}</span>
                    <x-icons.chevron-down class="w-4 h-4 " />
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            {{ $slot }}
        </x-slot>
    </x-jet-dropdown>
</div>