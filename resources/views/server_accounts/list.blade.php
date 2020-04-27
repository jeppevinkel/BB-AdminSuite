@extends('layouts.home.app')

@section('content')

    <div class="flex flex-col md:flex-row">

        <x-home-sidebar>

        </x-home-sidebar>

        <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="bg-blue-800 p-2 shadow text-xl text-white">
                <h3 class="font-bold pl-2">Dashboard</h3>
            </div>

            @if (session('status'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                     role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-row flex-wrap flex-grow mt-2">
                @foreach(Auth::user()->serverAccountMembers as $serverAccountMember)
                    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                        <!--Template Card-->
                        <div class="bg-white border-transparent rounded-lg shadow-lg">
                            <div
                                class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2 flex justify-between">
                                <h5 class="font-bold uppercase text-gray-600"><a
                                        href="{{ route('accounts.show', ['serverAccount' => $serverAccountMember->serverAccount]) }}">{{ $serverAccountMember->serverAccount->name }}</a>
                                </h5>
                                <h6 class="font-bold uppercase text-gray-600">{{ $serverAccountMember->role->name }}</h6>
                            </div>
                            <div class="p-5">
                                <div>
                                    <p><span
                                            class="font-bold uppercase">Servers:</span> {{ $serverAccountMember->serverAccount->servers->count() }}
                                    </p>
                                    <p><span
                                            class="font-bold uppercase">Online Players:</span> {{ count($serverAccountMember->serverAccount->players()) }}
                                    </p>
                                    <p><span
                                            class="font-bold uppercase">Members:</span> {{ $serverAccountMember->serverAccount->users->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--/Template Card-->
                    </div>
                @endforeach

                {{--                @foreach($serverAccount->activeServerTokens() as $serverToken)--}}
                {{--                    <div class="w-full md:w-1/2 xl:w-1/3 p-3">--}}
                {{--                        <!--Template Card-->--}}
                {{--                        <div class="bg-white border-transparent rounded-lg shadow-lg">--}}
                {{--                            <div--}}
                {{--                                class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2 flex justify-between">--}}
                {{--                                <h5 class="font-bold uppercase text-gray-600">Server Token</h5>--}}
                {{--                            </div>--}}
                {{--                            <div class="p-5">--}}
                {{--                                <div>--}}
                {{--                                    <p class="inline-block align-middle align-text-middle">Type the following into your--}}
                {{--                                        server console <span--}}
                {{--                                            class="p-2 bg-gray-300 rounded align-text-middle">sw setup {{ $serverToken->token }}</span>--}}
                {{--                                    </p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!--/Template Card-->--}}
                {{--                    </div>--}}
                {{--                @endforeach--}}

                    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                        <!--Template Card-->
                        <div class="bg-white border-transparent rounded-lg shadow-lg">
                            <div
                                class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2 flex justify-between">
                                <h5 class="font-bold uppercase text-gray-600">Add new</h5>
                            </div>
                            <div class="p-5">
                                <div>
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        <a href="{{ route('accounts.create') }}">Add new server account</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--/Template Card-->
                    </div>

            </div>
        </div>
    </div>

    <script>
        /*Toggle dropdown list*/
        function toggleDD(myDropMenu) {
            document.getElementById(myDropMenu).classList.toggle("invisible");
        }

        /*Filter dropdown options*/
        function filterDD(myDropMenu, myDropMenuSearch) {
            var input, filter, ul, li, a, i;
            input = document.getElementById(myDropMenuSearch);
            filter = input.value.toUpperCase();
            div = document.getElementById(myDropMenu);
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
                var dropdowns = document.getElementsByClassName("dropdownlist");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('invisible')) {
                        openDropdown.classList.add('invisible');
                    }
                }
            }
        }
    </script>

@endsection
