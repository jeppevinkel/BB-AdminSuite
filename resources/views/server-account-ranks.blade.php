@extends('layouts.dashboard.app')

@section('content')

    <div class="flex flex-col md:flex-row">

        <x-sidebar :server-account="$serverAccount">

        </x-sidebar>

        <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="bg-blue-800 p-2 shadow text-xl text-white">
                <h3 class="font-bold pl-2">Ranks</h3>
            </div>


            <div class="flex flex-row flex-wrap flex-grow mt-2">

                @foreach($serverAccount->ranks as $rank)
                    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                        <!--Template Card-->
                        <div class="bg-white border-transparent rounded-lg shadow-lg">
                            <div
                                class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2 flex justify-between">
                                <h5 class="font-bold uppercase text-gray-600">{{ $rank->badge_text }}</h5>
                                <h6 class="font-bold uppercase text-gray-600">{{ $rank->badge_color }}</h6>
                            </div>
                            <div class="p-5">
                                <div>
                                    <p><span class="font-bold uppercase">Rank name:</span> {{ $rank->rank_name }}</p>
                                    <p><span
                                            class="font-bold uppercase">Hidden by default:</span> {{ $rank->hidden_by_default }}
                                    </p>
                                    <p><span class="font-bold uppercase">Kick power:</span> {{ $rank->kick_power }}
                                    </p>
                                    <p><span
                                            class="font-bold uppercase">Required kick power:</span> {{ $rank->required_kick_power }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--/Template Card-->
                    </div>
                @endforeach

                @if(Auth::user()->getServerRole($serverAccount->id)->hasPermission('server_add'))
                    <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                        <!--Template Card-->
                        <div class="bg-white border-transparent rounded-lg shadow-lg">
                            <div
                                class="bg-gray-400 border-b-2 border-gray-500 rounded-tl-lg rounded-tr-lg p-2 flex justify-between">
                                <h5 class="font-bold uppercase text-gray-600">Add new</h5>
                            </div>
                            <div class="p-5">
                                <div>
                                    <form method="POST"
                                          action="">
                                        @csrf
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Add new rank
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/Template Card-->
                    </div>
                @endif

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
