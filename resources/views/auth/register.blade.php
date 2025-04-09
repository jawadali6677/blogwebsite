{{--<x-guest-layout>

    <div class="container text-center mt-5">
        <div class="row">
            <div class="col-md-4 offset-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
@csrf
<div class="mb-3 mt-3">
    <label for="name" class="form-label">Name:</label>
    <input type="name" class="form-control" id="name" name="name" value="{{old('name')}}"
        placeholder="Enter name" name="name">
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>
<div class="mb-3 mt-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
        placeholder="Enter email">
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password:</label>
    <input type="password" class="form-control" name="password" id="password"
        placeholder="Enter password">
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>
<div class="mb-3">
    <label for="password_confirmation" class="form-label">Cofirm Password:</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
        placeholder="Cofirm password">
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>
<div class="form-check mb-3">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
    </label>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<span>if you are not register <a href="{{ route('register') }}">Sign Up</a></span>
</form>
</div>
</div>
</div>
</div>
</div>

</x-guest-layout>--}}
@extends('layout.auth.app')
@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Register here</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Register your account?</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input type="name" class="form-control" id="name" name="name" value="{{old('name')}}"
                                placeholder="Enter name" name="name" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" name="password" class="form-control" placeholder="Password"
                                required>
                            <span toggle="#password-field"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                placeholder="Cofirm password">
                            <span toggle="#password_confirmation"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                        </div>
                    </form>
                    <p class="w-100 text-center">&mdash; If you have an account <a href="{{ route('login') }}">Sign In</a> &mdash;</p>
                    <!-- <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p> -->
                    <!-- <div class="social d-flex text-center">
							<a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span>
								Facebook</a>
							<a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span>
								Twitter</a>
						</div> -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection