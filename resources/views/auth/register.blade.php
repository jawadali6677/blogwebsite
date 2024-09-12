<x-guest-layout>
    
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

</x-guest-layout>
