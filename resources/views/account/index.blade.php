@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-lg-10 col-md-10 col-sm-10">
            <div class="card">

                <div class="header">
                    <div><img class="image" src="pictures/bank.jpg" alt="bank"></div>
                    <div class="header-text">
                        <h2>Čiupčius and Griebčius Inc.</h2>
                        <div>Give Us All Of Your Money NOW!!!</div>
                    </div>
                    <div><img class="image" src="pictures/money.jpg" alt="money"></div>
                </div>

                <div class="card-header">Account List</div>

                <div class="card-body">
                    @foreach ($accounts as $account)
                        <span>
                            {{$account->account}} ( {{$account->personal_code}} ) {{$account->name}} {{$account->surname}}: {{$account->value}} &euro;
                            <!-- $account['value'] * App::USDrate()) . ' &dollar;' -->
                        </span>

                        <!-- <a href="{{route('account.edit',[$account])}}">{{$account->account}}</a> -->
                        <form method="GET" action="{{route('account.edit', [$account])}}">
                            @csrf
                            <button type="submit">EDIT</button>
                        </form>
                        <form method="POST" action="{{route('account.destroy', [$account])}}">
                            @csrf
                            <button type="submit">DELETE</button>
                        </form>
                        <br>
                    @endforeach
                </div>

                <div class="footer">
                    <div>Grab-All Brothers: We Love Your Money And NOT You!!!</div>
                    <div>&copy; 2020 Corona Edition</div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection