@extends('layouts.app')

@section('content')

    <div class="card-header">Create Account</div>
    
    <div class="card-body">
        <form method="POST" action="{{route('account.store')}}">

            <input type="hidden" name="uuid" value="{{$newUuid}}">

            <div class="form-group">
                <label>Account</label>
                <input type="text" name="account" value="{{old('account', $newAccount)}}" class="form-control">
                <small class="form-text text-muted">Account Name</small>
            </div>

            <div class="form-group">
                <label>Personal Code</label>
                <input type="text" name="personal_code" value="{{old('personal_code', $newPersonID)}}" class="form-control">
                <small class="form-text text-muted">Person's ID</small>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{old('name', $newName)}}" class="form-control">
                <small class="form-text text-muted">Person's Name</small>
            </div>

            <div class="form-group">
                <label>Surname</label>
                <input type="text" name="surname" value="{{old('surname', $newSurname)}}" class="form-control">
                <small class="form-text text-muted">Person's Surname</small>
            </div>

            <input type="hidden" name="value" value="{{$newValue}}">

            @csrf
            <button type="submit">ADD</button>
        </form>
    </div>

@endsection