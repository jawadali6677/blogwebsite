{{--<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>--}}

@extends('layout.auth.app')
@section('content')

<section class="ftco-section">
	<div class="container">
        <p class="mb-4 text-center text-white">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
		<div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
				<h2 class="heading-section">Reset Password</h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-4">
				<div class="login-wrap p-0">
                <x-auth-session-status class="mb-4" :status="session('status')" />
					<form method="POST" action="{{ route('password.email') }}">
						@csrf
						<div class="form-group">
							<input type="email" class="form-control" id="email" name="email"
								placeholder="Enter email" :value="old('email')" required autofocus>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
						</div>
						<div class="form-group">
							<button type="submit" class="form-control btn btn-primary submit px-3">Email Password Reset Link</button>
						</div>
					</form>
					<p class="w-100 text-center">&mdash; Back to login &mdash;  <a href="{{ route('login') }}"> Login</a> &mdash;</p>
				</div>
			</div>
		</div>
	</div>

@endsection
