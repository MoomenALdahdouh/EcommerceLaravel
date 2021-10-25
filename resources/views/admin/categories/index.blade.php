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
                @if(session('successUpdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('successUpdate')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">All Category</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php($count = 1) {{--Here this way to show columen number not work with paging so we use
                                other way $categories->firstItem()+$loop->index--}}
                                @foreach($categories as $category)
                                    <tr>
                                        {{--<th scope="row">{{$count++}}</th>--}} {{--not work with paging--}}
                                        <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                        <td>{{$category->category_name}}</td>
                                        {{--<td>{{$category->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                                        <td>{{$category->user->name}}</td> {{--Use this when join table by ROM method--}}
                                        {{--<td>{{$category->name}}</td>--}}  {{--After join with Quiry builder --}}
                                        {{--<td>{{$category->created_at}}</td>--}}
                                        @if($category->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                                        @endif
                                            <!--Use this line if you compact users from Auth-->
                                            <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                        <td>
                                            <a href="{{url('softdelete/category/'.$category->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i>DELETE</a>
                                            <a href="{{url('category/edit/'.$category->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i>EDIT</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
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

                </div>
            </div>
            <br>
            <div class="row">
               {{-- @if(session('successUpdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('successUpdate')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif--}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Trash List</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php($count = 1) {{--Here this way to show columen number not work with paging so we use
                                other way $categories->firstItem()+$loop->index--}}
                                @foreach($trashCat as $category)
                                    <tr>
                                        {{--<th scope="row">{{$count++}}</th>--}} {{--not work with paging--}}
                                        <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                        <td>{{$category->category_name}}</td>
                                        {{--<td>{{$category->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                                        <td>{{$category->user->name}}</td> {{--Use this when join table by ROM method--}}
                                        {{--<td>{{$category->name}}</td>--}}  {{--After join With Query builder--}}
                                        {{--<td>{{$category->created_at}}</td>--}}
                                        @if($category->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                                    @endif
                                    <!--Use this line if you compact users from Auth-->
                                        <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                        <td>
                                            <a href="{{url('forcedelete/category/'.$category->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i>FORCE DELETE</a>
                                            <a href="{{url('category/restore/'.$category->id)}}" class="btn btn-primary"><i class="fas fa-trash-restore"></i>RESTORE</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$trashCat->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
