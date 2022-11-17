@extends('front.layout.layout')
@section('body')

<div class="card-body">
    <div class="col-lg-12 log-md-12 col-xs-12 bodyHeader">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 search">
                <h4 class="addRe">Your Recipe List</h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 mainBody">
        <br><br>
        <div class="container">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <h5 style="text-align: left"><a href="{{route('addRecipe')}}" class="btn btn-info">Add Recipe</a></h5>
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

@endsection