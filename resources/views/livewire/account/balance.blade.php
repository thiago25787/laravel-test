<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__("Balance")}}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="mb-6 mt-4 mr-3 flex justify-end">
            @if($account)
                <x-jet-secondary-button>
                    {{__("Amount")}} <span class="inline-flex items-center justify-center px-2 py-1 text-white text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full ml-2">{{$account->amount}}</span>
                </x-jet-secondary-button>
            @else
                <x-jet-button wire:click="creating()">
                    {{__("Create account")}}
                </x-jet-button>
            @endif
        </div>
        @if(($deposits && $deposits->count() > 0) || ($purchases && $purchases->count() > 0))
            <section class="mt-4 flex items-center justify-between">
                <div id="table" class="w-full overflow-x-auto bg-white shadow-xl sm:rounded-lg ml-12 mr-3 flex flex-col">
                    <h2 class="border px-4 py-2 flex items-center justify-center bg-red-600 text-white"><strong>{{__("Last 10 deposits")}}</strong></h2>
                    @if($deposits->count() > 0)
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
                    @else
                        <section class="flex flex-wrap md:flex-nowrap items-center justify-center bg-gray-200 shadow-lg rounded-2xl py-6 md:py-4 px-6 md:pr-5 space-y-4 md:space-y-0 md:space-x-8">
                            {{ __('No itens found') }}
                        </section>
                    @endif
                </div>
                <div id="table" class="w-full overflow-x-auto bg-white shadow-xl sm:rounded-lg ml-12 mr-3 flex flex-col">
                    <h2 class="border px-4 py-2 flex items-center justify-center bg-indigo-500 text-white"><strong>{{__("Last 10 pucharses")}}</strong></h2>
                    @if($purchases->count() > 0)
                        <table class="table-fixed w-full">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2">{{_("Description")}}</th>
                                    <th class="px-4 py-2">{{__("Amount")}}</th>
                                    <th class="px-4 py-2">{{__("Date")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $purchase->description }}</td>
                                        <td class="border px-4 py-2">{{ $purchase->amount }}</td>
                                        <td class="border px-4 py-2">{{ $purchase->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <section class="flex flex-wrap md:flex-nowrap items-center justify-center bg-gray-200 shadow-lg rounded-2xl py-6 md:py-4 px-6 md:pr-5 space-y-4 md:space-y-0 md:space-x-8">
                            {{ __('No itens found') }}
                        </section>
                    @endif
                </div>
            </section>
        @else
            <section class="flex flex-wrap md:flex-nowrap items-center justify-center bg-gray-200 shadow-lg rounded-2xl py-6 md:py-4 px-6 md:pr-5 space-y-4 md:space-y-0 md:space-x-8 mr-3 ml-6">
                {{ __('No itens found') }}
            </section>
        @endif
    </div>

    <x-jet-confirmation-modal wire:model="creating">
        <x-slot name="title">
            {{ __('Create new account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure that you want to create a new account?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('creating')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Sure') }}
            </x-jet-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
