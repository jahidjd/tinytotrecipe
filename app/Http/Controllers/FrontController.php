<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Recipe;
use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Rating;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Image;
use Carbon\Carbon;

class FrontController extends Controller
{
    function index(){
        if(Auth::user()){
            $data = Auth::user();
            $recipe = Recipe::latest()->get();
            if($recipe!=''){
                return view('front.index',compact('data','recipe'));   
            }
            return view('front.index',compact('data')); 
        }
        $recipe = Recipe::latest()->get();
        return view('front.index',compact('recipe'));
    }
    function recipes(){
        if(Auth::user()){
            $data = Auth::user();
            $fav = Favorite::get();
            $recipes = Recipe::latest()->paginate(4);
            return view('front.recipes',compact('data','recipes','fav')); 
        }
        return view('front.index');
    }
    function addRecipe(){
        if(Auth::user()){
            $data = Auth::user();
            return view('front.addRecipe',compact('data')); 
        }
        return view('front.index');
    }
    function insertRecipe(Request $request){
        // dd($request);
        $request->validate([
            'recipe_name'=>'required',
            'image'=>'required',
            'ingredients'=>'required',
            'prep_time'=>'required',
            'cook_time'=>'required',
            'steps'=>'required',
            'recomended_age'=>'required',
            'serves'=>'required',
        ]);
        $data = [
            'recipe_name'=>$request->recipe_name,
            'ingredients'=>$request->ingredients,
            'prep_time'=>$request->prep_time,
            'cook_time'=>$request->cook_time,
            'video'=>$request->video,
            'recomended_age'=>$request->recomended_age,
            'steps'=>json_encode($request->steps),
            'serves'=>$request->serves,
            'user_id'=>Auth::user()->id
        ];

        // $photo = $request->file('image');
        $image = Image::make($request->file('image'));
        $imageName = $request->recipe_name.'-'.time().'-'.$request->file('image')->getClientOriginalName();
        $destinationPath = public_path('recipeImage/');
        $image->resize(306,204);
        $image->save($destinationPath.$imageName);
        // $path = 'recipeImage/';
        // $fileName = $request->recipe_name.date('YmdHis').'.'.$photo->getClientOriginalExtension();
        // $photo->move($path,$fileName);
        $data['image']=$imageName;
        $result = Recipe::create($data);
        return redirect()->route('recipeList')->with('success','Recipe has been uploaded successfully!.');
    }
    function recipeList(){
        if(Auth::user()){
            $id = Auth::user()->id;
            $recipe = Recipe::where('user_id',$id)->latest()->paginate(5);
            // dd($recipe);
            return view('front.recipeList',compact('recipe'));
        }
        return view('front.index');
        
    }

    function viewRecipe($id){
        if(Auth::user()){
            
            $recipe = Recipe::where('id',$id)->first();
            $favorite = Favorite::where('recipe_id',$id)->where('user_id',Auth::user()->id)->first();
            $ratings = Rating::where('recipe_id',$id)
            ->where('user_id',Auth::user()->id)
            ->first();
            $totalRatings = Rating::where('recipe_id',$id)->sum('remarks');
            $counts = Rating::where('recipe_id',$id)->get();
            $count = count($counts);
             
            $singleRating =false;
            $totalStatus = false;
            
            //   dd(\round($totalRatings/$count,0));
             if($ratings!='' || $totalRatings!='' || $count!=0){
                $singleRating = true;
                    $totalStatus = 'done';
                    if($count!=0){
                        $totals = $totalRatings/$count;
                        $total = round($totals,0);
                        return view('front.recipeDetails',compact('totalStatus','ratings','recipe','favorite','total','singleRating','count'));
                    }
                    $total = 0;
                    
                    return view('front.recipeDetails',compact('totalStatus','ratings','recipe','favorite','total','singleRating','count'));
                
             }else{
                return view('front.recipeDetails',compact('recipe','favorite','singleRating','totalStatus'));
             }
             
             
             
             
            
        }
        return view('front.index');
    }

    function editRecipe($id){
        if(Auth::user()){
            
            $recipe = Recipe::where('id',$id)->first();
            //  dd($recipe);
            return view('front.editRecipe',compact('recipe'));
        }
        return view('front.index');
    }
    function updateRecipe(Request $request, $id){
        $recipe =  Recipe::find($id);
        $data = [
            'recipe_name'=>$request->recipe_name,
            'ingredients'=>$request->ingredients,
            'prep_time'=>$request->prep_time,
            'cook_time'=>$request->cook_time,
            'video'=>$request->video,
            'recomended_age'=>$request->recomended_age,
            'steps'=>json_encode($request->steps),
            'serves'=>$request->serves,
            'user_id'=>Auth::user()->id
        ];
        
        if($request->file('image')){
            $image = Image::make($request->file('image'));
            
            $imageName = $request->recipe_name.'-'.time().'-'.$request->file('image')->getClientOriginalName();
            $destinationPath = public_path('recipeImage/');
            $image->resize(306,204);
            $image->save($destinationPath.$imageName);
        // $path = 'recipeImage/';
        // $fileName = $request->recipe_name.date('YmdHis').'.'.$photo->getClientOriginalExtension();
        // $photo->move($path,$fileName);
        $data['image']=$imageName;
        }
        
        $result = $recipe->update($data);
        if($result){
            return redirect()->route('recipeList')->with('success','Recipe has been updated successfully!.');
        }
        
    }
    function deleteRecipe($id){
        $recipe =  Recipe::find($id);
        $result = $recipe->delete();
        if($result){
            return back()->with('success','Recipe has been deleted successfully!.');
        }
    }
    // recipe search
     function search(Request $request){
        $name = $request->name;
        $res = Recipe::where("recipe_name","LIKE","%{$name}%")->get();
        
        

        return response()->json([
            'status'=>'true',
            'data'=>$res
        ]);
     }

