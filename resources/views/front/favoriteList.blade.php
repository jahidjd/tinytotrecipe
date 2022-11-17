@extends('front.layout.layout')
@section('body')


    <div class="col-lg-12 log-md-12 col-xs-12 bodyHeader">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 search">
                <h4 class="addRe">Your Favorite Recipe List</h4>
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
           
            <table class="table table-bordered">
                <thead style="background-color: yellow">
                    <tr>
                        <th>SL</th>
                        <th>Recipe Name</th>
                        <th>User Name</th>
                      
                      <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse ($favorite as $key=>$r)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$r->recipe->recipe_name}}</td>
                            <td>{{$r->user->name}}</td>
                        
                            <td>
                                <a href="{{route('viewRecipe',$r->recipe_id)}}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{route('deleteFav',$r->id)}}" class="btn btn-danger" onclick="return confirm('are you sure!')"><i class="fa-solid fa-trash"></i></a>
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No recipe added yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $favorite->links('pagination::bootstrap-4') }}
        </div>

        
    </div>


@endsection