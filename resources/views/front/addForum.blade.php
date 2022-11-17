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
                <h4 class="community">Create Forum</h4>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12">
                    <form action="{{'saveForum'}}" method="post">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <td>Forum Title</td>
                                <td>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Forum Name">
                                    @error('name')
                                        <span style="color:red">{{$message}}</span>
                                    @enderror
                                </td>
                                <td>Discussion Topic</td>
                                <td>
                                    <input type="text" name="discussion_topic" class="form-control" placeholder="Discussion Topic" value="{{old('discussion_topic')}}">
                                    @error('discussion_topic')
                                        <span style="color:red">{{$message}}</span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" class="btn btn-primary"></td>
                                <td colspan="3"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                
            </div>

        </div>
    </div>
</div>



@endsection


