<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome <b>{{Auth::user()->name}}</b> {{--You can inport Auth using \Illuminate\Support\Facades\Auth--}}
            <b class="float-end">Total Users <span class="badge bg-danger">{{count($users)}}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            {{--<td>{{$user->created_at->diffForHumans()}}</td>--}} <!--Use this line if you compact users from Auth-->
                            <td>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td> <!--Use this line if you compact users from DB to pars the date by carbon library-->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
