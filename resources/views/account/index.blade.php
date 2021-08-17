@extends('layouts.app')

@section('content')
    <h2>
        {{__("Balance")}}
    </h2>
    <div>
        <div class="text-right mb-3">
            @if($account)
                <button class="btn btn-secondary">
                    {{__("Amount")}} <span class="badge badge-danger">{{$account->amount}}</span>
                </button>
            @else
                <a class="btn btn-primary" href="{{url()->route("account.store")}}">
                    {{__("Create account")}}
                </a>
            @endif
        </div>
        @if(($deposits && $deposits->count() > 0) || ($purchases && $purchases->count() > 0))
            <section class="mt-4 flex items-center justify-content-between">
                <div>
                    <h2 class="text-center"><strong>{{__("Last 10 deposits")}}</strong></h2>
                    @if($deposits->count() > 0)
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{_("Amount")}}</th>
                                <th>{{__("Date")}}</th>
                                <th>{{__("Approved?")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{ $deposit->amount }}</td>
                                    <td>{{ $deposit->created_at }}</td>
                                    <td>{{ $deposit->status }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <section class="alert alert-warning text-center">
                            {{ __('No itens found') }}
                        </section>
                    @endif
                </div>
                <div>
                    <h2 class="text-center"><strong>{{__("Last 10 pucharses")}}</strong></h2>
                    @if($purchases->count() > 0)
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{_("Description")}}</th>
                                <th>{{__("Amount")}}</th>
                                <th>{{__("Date")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->description }}</td>
                                    <td>{{ $purchase->amount }}</td>
                                    <td>{{ $purchase->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <section class="alert alert-warning text-center">
                            {{ __('No itens found') }}
                        </section>
                    @endif
                </div>
            </section>
        @else
            <section class="alert alert-warning text-center">
                {{ __('No itens found') }}
            </section>
        @endif
    </div>

{{--        <x-jet-confirmation-modal wire:model="creating">--}}
{{--            <x-slot name="title">--}}
{{--                {{ __('Create new account') }}--}}
{{--            </x-slot>--}}
{{--    --}}
{{--            <x-slot name="content">--}}
{{--                {{ __('Are you sure that you want to create a new account?') }}--}}
{{--            </x-slot>--}}
{{--    --}}
{{--            <x-slot name="footer">--}}
{{--                <x-jet-secondary-button wire:click="$toggle('creating')" wire:loading.attr="disabled">--}}
{{--                    {{ __('Nevermind') }}--}}
{{--                </x-jet-secondary-button>--}}
{{--    --}}
{{--                <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">--}}
{{--                    {{ __('Sure') }}--}}
{{--                </x-jet-button>--}}
{{--            </x-slot>--}}
{{--        </x-jet-confirmation-modal>--}}
@endsection
