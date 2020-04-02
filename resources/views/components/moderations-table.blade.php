<div class="container w-full md:w-4/5 xl:w-4/5  mx-auto px-2">

    <!--Title-->
{{--    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">--}}
{{--        Responsive <a class="underline mx-2" href="https://datatables.net/">DataTables.net</a> Table--}}
{{--    </h1>--}}


<!--Card-->
    <div id='moderations' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


        <table id="moderations-table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th data-priority="1">Player Name</th>
                <th data-priority="2">Player ID</th>
                <th data-priority="3">Client</th>
                <th data-priority="4">Admin Name</th>
                <th data-priority="5">Admin ID</th>
                <th data-priority="6">Client</th>
                <th data-priority="7">Reason</th>
                <th data-priority="8">Expiry</th>
            </tr>
            </thead>
            <tbody>

            <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->
            {{--            {{ dd($moderations->paginate(15)) }}--}}

            @foreach($moderations->paginate(15) as $moderation)
                <tr>
                    <td>{{ $moderation->user_name }}</td>
                    <td>{{ $moderation->user_id }}</td>
                    <td>{{ $moderation->user_id_type }}</td>
                    <td>{{ $moderation->admin_name }}</td>
                    <td>{{ $moderation->admin_id }}</td>
                    <td>{{ $moderation->admin_id_type }}</td>
                    <td>{{ $moderation->reason }}</td>
                    <td>{{ $moderation->expiry_date }}</td>
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

        var table = $('#moderations-table').DataTable({
            responsive: true
        })
            .columns.adjust()
            .responsive.recalc();
    });

</script>
