@extends('layouts.app')

@section('content')
    <div class="h-2 bg-blue-700"></div>
    <div class="container mx-auto p-8">
        <div class="mx-auto max-w-md">
            <div class="bg-white rounded shadow">
                <div class="card">
                    <div class="border-b py-8 font-bold text-black text-center text-xl tracking-widest uppercase">
                        {{ __('Verify Your Email Address') }}
                    </div>

                    <div class="border-t px-10 py-6">
                        @if (session('resent'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                 role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="bg-grey-lightest py-10 inline" method="POST"
                              action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                    class="font-bold text-blue-700 hover:text-primary-dark no-underline inline">{{ __('click here to request another') }}</button>
                            .
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
