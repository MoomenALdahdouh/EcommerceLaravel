<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome <b></b> {{--You can inport Auth using \Illuminate\Support\Facades\Auth--}}
            <b class="float-end">Total Users <span class="badge bg-danger"></span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">All Items</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">Created At</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php($count = 1)
                                @foreach($items as $item)
                                    <tr>
                                        <th scope="row">{{$count++}}</th>
                                        <td>{{$item->item_name}}</td>
                                        <td>{{$item->user_id}}</td>
                                        <td>{{$item->created_at}}</td>
                                        @if($item->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{$item->created_at->diffForHumans()}}</td>
                                        @endif
                                            <!--Use this line if you compact users from Auth-->
                                            <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('add.category')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name"
                                           aria-describedby="category_nameHelp" required>
                                    @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>

                </div>--}}
            </div>
        </div>

    </div>

</x-app-layout>
