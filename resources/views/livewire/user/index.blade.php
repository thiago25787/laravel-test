<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight justify-between">
            <div>{{__("Users")}}</div>
        </h2>
    </x-slot>
    <div class="py-2">
        @if($users && $users->count() > 0)
            <div id="table" class="min-w-full overflow-x-auto bg-white shadow-xl sm:rounded-lg ml-12 mr-3">
                <table class="table-fixed w-full">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">{{_("Name")}}</th>
                        <th class="px-4 py-2">{{__("Email")}}</th>
                        <th class="px-4 py-2">{{__("Date")}}</th>
                        <th class="px-4 py-2">{{__("Amount")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->created_at }}</td>
                            <td class="border px-4 py-2">{{ $user->account ? $user->account->amount : null }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <section class="flex flex-wrap md:flex-nowrap items-center justify-center bg-gray-200 shadow-lg rounded-2xl py-6 md:py-4 px-6 md:pr-5 space-y-4 md:space-y-0 md:space-x-8 mr-3 ml-6">
                {{ __('No itens found') }}
            </section>
        @endif
    </div>
</div>
