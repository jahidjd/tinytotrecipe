@extends('front.layout.layout')
@section('body')
<div class="card-body">
    <div class="col-lg-12 log-md-12 col-xs-12 bodyHeader">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 search">
                <h4 class="addRe">FORUMS</h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 mainBody">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <h4 class="community">Forum List</h4>
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
                        <thead style="background-color: yellow">
                            <tr>
                                <td>SL</td>
                                <td>Forum Name</td>
                                <td>Discussion Topic</td>
                                <td>Added By</td>
                                <td>Discussion</td>
                                @if (Auth::user())
                                    @if (Auth::user()->role=='admin')
                                        <td>Action</td>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($forum as $key=>$f)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$f->name}}</td>
                                    <td>{{$f->discussion_topic}}</td>
                                    <td>{{$f->user->name}}</td>
                                    <td>
                                        <a href="{{route('forumDiscussion',$f->id)}}" class="btn btn-info">Discussions</a>
                                        
                                    </td>
                                    @if (Auth::user())
                                    @if (Auth::user()->id == $f->user_id || Auth::user()->role=='admin')
                                        <td>
                                            <a href="{{route('deleteForam',$f->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure!!')"><i class="fa-solid fa-trash"></i></a>

                                        </td>
                                    @endif
                                @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $forum->links('pagination::bootstrap-4') }}
                </div>
                @if (Auth::user())
                @if (Auth::user()->role=='user')
                <div class="col-md-12 col-lg-12 col-xs-12">
                    
                    <br><br><br>
                    <button class="btn btn-primary"><a href="{{'addForum'}}" class="addRecipeTag">Create Forum</a></button>
                </div>
                @endif
                
                @else
                <div class="col-md-12 col-lg-12 col-xs-12">
                    {{-- <button class="btn  reg" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                            class="fa-solid fa-user"></i> Registration / Login</button> --}}
                    <button class="btn  reg" data-bs-toggle="modal" href="#exampleModalToggle"><i
                            class="fa-solid fa-user"></i> Registration / Login</button>
                </div>
                @endif
                
            </div>

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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                <button class="btn btn-primary" type="submit">Login</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a>
--}}