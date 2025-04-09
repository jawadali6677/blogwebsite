{{--<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>--}}

@extends('layout.auth.app')
@section('content')
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 text-center mb-5">
				<!-- <h2 class="heading-section">Login</h2> -->
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-4">
				<div class="login-wrap p-0">
					<h3 class="mb-4 text-center">Store Password</h3>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
					<form method="POST" action="{{ route('password.store') }}">
						@csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
						<div class="form-group">
							<input type="email" class="form-control" id="email" type="email" name="email" :value="old('email', $request->email)" placeholder="Email" required autofocus autocomplete="username"/>
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
                            <button type="submit" class="form-control btn btn-primary submit px-3">Reset Password</button>
                        </div>
					</form>
					<p class="w-100 text-center">&mdash; Back to login <a href="{{ route('login') }}">Sign In</a> &mdash;</p>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection