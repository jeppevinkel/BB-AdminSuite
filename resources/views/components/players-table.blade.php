<div class="container w-full md:w-4/5 xl:w-4/5  mx-auto px-2">

    <!--Title-->
{{--    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">--}}
{{--        Responsive <a class="underline mx-2" href="https://datatables.net/">DataTables.net</a> Table--}}
{{--    </h1>--}}


<!--Card-->
    <div id='players' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


        <table id="players-table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th data-priority="1">Player Name</th>
                <th data-priority="2">Player ID</th>
                <th data-priority="3">Client</th>
                <th data-priority="4">First Seen</th>
                <th data-priority="5">Last Seen</th>
            </tr>
            </thead>
            <tbody>

            <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->
            {{--            {{ dd($moderations->paginate(15)) }}--}}

            @foreach($players->paginate(15) as $player)
                <tr>
                    <td>{{ $player->username }}</td>
                    <td>{{ $player->id }}</td>
                    <td>{{ $player->id_type }}</td>
                    <td>{{ $player->firstSeen($serverAccount) }}</td>
                    <td>{{ $player->lastSeen($serverAccount) }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>


    </div>
    <!--/Card-->


</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {

        var table = $('#players-table').DataTable({
            responsive: true
        })
            .columns.adjust()
            .responsive.recalc();
    });

</script>
