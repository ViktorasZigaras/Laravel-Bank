@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account List</div>
                <div class="card-body">
                    @foreach ($accounts as $account)
                        <a href="{{route('account.edit',[$account])}}">{{$account->account}}</a>
                        <form method="POST" action="{{route('account.destroy', [$account])}}">
                            @csrf
                            <button type="submit">DELETE</button>
                        </form>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection