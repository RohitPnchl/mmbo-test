@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 auth-container">
        <h2 class="text-center mb-4">Login</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="mt-2 text-center">
            <a href="{{ route('register') }}" class="text-sm mt-2">Don't have an account?</a>
        </div>
    </div>
</div>
@endsection