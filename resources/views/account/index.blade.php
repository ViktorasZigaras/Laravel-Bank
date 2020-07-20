@extends('layouts.app')

@section('content')

    <div class="card-header">Account List</div>

    <div class="card-body">
        @foreach ($accounts as $account)
            <span>
                {{$account->account}} ( {{$account->personal_code}} ) {{$account->name}} {{$account->surname}}: {{$account->value}} &euro; {{$account->value * $rate}} &dollar;
            </span>

            @if ($role === 'admin')

                <div class="flex">

                    <form method="GET" action="{{route('account.edit', [$account])}}">
                        @csrf
                        <button type="submit">EDIT</button>
                    </form>

                    <form method="POST" action="{{route('account.add', [$account])}}">
                        <button type="submit" name="add" value="add">ADD</button>
                        @csrf
                        <input type="text" name="value" value="0" class="list-input">
                    </form>

                    <form method="POST" action="{{route('account.remove', [$account])}}">
                        <button type="submit" name="add" value="add">REMOVE</button>
                        @csrf
                        <input type="text" name="value" value="0" class="list-input">
                    </form>

                    <form method="POST" action="{{route('account.destroy', [$account])}}">
                        @csrf
                        <button type="submit">DELETE</button>
                    </form>

                </div>

            @endif

        @endforeach
    </div>
                
@endsection