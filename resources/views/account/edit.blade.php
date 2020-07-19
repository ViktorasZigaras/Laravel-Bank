@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

               <div class="header">
                    <div><img class="image" src="./../../pictures/bank.jpg" alt="bank"></div>
                    <div class="header-text">
                        <h2>Čiupčius and Griebčius Inc.</h2>
                        <div>Give Us All Of Your Money NOW!!!</div>
                    </div>
                    <div><img class="image" src="./../../pictures/money.jpg" alt="money"></div>
                </div>

                <div class="card-header">Edit Account</div>

                <div class="card-body">
                    <form method="POST" action="{{route('account.update',[$account])}}">
                        <!-- <?= var_dump($account); ?> -->
                        <!-- <?= var_dump($account->uuid); ?> -->
                        {{$account}}
                        <div class="form-group">
                           <label>UUID</label>
                           <input type="text" name="uuid" value="{{old('uuid'), $account->uuid}}" class="form-control">
                           <small class="form-text text-muted">Account UUID</small>
                        </div>

                        <div class="form-group">
                           <label>Account</label>
                           <input type="text" name="account" value="{{old('account'), $account->account}}" class="form-control">
                           <small class="form-text text-muted">Account Name</small>
                        </div>

                        <div class="form-group">
                           <label>Personal Code</label>
                           <input type="text" name="personal_code" value="{{old('personal_code'), $account->personal_code}}" class="form-control">
                           <small class="form-text text-muted">Person's ID</small>
                        </div>

                        <div class="form-group">
                           <label>Name</label>
                           <input type="text" name="name" value="{{old('name'), $account->name}}" class="form-control"></input>
                           <small class="form-text text-muted">Person's Name</small>
                        </div>

                        <div class="form-group">
                           <label>Surname</label>
                           <input type="text" name="surname" value="{{old('surname'), $account->surname}}" class="form-control"></input>
                           <small class="form-text text-muted">Person's Surname</small>
                        </div>

                        <div class="form-group">
                           <label>Value</label>
                           <input type="text" name="value" value="{{old('value'), $account->value}}" class="form-control"></input>
                           <small class="form-text text-muted">Stored Value</small>
                        </div>

                        @csrf
                        <button type="submit">EDIT</button>
                     </form>
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