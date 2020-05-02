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
                                @if(\Illuminate\Support\Facades\Auth::user()->getServerRole($serverAccount->id)->canEditRanks())
                                    <div class="flex justify-between">
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission($serverAccount->id, 'rank_modify'))
                                            <h6 class="font-bold uppercase text-blue-400"><a
                                                    href="{{ route('accounts.ranks.edit', ['serverAccount' => $serverAccount, 'rank' => $rank]) }}">Edit</a>
                                            </h6>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission($serverAccount->id, 'rank_modify') && \Illuminate\Support\Facades\Auth::user()->hasPermission($serverAccount->id, 'rank_remove'))
                                            <span class="pl-2 pr-2 text-gray-600"> | </span>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission($serverAccount->id, 'rank_remove'))
                                            <h6 class="modal-open cursor-pointer font-bold uppercase text-red-400"
                                                value="{{ $rank->rank_name }}">Remove</h6>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <div>
                                    <p><span class="font-bold uppercase">Rank name:</span> {{ $rank->rank_name }}</p>
                                    <p><span class="font-bold uppercase">Badge color:</span> {{ $rank->badge_color }}
                                    </p>
                                    <p><span
                                            class="font-bold uppercase">Hidden by default:</span> {{ $rank->hidden_by_default ? 'True' : 'False' }}
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

                @if(Auth::user()->getServerRole($serverAccount->id)->hasPermission('rank_add'))
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
                                        <a href="{{ route('accounts.ranks.create', ['serverAccount' => $serverAccount]) }}">Add
                                            new rank</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--/Template Card-->
                    </div>
                @endif

            </div>
        </div>
    </div>

    @if(Auth::user()->getServerRole($serverAccount->id)->hasPermission('rank_remove'))

        @foreach($serverAccount->ranks as $rank)
            <!--Modal-->
            <div
                class="modal-{{ $rank->rank_name }} opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"
                     value="{{ $rank->rank_name }}"></div>

                <div
                    class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                    <!-- Add margin if you want to see some of the overlay behind the modal-->
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Remove rank</p>
                            <div class="modal-close cursor-pointer z-50" value="{{ $rank->rank_name }}">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                     height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                </svg>
                            </div>
                        </div>

                        <!--Body-->
                        <p>This action can't be undone!</p>
                        <p>Rank name: {{ $rank->rank_name }}</p>

                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <form method="post"
                                  action="{{ route('accounts.ranks.destroy', ['serverAccount' => $serverAccount, 'rank' => $rank]) }}">
                                @csrf
                                @method('delete')
                                <button
                                    class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2"
                                    type="submit">Remove
                                </button>
                            </form>
                            <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
                                    value="{{ $rank->rank_name }}">Close
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <script>
        /*Toggle dropdown list*/
        function toggleDD(myDropMenu) {
            document.getElementById(myDropMenu).classList.toggle("invisible");
        }

        /*Filter dropdown options*/
        function filterDD(myDropMenu, myDropMenuSearch) {
            let input, filter, ul, li, a, i;
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
                let dropdowns = document.getElementsByClassName("dropdownlist");
                for (let i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('invisible')) {
                        openDropdown.classList.add('invisible');
                    }
                }
            }
        };

            @if(Auth::user()->getServerRole($serverAccount->id)->hasPermission('rank_remove'))
        var modalVal = -1;
        const openmodal = document.querySelectorAll('.modal-open');
        for (let i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function (event) {
                event.preventDefault();
                toggleModal(openmodal[i].getAttribute('value'));
            });
        }

        const overlay = document.querySelectorAll('.modal-overlay');
        for (let i = 0; i < overlay.length; i++) {
            overlay[i].addEventListener('click', function () {
                toggleModal(overlay[i].getAttribute('value'));
            });
        }

        const closemodal = document.querySelectorAll('.modal-close');
        for (let i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', function () {
                toggleModal(closemodal[i].getAttribute('value'));
            });
        }

        document.onkeydown = function (evt) {
            evt = evt || window.event;
            var isEscape = false;
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc");
            } else {
                isEscape = (evt.keyCode === 27);
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal();
            }
        };

        function toggleModal(name) {
            const body = document.querySelector('body');
            const modal = document.querySelector('.modal-' + name);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
            body.classList.toggle('modal-active');
        }
        @endif
    </script>



@endsection
