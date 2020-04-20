@extends('layouts.app')

@section('content')
    <div class="h-2 bg-blue-700"></div>
    <div class="container mx-auto p-8">
        <div class="mx-auto max-w-md">
            <div class="bg-white rounded shadow">
                <div class="border-b py-8 font-bold text-black text-center text-xl tracking-widest uppercase">
                    {{ __('Register') }}
                </div>

                <form class="bg-grey-lightest px-10 py-10" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <input class="border w-full p-3 @error('username')  @enderror" name="username" type="text"
                               value="{{ old('username') }}" placeholder="{{ __('Username') }}" required
                               autocomplete="username" autofocus>
                        @error('username')
                        <span class="" role="alert">
                            <strong class="text-red-500">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input class="border w-full p-3 @error('email')  @enderror" name="email" type="text"
                               value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required
                               autocomplete="email" autofocus>
                        @error('email')
                        <span class="" role="alert">
                            <strong class="text-red-500">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <input class="border w-full p-3 @error('password')  @enderror" name="password" type="password"
                               placeholder="{{ __('Password') }}" required autocomplete="new-password">
                        @error('password')
                        <span class="" role="alert">
                            <strong class="text-red-500">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <input class="border w-full p-3 @error('password-confirm')  @enderror"
                               name="password_confirmation" type="password"
                               placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                        @error('password-confirm')
                        <span class="" role="alert">
                            <strong class="text-red-500">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex">
                        <button
                            class="bg-blue-700 hover:bg-blue-800 w-full p-4 text-sm text-white uppercase font-bold tracking-wider">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

                <div class="border-t px-10 py-6">
                    <div class="flex justify-between">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}"
                               class="font-bold text-blue-700 hover:text-primary-dark no-underline">{{ __('Already have an account?') }}</a>
                        @endif
                        @if (Route::has('password.request'))
                            <a class="text-gray-800 hover:text-black no-underline"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
