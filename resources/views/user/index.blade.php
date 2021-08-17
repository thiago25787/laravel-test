@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-weight-bold">
            <div>{{__("Users")}}</div>
        </h2>
        <div>
            @if($users && $users->count() > 0)
                <div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{_("Name")}}</th>
                                <th>{{__("Email")}}</th>
                                <th>{{__("Date")}}</th>
                                <th>{{__("Amount")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->account ? $user->account->amount : null }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @else
                <section>
                    {{ __('No itens found') }}
                </section>
            @endif
        </div>
    </div>
@endsection
