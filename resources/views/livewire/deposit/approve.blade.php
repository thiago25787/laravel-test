<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight justify-between">
            <div>{{__("Approve deposit")}}</div>
        </h2>
    </x-slot>
    <div class="py-2">
        @if($deposits && $deposits->count() > 0)
            <div id="table" class="min-w-full overflow-x-auto bg-white shadow-xl sm:rounded-lg ml-12 mr-3">
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">{{__("User")}}</th>
                        <th class="px-4 py-2">{{__("Amount")}}</th>
                        <th class="px-4 py-2">{{__("Date")}}</th>
                        <th class="px-4 py-2">{{__("Image")}}</th>
                        <th class="px-4 py-2">{{__("Aprove/Deny")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deposits as $deposit)
                        <tr>
                            <td class="border px-4 py-2">{{ $deposit->account->user->name }}</td>
                            <td class="border px-4 py-2">{{ $deposit->amount }}</td>
                            <td class="border px-4 py-2">{{ $deposit->created_at }}</td>
                            <td class="border px-4 py-2">
                                <a wire:click="modalImage({{$deposit}})" class="flex items-center justify-center">
                                    <img src="{{$deposit->image_path}}" width="100" height="100" />
                                </a>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <x-jet-secondary-button class="ml-2" wire:click="modal({{$deposit}})">{{__("Aprove/Deny")}}</x-jet-secondary-button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $deposits->links() }}
            </div>
        @else
            <section class="flex flex-wrap md:flex-nowrap items-center justify-center bg-gray-200 shadow-lg rounded-2xl py-6 md:py-4 px-6 md:pr-5 space-y-4 md:space-y-0 md:space-x-8 mr-3 ml-6">
                {{ __('No itens found') }}
            </section>
        @endif
    </div>

    <x-jet-confirmation-modal wire:model="modal">
        <x-slot name="title">
            {{ __('Do you want approve this deposit?') }}
        </x-slot>

        <x-slot name="content">

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deny" wire:loading.attr="disabled">
                {{ __('Deny') }}
            </x-jet-danger-button>

            <x-jet-button class="ml-2" wire:click="approve" wire:loading.attr="disabled">
                {{ __('Approve') }}
            </x-jet-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <x-jet-dialog-modal wire:model="modalImage">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            <div class="flex items-center justify-center">
                <img src="{{$image}}" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalImage')" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
