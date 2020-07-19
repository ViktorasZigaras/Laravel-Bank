@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="header">
                    <div><img class="image" src="./../pictures/bank.jpg" alt="bank"></div>
                    <div class="header-text">
                        <h2>Čiupčius and Griebčius Inc.</h2>
                        <div>Give Us All Of Your Money NOW!!!</div>
                    </div>
                    <div><img class="image" src="./../pictures/money.jpg" alt="money"></div>
                </div>

                <div class="card-header">Create Account</div>
                
                <div class="card-body">
                    <form method="POST" action="{{route('account.store')}}">

                        <div class="form-group">
                           <label>UUID</label>
                           <input type="text" name="uuid" value="{{old('uuid'), $newUuid}}" class="form-control">
                           <small class="form-text text-muted">Account UUID</small>
                        </div>

                        <div class="form-group">
                           <label>Account</label>
                           <input type="text" name="account" value="{{old('account'), $newAccount}}" class="form-control">
                           <small class="form-text text-muted">Account Name</small>
                        </div>

                        <div class="form-group">
                           <label>Personal Code</label>
                           <input type="text" name="personal_code" value="{{old('personal_code'), $newPersonID}}" class="form-control">
                           <small class="form-text text-muted">Person's ID</small>
                        </div>

                        <div class="form-group">
                           <label>Name</label>
                           <input type="text" name="name" value="{{old('name'), $newName}}" class="form-control"></input>
                           <small class="form-text text-muted">Person's Name</small>
                        </div>

                        <div class="form-group">
                           <label>Surname</label>
                           <input type="text" name="surname" value="{{old('surname'), $newSurname}}" class="form-control"></input>
                           <small class="form-text text-muted">Person's Surname</small>
                        </div>

                        <div class="form-group">
                           <label>Value</label>
                           <input type="text" name="value" value="{{old('value'), $newValue}}" class="form-control"></input>
                           <small class="form-text text-muted">Stored Value</small>
                        </div>

                        @csrf
                        <button type="submit">ADD</button>
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