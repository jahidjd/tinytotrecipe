@extends('front.layout.layout')
@section('body')
<div class="card-body">
    <div class="col-lg-12 log-md-12 col-xs-12 bodyHeader">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 search">
                <h4 class="prifile">
                    <i class="fa-solid fa-user" style="font-size: 70px;"></i> {{$user->name}}<br>
                    <a href="" style="font-size: 20px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Update
                        Profile</a>
                </h4>

            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 mainBody">
        @if (Auth::user()->role=='user')
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <h4 class="community">Your Approved Recipes</h4>
            </div>

        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
        @endif
       
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Recipe Name</th>
                                <th>User Name</th>
                                <th>Serves</th>
                                <th>Recomended Age</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recipe as $key=>$r)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$r->recipe_name}}</td>
                                    <td>{{$r->user->name}}</td>
                                    <td>{{$r->serves}}</td>
                                    <td>{{$r->recomended_age}}</td>
                                    <td>
                                        <img src="{{url("recipeImage/$r->image")}}" alt="" width="150px"  class="image-responsive">
                                        
                                    </td>
                                    <td>
                                        <a href="{{route('viewRecipe',$r->id)}}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{route('editRecipe',$r->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{route('deleteRecipe',$r->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure!!')"><i class="fa-solid fa-trash"></i></a>
                                        {{-- {{$r->id}} --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No recipe added yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $recipe->links('pagination::bootstrap-4') }}

                </div>


            </div>

        </div>
        @endif
        @if (Auth::user()->role=='admin')
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <h4 class="community">Reports</h4>
            </div>

        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
        @endif
       
        <div class="container">
            <div class="row">
                <form action="{{route('reportSearch')}}" method="post">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td>From</td>
                            <td><input type="date" name="start_date" class="form-control"></td>
                            <td>To</td>
                            <td><input type="date" name="end_date" class="form-control"></td>
                            <td><input type="submit" class="btn btn-primary" value="Search"></td>
                            
                        </tr>
                    </table>
                </form>
                <div class="col-md-12 col-lg-12 col-xs-12">
                    <h4 style="text-align: left">Top Rated Recipes</h4>
                    <table class="table table-bordered">
                        <thead style="background-color: yellow">
                            <tr>
                                
                                <th>Recipe Name</th>
                                <th>User Name</th>
                                <th>Ratings</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ratings as $r)
                               @if ($r->remarks>=4)
                               <tr>
                                
                                <td>{{$r->recipe->recipe_name}}</td>
                                <td>{{$r->user->name}}</td>
                                <td>{{$r->remarks}}</td>
                                
                                <td>
                                    <a href="{{route('viewRecipe',$r->recipe->id)}}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    {{-- <a href="{{route('editRecipe',$r->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                                    <a href="{{route('deleteRecipe',$r->recipe->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure!!')"><i class="fa-solid fa-trash"></i></a>
                                    {{-- {{$r->id}} --}}
                                </td>
                            </tr>
                               @endif
                            @empty
                                <tr>
                                    <td colspan="7">No recipe found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    

                </div>


            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12">
                    <h4 style="text-align: left">Least Rated Recipes</h4>
                    <table class="table table-bordered">
                        <thead style="background-color: yellow">
                            <tr>
                                
                                <th>Recipe Name</th>
                                <th>User Name</th>
                                <th>Ratings</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ratings as $r)
                               @if ($r->remarks < 4)
                               <tr>
                                
                                <td>{{$r->recipe->recipe_name}}</td>
                                <td>{{$r->user->name}}</td>
                                <td>{{$r->remarks}}</td>
                                
                                <td>
                                    <a href="{{route('viewRecipe',$r->id)}}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    {{-- <a href="{{route('editRecipe',$r->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                                    <a href="{{route('deleteRecipe',$r->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure!!')"><i class="fa-solid fa-trash"></i></a>
                                    {{-- {{$r->id}} --}}
                                </td>
                            </tr>
                               @endif
                            @empty
                                <tr>
                                    <td colspan="7">No recipe found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $recipe->links('pagination::bootstrap-4') }} --}}

                </div>


            </div>

        </div>
        @endif
        
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('updateProfile') }}">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    @csrf
                    @method('put')
                    <table class="table table-bordered">
                        <tr>
                            <td>Your Name</td>
                            <td>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                
                            </td>
                        </tr>
                        <tr>
                            <td>Your Email</td>
                            <td>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email }}" required autocomplete="email">

                                
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" value="{{$user->password}}">

                                
                            </td>
                        </tr>
                        

                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection