@extends('layouts.app')

@section('content')
    <h2>
        <div>{{__("Approve deposit")}}</div>
    </h2>
    <div>
        @if($deposits && $deposits->count() > 0)
            <div>
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{__("User")}}</th>
                        <th>{{__("Amount")}}</th>
                        <th>{{__("Date")}}</th>
                        <th>{{__("Image")}}</th>
                        <th>{{__("Aprove/Deny")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deposits as $deposit)
                        <tr>
                            <td>{{ $deposit->account->user->name }}</td>
                            <td>{{ $deposit->amount }}</td>
                            <td>{{ $deposit->created_at }}</td>
                            <td>
                                <a href="{{asset($deposit->image_path)}}" target="_blank">
                                    <img src="{{$deposit->image_path}}" width="100" height="100" />
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-success" href="{{route('deposit.approve.store', ['deposit' => $deposit->id])}}">{{__("Aprove")}}</a>
                                <a class="btn btn-sm btn-danger" href="{{route('deposit.deny.destroy', ['deposit' => $deposit->id])}}">{{__("Deny")}}</a>
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
            <section class="alert alert-warning text-center">
                {{ __('No itens found') }}
            </section>
        @endif
    </div>
@endsection
