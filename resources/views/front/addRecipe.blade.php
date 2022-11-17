@extends('front.layout.layout')
@section('body')

<div class="card-body">
    <div class="col-lg-12 log-md-12 col-xs-12 bodyHeader">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 search">
                <h4 class="addRe">Add Recipes</h4>
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
            <form action="{{route('insertRecipe')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <td>Image</td>
                        <td>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </td>
                        <td>Video (Optional)</td>
                        <td><input type="text" name="video" class="form-control" placeholder="Video Link" value="{{old('video')}}"></td>
                    </tr>
                    <tr>
                        <td>Recipe Name</td>
                        <td colspan="3">
                            <input type="text" name="recipe_name" class="form-control" placeholder="Recipe Name" value="{{old('recipe_name')}}">
                            @error('recipe_name')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Prep Time (Minutes)</td>
                        <td>
                            <input type="text" name="prep_time" class="form-control" placeholder="Prepration Time in Minutes. Ex. 10" value="{{old('prep_time')}}">
                            @error('prep_time')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </td>
                        <td>Cook Time (Minutes)</td>
                        <td>
                            <input type="text" name="cook_time" class="form-control" placeholder="Cook Time in Minutes. Ex. 15" value="{{old('cook_time')}}">
                            @error('cook_time')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Serves (Person)</td>
                        <td>
                            <input type="text" name="serves" class="form-control" placeholder="How many babies you can serv. Ex. 5" value="{{old('serves')}}">
                            @error('serves')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </td>
                        <td>Recomended Age</td>
                        <td>
                            <input type="text" name="recomended_age" class="form-control" placeholder="Recomended Age for this Recipe" value="{{old('recomended_age')}}">
                            @error('recomended_age')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Ingredients</td>
                        <td colspan="3">
                            <textarea name="ingredients" id="" cols="15" rows="5" class="form-control" placeholder="What ingredients we need to prepare this food">{{old('ingredients')}}</textarea>
                            @error('ingredients')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Step To Recreate</td>
                        <td colspan="3" style="text-align: left">
                            <input type="text" name="steps[]" class="form-control" placeholder='Step 1' value="{{old('steps[]')}}">
                            @error('steps[]')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                            <span id="more"></span>
                            <br>
                            <a class="btn btn-info" id="addMoreStep">Add More Step</a>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn btn-primary" value="Add Recipe"></td>
                        <td colspan="3"></td>
                    </tr>
                </table>
            </form>
        </div>

        
    </div>
</div>
<script src="{{asset('assets/js/jquery-3.6.1.min.js')}}"></script>
<script>
    $(document).ready(function(){
        let c  = 1; 
        $('#addMoreStep').on('click',function(e){
            e.preventDefault();
            c++
            let td = "<div class='new_fild_"+c+"'><hr><input type='text' class='form-control remove_"+c+"' name='steps[]' placeholder='Step "+c+"'><br><a class='btn btn-danger' value='"+c+"' id='removeFild'>Remove</a><hr></div>"
            $('#more').append(td)

            
        })
        $(document).on('click', '#removeFild', function() {
        let test = $(this).attr('value')


        $('.new_fild_' + test).remove()

    });
    })
</script>
@endsection