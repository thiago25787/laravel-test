<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__("Deposits")}}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="mb-6 mt-4 mr-3 flex justify-end">
            <x-jet-button wire:click="adding()">
                {{__("New deposit")}}
            </x-jet-button>
        </div>
        @if($deposits && $deposits->count() > 0)
            <div id="table" class="min-w-full overflow-x-auto bg-white shadow-xl sm:rounded-lg ml-12 mr-3">
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2">{{_("Amount")}}</th>
                            <th class="border px-4 py-2">{{__("Date")}}</th>
                            <th class="border px-4 py-2">{{__("Approved?")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deposits as $deposit)
                            <tr>
                                <td class="border px-4 py-2">{{ $deposit->amount }}</td>
                                <td class="border px-4 py-2">{{ $deposit->created_at }}</td>
                                <td class="border px-4 py-2">{{ $deposit->status }}</td>
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

    <x-jet-dialog-modal wire:model="adding">
        <x-slot name="title">
            {{ __('New deposit') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <x-jet-validation-errors class="mb-4" />
                <div>
                    <x-jet-label for="amount" value="{{ __('Amount') }}" />
                    <x-jet-input id="amount" class="block mt-1 w-full" type="number" name="amount" wire:model="amount" required autofocus />
                </div>
                <div>
                    <x-jet-label for="image" value="{{ __('Image') }}" />
                    <x-jet-input id="image" class="block mt-1 w-full" type="file" name="image" wire:model.debouce.200ms="image" required />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('adding')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>
            @if($canBeSubmitted)
                <x-jet-button class="ml-2" wire:click="add" wire:loading.attr="disabled">
                    {{ __('Sure') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
