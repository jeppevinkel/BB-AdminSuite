<div class="container w-full md:w-4/5 xl:w-4/5  mx-auto px-2">

    <!--Title-->
{{--    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">--}}
{{--        Responsive <a class="underline mx-2" href="https://datatables.net/">DataTables.net</a> Table--}}
{{--    </h1>--}}


<!--Card-->
    <div id='members' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


        <table id="members-table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th data-priority="1">Username</th>
                <th data-priority="2">Role</th>
                <th data-priority="3">Joined</th>
            </tr>
            </thead>
            <tbody>

            <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->
            {{--            {{ dd($moderations->paginate(15)) }}--}}
            @foreach($members->paginate(15) as $member)
                <tr>
                    <td>
                        {{ $member->user->username }}
                    </td>
                    @if((\Illuminate\Support\Facades\Auth::user()->getServerRole($serverAccount->id)->hasPermission('member_role_set') && \Illuminate\Support\Facades\Auth::user()->getServerRole($serverAccount->id)->id < $member->role->id) || \Illuminate\Support\Facades\Auth::user()->getServerRole($serverAccount->id)->hasPermission('member_role_set_unlimited') && $member->user != \Illuminate\Support\Facades\Auth::user())
                        <td class="flex justify-center">
                            <div class="inline-block relative w-10/12">
                                <select id="roles" name="roles" form="form{{ $member->user->id }}"
                                        onchange="updateRank({{ $member->user->id }}, this)"
                                        class="block w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500">
                                    @foreach(\App\Role::all() as $role)
                                        <option value="{{ $role->id }}"
                                                @if($member->role == $role) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    @else
                        <td class="flex justify-center">
                            <div class="inline-block relative w-10/12">
                                {{ $member->role->name }}
                            </div>
                        </td>
                    @endif
                    <td>
                        {{ $member->created_at }}
                    </td>
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

        var table = $('#members-table').DataTable({
            responsive: true
        })
            .columns.adjust()
            .responsive.recalc();
    });

    function updateRank(memberId, form) {
        let url = '{{ route('accounts.members.update', ['serverAccount' => $serverAccount, 'serverAccountMember' => ':id']) }}';
        url = url.replace(':id', memberId);
        let csrf = '{{ csrf_token() }}';
        $.ajax({
            url: url,
            type: 'PUT',
            data: $(form).serialize(),
            headers: {'X-CSRF-TOKEN': csrf},
            success: function (result) {
                //console.log(result);
            }
        });
    }

</script>
