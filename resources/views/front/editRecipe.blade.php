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
            
            <form action="{{route('updateRecipe',$recipe->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf
                @method('put')
                <table class="table table-bordered">
                    <tr>
                        <td>Image</td>
                        <td>
                            <input type="file" name="image" class="form-control">
                            <img src="{{url("recipeImage/$recipe->image")}}" alt="" width="150px"  class="image-responsive">
                        </td>
                        <td>Video (Optional)</td>
                        <td><input type="text" name="video" class="form-control" placeholder="Video Link" value="{{$recipe->video}}"></td>
                    </tr>
                    <tr>
                        <td>Recipe Name</td>
                        <td colspan="3">
                            <input type="text" name="recipe_name" class="form-control" placeholder="Recipe Name" value="{{$recipe->recipe_name}}">
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Prep Time (Minutes)</td>
                        <td>
                            <input type="text" name="prep_time" class="form-control" placeholder="Prepration Time in Minutes. Ex. 10" value="{{$recipe->prep_time}}">
                            
                        </td>
                        <td>Cook Time (Minutes)</td>
                        <td>
                            <input type="text" name="cook_time" class="form-control" placeholder="Cook Time in Minutes. Ex. 15" value="{{$recipe->cook_time}}">
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Serves (Person)</td>
                        <td>
                            <input type="text" name="serves" class="form-control" placeholder="How many babies you can serv. Ex. 5" value="{{$recipe->serves}}">
                            
                        </td>
                        <td>Recomended Age</td>
                        <td>
                            <input type="text" name="recomended_age" class="form-control" placeholder="Recomended Age for this Recipe" value="{{$recipe->recomended_age}}">
                           
                        </td>
                    </tr>
                    <tr>
                        <td>Ingredients</td>
                        <td colspan="3">
                            <textarea name="ingredients" id="" cols="15" rows="5" class="form-control" placeholder="What ingredients we need to prepare this food">{{$recipe->ingredients}}</textarea>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Step To Recreate</td>
                        <td colspan="3" style="text-align: left">
                            <?php $steps = json_decode($recipe->steps); $k =0; ?>
                            @foreach ($steps as $s)
                            <?php $k++ ?>
                              <input type="text" name="steps[]" class="form-control" placeholder='Step 1' value="{{$s}}"><br>
                            @endforeach
                            
                            
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
        let c  = {{$k}}; 
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