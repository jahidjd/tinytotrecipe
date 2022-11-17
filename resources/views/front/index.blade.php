@extends('front.layout.layout')
@section('body')
<div class="card-body">
    <div class="col-lg-12 log-md-12 col-xs-12 bodyHeader">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xs-12 bodyHeaderText">
                <h4 class="babyFoodiesText">Baby Foodies</h4>
                <h5 class="babyFoodiesTextShort">Baby-led Weaning <span class="app">APP</span>roved </h5>
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 search">
                {{-- <div class="col-md-12 col-lg-12 col-xs-12 search"> --}}
                    <h4 class="ss"><input type="text" placeholder="Search for Recipes" class="in searchName"
                            id="name"><button class="btn btn-defaul se" id="search">Search</button></h4>
                {{-- </div> --}}
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12">
                <img src="{{url('assets/image/baby-2423896_960_720.jpg')}}" alt=""
                    class="bodyHeaderImage image-responsive">
            </div>
            
        </div>
       
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 mainBody">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <h4 class="community">JOIN OUR COMMUNITY</h4>
            </div>

        </div>
        <div class="container">
            
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12">
                    <div class="row" id="result">

                    </div>

                </div>
                @forelse ($recipe as $key=>$r)
                @if ($key<4) <div class="col-md-3 col-lg-3 col-xs-6 bodyImage">
                    <img src="{{url("recipeImage/$r->image")}}" alt=""
                    class="bodyHeaderImage image-responsive">
                    @if (Auth::user()!='')
                    <h4><a href="{{route('viewRecipe',$r->id)}}" class="addRecipeTag"
                        style="color: black">{{$r->recipe_name}}</a></h4>
                        @else
                        <h4><a href="#" class="addRecipeTag"
                            style="color: black" onclick="return confirm('You Have to Login first to see the Details')">{{$r->recipe_name}}</a></h4>
                    @endif
                    
            </div>
            @endif
                @empty
                    
                @endforelse
                
                
                @if (Auth::user()=='')
                <div class="col-md-12 col-lg-12 col-xs-12">
                    {{-- <button class="btn  reg" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="fa-solid fa-user"></i> Registration / Login</button> --}}
                    <button class="btn  reg" data-bs-toggle="modal" href="#exampleModalToggle"><i
                            class="fa-solid fa-user"></i> Registration / Login</button>
                </div>
                @endif
            </div><br><br><br>

        </div>
    </div>
</div>

{{-- popup for login and registration --}}
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td>Your Name</td>
                            <td>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Your Email</td>
                            <td>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </td>
                        </tr>

                    </table>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Register</button>
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Login</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- end of the registration --}}
{{-- start login popup --}}
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td>Your Email</td>
                            <td>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Your Password</td>
                            <td>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                    </table>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Back to Registration</button>
                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                <button class="btn btn-primary" type="submit">Login</button>
                </form>
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
                  
                //   if(data.status=='true'){
                //     let dta = data.data
                //   if(dta!=''){
                //     let tr =''
                //     $.each(dta, function(index, value) {
                //         // console.log(value.recipe_name);
                        
                        
                //             // tr+= '<div class="row" >'
                //             tr += '<div class="col-md-3 col-lg-3 col-xs-3 ">'
                //             tr+= '<img src="recipeImage/'+value.image+'" alt="" class="bodyHeaderImage image-responsive">'
                //             tr+='<h4><a href="{{route('viewRecipe',$r->id)}}" class="addRecipeTag" style="color: black">'+value.recipe_name+'</a></h4>'
                //             tr+='</div>'
                //             // tr+='</div>'
                           
                    
                //     });
                    
                //     $('#result').html(tr)
                //     $('.bodyImage').html('')
                //   }else{
                //     let tr = ''
                //     alert('We cann\'t find what you are lookhing for')
                //     $('#result').html(tr)
                //   }
                // }
                  



               }
            });
        }
 })



});
</script>
@endsection