     function forum(){
        $forum = Forum::latest()->paginate(5);
        return view('front.forum',compact('forum'));
     }
     function addForum(){
        if(Auth::user()){       
            return view('front.addForum');
        }
        return view('front.index');
     }
     function saveForum(Request $request){
        $request->validate([
            'name'=>'required',
            'discussion_topic'=>'required',
        ]);
        $data = [
            'name'=>$request->name,
            'discussion_topic'=>$request->discussion_topic,
            'user_id'=>Auth::user()->id,
        ];
        $re = Forum::create($data);
        if($re){
            return redirect()->route('forum')->with('success','Forum added successfully!.');
        }
     }
     function forumDiscussion($id){
        $forum = Forum::where('id',$id)->first();
        $post = Post::where('forum_id',$id)->paginate(3);
        return view('front.forumDiscussion',compact('forum','post'));
     }
     function addPost(Request $request){
        $data = [
            'post'=>$request->post,
            'forum_id'=>$request->forum_id,
            'user_id'=>Auth::user()->id,
        ];
        $r = Post::create($data);
        return back()->with('success','Comment posted successfully!.');
     }
     function profile(){
        $user = Auth::user();
        $users = User::paginate(5);
        $recipe = Recipe::where('user_id',Auth::user()->id)->where('status','approved')->paginate(5);
        $notification = Notification::where('user_id',Auth::user()->id)->paginate(3);
        return view('front.profile',compact('user','recipe','users','notification'));
     }
     function updateProfile(Request $request){
        $id = $request->id;
        $user = User::where('id',$id);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ];
       $r = $user->update($data);
        if($r){
            return back()->with('success','Profile Updated successfully!.');
        }

     }
    //  report for the Admin 
    function report(){
       $user = Auth::user();
        $ratings = Rating::orderBy('remarks','DESC')->get();
        
      
        return view('front.report',compact('user','ratings'));
    }
    function update(Request $request,$id){
        $user = User::where('id',$id)->first();
        $data = [
            'role'=>$request->role,
        ];
        $user->update($data);
        return back()->with('success','Role has been updated successfully!.');
    }
    // admin login

    function adminLogin(){
        return view('front.adminLogin');
    }
    function recipeStatus(Request $request){
        $id = $request->id;
        $re = Recipe::where('id',$id)->first();
        $data = [
            'status'=>'approved'
        ];
        $re->update($data);
        return response()->json([
            'status'=>'success'
        ]);
    }
    function favorite(Request $request){
        $id = $request->id;
        $user_id = Auth::user()->id;
        $data = [
            'user_id'=>$user_id,
            'recipe_id'=>$id
        ];
        $ss = Favorite::where('recipe_id',$id)->where('user_id',Auth::user()->id)->first();
        if(empty($ss)){
            $r = Favorite::create($data);
            if($r){
                return response()->json([
                    'status'=>'success'
                ]);
            }
        }else{
            return response()->json([
                'status'=>'already added'
            ]);
        }
        
        
    }
    function favoriteList(){
        $favorite = Favorite::where('user_id',Auth::user()->id)->latest()->paginate(5);
        return view('front.favoriteList',compact('favorite'));
    }
    function ratings(Request $request){
        $data = [
            'user_id'=>Auth::user()->id,
            'recipe_id'=>$request->racipe_id,
            'remarks'=>$request->remarks
        ];
        
        $rr = Rating::where('recipe_id',$request->racipe_id)->where('user_id',Auth::user()->id)->first();
        if(empty($rr)){
            $r = Rating::create($data);
            if($r){
                return response()->json([
                    'status'=>'success'
                ]);
            }
        }
        if($rr){
            return response()->json([
                'status'=>'already added'
            ]);
        }
        
    }
    function deleteForam($id){
        $f = Forum::where('id',$id)->first();
        $r = $f->delete();
        if($r){
            $n = Notification::create(['user_id'=>$f->user_id, 'message'=>'Your Forum Has been Deleted by the Admin!']); 
            return back()->with('success','forum has been deleted successfully');
        }
        
    }
    function deleteUser($id){
        $user = User::where('id',$id)->first();
        $user->delete();
        return back()->with('success','User has been deleted successfully');
    }
    function deleteFav($id){
        $fav = Favorite::where('id',$id)->first();
        $fav->delete();
        return back()->with('success','Remove From the Favorite List');
    }
    function reportSearch(Request $request){
        $request->validate([
            'start_date'=>'required',
            'end_date'=>'required',
        ]);

        $dt = Carbon::now();
       
        $startDate = $request->start_date.' '.$dt->toTimeString();
        
        $endDate = $request->end_date.' '.$dt->toTimeString();
        $ratings = Rating::whereBetween('created_at', [$startDate, $endDate])->orderBy('remarks','DESC')->get();
       
        // dd($ratings);
        $user = User::where('id',Auth::user()->id)->first();
        return view('front.repostSearch',compact('ratings','user'));
        
    }
  
    
}
