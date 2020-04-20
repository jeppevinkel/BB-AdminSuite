@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                 role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach(Auth::user()->serverAccountMembers as $serverAccountMember)
                            <a href="{{ route('accounts.show', ['serverAccount' => $serverAccountMember->serverAccount]) }}">{{ $serverAccountMember->serverAccount->name }}
                                | {{ $serverAccountMember->role->name }}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
