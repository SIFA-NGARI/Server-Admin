@extends('layouts.app')

@section('content')
<div class="container w-50">
    <h2 class="mb-4">Sign up</h2>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name">
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email">
            @if ($errors->has('email'))
<span class="text-danger">{{ $errors->first('email') }}</span>
@endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
            @if ($errors->has('password'))
<span class="text-danger">{{ $errors->first('password') }}</span>
@endif
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword">
            @if ($errors->has('cpassword'))
<span class="text-danger">{{ $errors->first('cpassword') }}</span>
@endif
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
</div>
@endsection