@extends('layouts.app')

@section('content')
    <div class="h-2 bg-blue-700"></div>
    <div class="container mx-auto p-8">
        <div class="mx-auto max-w-md">
            <div class="bg-white rounded shadow">
                <div class="border-b py-8 font-bold text-black text-center text-xl tracking-widest uppercase">
                    {{ __('Create Server Account') }}
                </div>

                <form class="bg-grey-lightest px-10 py-10" method="POST" action="{{ route('accounts.store') }}">
                    @csrf

                    <div class="mb-3">
                        <input class="border w-full p-3 @error('name')  @enderror" name="name" type="text"
                               value="{{ old('name') }}" placeholder="{{ __('Name') }}" required
                               autocomplete="username" autofocus>
                        @error('name')
                        <span class="" role="alert">
                            <strong class="text-red-500">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex">
                        <button
                            class="bg-blue-700 hover:bg-blue-800 w-full p-4 text-sm text-white uppercase font-bold tracking-wider">
                            {{ __('Create') }}
                        </button>
                    </div>
                </form>

                <div class="border-t px-10 py-6">
                    <div class="flex justify-between">
                        <a href="{{ route('accounts.index') }}"
                           class="font-bold text-blue-700 hover:text-primary-dark no-underline">{{ __('Cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
