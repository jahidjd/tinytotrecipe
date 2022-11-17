@extends('front.layout.layout')
@section('body')

<div class="card-body">
    <div class="col-lg-12 log-md-12 col-xs-12 bodyHeader">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 search">
                <h4 class="addRe">Your Recipe Details</h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 mainBody">
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xs-12">

                    <h4 style="text-align: left">
                        
                        @if ($favorite!=NULL)
                        @if ($favorite->recipe_id==$recipe->id)
                        <i class="fa-solid fa-heart" style="color: red"></i>
                        @endif
                        @endif


                       
                        {{$recipe->recipe_name}} ({{$recipe->status}})
                            {{-- ratigs start --}}
                           @if (Auth::user()->role=='user' && Auth::user()->id!=$recipe->user_id)
                                @if ($singleRating==false)
                                <button class="btn btn-default fa fa-star cl" value="1"></button>
                                <button class="btn btn-default fa fa-star cl" value="2"></button>
                                <button class="btn btn-default fa fa-star cl" value="3"></button>
                                <button class="btn btn-default fa fa-star cl" value="4"></button>
                                <button class="btn btn-default fa fa-star cl" value="5"></button>
                                @elseif($singleRating==true)
                                    @if ($ratings!='')
                                        @if ($ratings->remarks=='1')
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        @elseif($ratings->remarks=='2')
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        @elseif($ratings->remarks=='3')
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        @elseif($ratings->remarks=='4')
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        @elseif($ratings->remarks=='5')
                                            <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                            <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                            <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                            <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                            <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                                        @endif
                                       {{'( '.$ratings->remarks.' )'}}
                                       @elseif($ratings=='')
                                       <button class="btn btn-default fa fa-star cl" value="1"></button>
                                       <button class="btn btn-default fa fa-star cl" value="2"></button>
                                       <button class="btn btn-default fa fa-star cl" value="3"></button>
                                       <button class="btn btn-default fa fa-star cl" value="4"></button>
                                       <button class="btn btn-default fa fa-star cl" value="5"></button>
                                    @endif
                                @endif
                           @endif

                            
                            
                        


                    </h4>
                    {{-- <button class="btn btn-default fa fa-star cl" value="1"></button>
                    <button class="btn btn-default fa fa-star" style="color: rgb(180, 180, 10)"></button>
                    --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Prep Time</th>
                                <th>Cook Time</th>
                                <th>Serves</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$recipe->prep_time}}</td>
                                <td>{{$recipe->cook_time}}</td>
                                <td>{{$recipe->serves}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Total Reviewd
                    @if($totalStatus=='done')
                      {{"( ".$count." )"}}  persons & total ratings
                      {{"( ".$total."* )"}}  
                    @endif
                    </p>
                    <br><br>
                    <h5 style="text-align: left">Ingredients</h5>
                    <hr style="font-size: 30px">
                    <p style="text-align: left">{{$recipe->ingredients}}</p>
                    <br><br>
                    <h5 style="text-align: left">Steps</h5>
                    <hr style="font-size: 30px">
                    <?php $steps = json_decode($recipe->steps); ?>
                    @foreach ($steps as $s)
                    <li style="text-align: left">{{$s}}</li>
                    @endforeach
                </div>
                <div class="col-md-6 col-lg-6 col-xs-12">
                    <img src="{{url("recipeImage/$recipe->image")}}" alt="" width="400" height="250"
                    class="image-responsive viewImage"><br><br>
                    @if ($recipe->video!='')
                    <iframe width="400" height="250" src="{{$recipe->video}}">
                        @endif
                    </iframe>
                </div>
            </div>

        </div>


    </div>
</div>
<script src="{{asset('assets/js/jquery-3.6.1.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.cl').on('click',function(){
            let v = $(this).val()
            let racipe_id = {{$recipe->id}}
            // console.log(racipe_id);
            $.ajax({
                type:'get',
               url:'/ratings',
               
               data: {
                     remarks : v,
                     racipe_id : racipe_id
                     
                  },
               success:function(data){
                console.log(data.status);
                location.reload()
               }
            })
        })
    })
</script>

@endsection