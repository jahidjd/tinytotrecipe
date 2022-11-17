@extends('front.layout.layout')
@section('body')
@if (Auth::user()->role=='user')
<div class="card-body">
    <div class="col-lg-12 log-md-12 col-xs-12 bodyHeader">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 search">
                <h4 class="ss"><input type="text" placeholder="Search for Recipes" class="in searchName"
                        id="name"><button class="btn btn-defaul se" id="search">Search</button></h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 mainBody">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <h4 class="community">RECIPES</h4>
            </div>

        </div>
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-12 col-xs-12">
                    <div class="row" id="result">

                    </div>

                </div>
                @foreach ($recipes as $key=>$r)
                @if ($key<4) <div class="col-md-3 col-lg-3 col-xs-6 bodyImage">
                   <img src="{{url("recipeImage/$r->image")}}" alt=""
                    class="bodyHeaderImage image-responsive">
                    <h4><a href="{{route('viewRecipe',$r->id)}}" class="addRecipeTag"
                            style="color: black">{{$r->recipe_name}}</a>
                            @if (Auth::user()->id!=$r->user_id)
                              <span id="favorite">
                                <button class="fav btn btn-default" value="{{$r->id}}"><i class="fa-regular fa-star"  ></i></button> 
                              </span>
                            @endif
                            
                            
                            
                        </h4>
            </div>
            @endif
            @endforeach
            {{-- <div class="col-md-3 col-lg-3 col-xs-6" id="result"></div> --}}


            <div class="col-md-12 col-lg-12 col-xs-12">
                <br><br>
                <h5>
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-xs-6">

                            </div>
                            <div class="col-md-3 col-lg-3 col-xs-6 viewAll">
                                {{-- <a href="">View all</a> --}}
                                {{ $recipes->links('pagination::bootstrap-4') }}
                            </div>
                            <div class="col-md-3 col-lg-3 col-xs-6"></div>
                            <div class="col-md-3 col-lg-3 col-xs-6">
                                <span class="addRecipes"><button class="btn btn-primary "><a
                                            href="{{route('addRecipe')}}" class="addRecipeTag">Add
                                            Recipes</a></button></span>
                            </div>
                        </div>
                    </div>


                </h5>


            </div>
        </div>

    </div>
</div>


</div>
<script src="{{asset('assets/js/jquery-3.6.1.min.js')}}"></script>
<script>
    $(document).ready(function() {
//  
$('#search').on('click',function(){
    let data = $('.searchName').val()
    if(data!=''){
    $.ajax({
               type:'get',
               url:'/search',
               
               data: {
                     name: data
                     
                  },
               success:function(data) {
                  let dta = data.data
                  
                  if(dta!=''){
                    let tr =''
                    $.each(dta, function(index, value) {
                        // console.log(value.recipe_name);
                        
                            // tr+= '<div class="row" >'
                            tr += '<div class="col-md-3 col-lg-3 col-xs-3 ">'
                            tr+= '<img src="recipeImage/'+value.image+'" alt="" class="bodyHeaderImage image-responsive">'
                            tr+='<h4><a href="{{route('viewRecipe',$r->id)}}" class="addRecipeTag" style="color: black">'+value.recipe_name+'</a></h4>'
                            tr+='</div>'
                            // tr+='</div>'
                        
                    
                    });
                    
                    $('#result').html(tr)
                    $('.bodyImage').html('')
                  }else{
                    let tr = ''
                    alert('We cann\'t find what you are lookhing for')
                    $('#result').html(tr)
                  }
                  



               }
            });
        }
 })

 $('.fav').on('click',function(){
    let id = $(this).val()
    
    $.ajax({
               type:'get',
               url:'/favorite',
               
               data: {
                     id: id
                     
                  },
               success:function(data) {
                alert(data.status)
                // console.log(data)
                let d =  data.status
                if(d=='success'){
                //    location.reload()
                    // $('#favorite').html('<button class="btn btn-default" onclick="return confirm("You already marked it as favorite")"><i class="fa-solid fa-star"></i></button>')
                }
               }
            });
 })

});
</script>
@endif
@if (Auth::user()->role=='admin')
<div class="card-body">

    <div class="col-md-12 col-lg-12 col-xs-12 mainBody">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <h4 class="community" style="text-align: left; margin-left: 104px">RECIPES</h4>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <table class="table table-bordered">
                    <thead style="background-color: yellow">
                        <tr>
                            <td>Recipe</td>
                            <td>User</td>
                            <td>Review</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipes as $key=>$r)
                        <tr>
                            <td><a href="{{route('viewRecipe',$r->id)}}">{{$r->recipe_name}}</a></td>
                            <td>a{{$r->user->name}}</td>
                            <td >
                                
                                    @if ($r->status=='approved')
                                      <button class="btn btn-primary" onclick="return confirm('You Already Approved this Recipe')">Approved</button>
                                      @else
                                      <h4 id="status">  <button class="btn btn-info status"   value="{{$r->id}}">{{$r->status}}</button></h4>
                                    @endif
                                  
                                
                                
                            </td>
                            <td><a href="{{route('deleteRecipe',$r->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure!!')"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


                
         


            <div class="col-md-12 col-lg-12 col-xs-12">
                <br><br>
                <h5>
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-xs-6">

                            </div>
                            <div class="col-md-3 col-lg-3 col-xs-6 viewAll">
                                {{-- <a href="">View all</a> --}}
                                {{ $recipes->links('pagination::bootstrap-4') }}
                            </div>
                            <div class="col-md-3 col-lg-3 col-xs-6"></div>
                            
                        </div>
                    </div>


                </h5>


            </div>
        </div>

    </div>
</div>


</div>
<script src="{{asset('assets/js/jquery-3.6.1.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.status').on('click',function(){
            let id = $(this).val()
            $.ajax({
                type:'get',
               url:'/recipeStatus',
               
               data: {
                     id: id
                     
                  },
                  success:function(data) {
                    
                    let d = data.status
                    if(d == 'success'){
                        location. reload()
                        // $('#status').html('<button class="btn btn-primary" onclick="return confirm("You Already Approved this Recipe")">Approved</button>')
                    }

                  }
            })
        })
    })
</script>
@endif
@endsection