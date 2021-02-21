<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\UserFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function feed(Request $request){
        $input = $request->all();
        $searchVal = (isset($input['search']) && !empty($input['search']) && $request->isMethod('post')) ? $input['search'] : null;

        $followedUserIds = User::leftJoin('user_followers', 'user_followers.user_id', '=', 'users.id')
                     ->where('user_followers.follower_id',Auth::user()->id)
                     ->select('users.id')
                     ->pluck('id')
                     ->toArray();

        array_push($followedUserIds, Auth::user()->id);
        $followedUserIds = array_unique($followedUserIds);

        $posts = Post::join('users','users.id','=','posts.user_id')->whereIn('users.id',$followedUserIds);
      
        if($searchVal){
            $posts = $posts->where('posts.text', 'like', '%' . $searchVal . '%');
        }

        $posts = $posts->select(['users.id','users.name','posts.id','posts.text','posts.created_at'])
                        ->get()
                        ->sortBy('posts.created_at');

        $users = User::with('followers')
                       ->where('id','!=',Auth::user()->id)
                       ->get();

        return view('posts.home',compact('posts','users','searchVal'));
    }

    public function create(Request $request){
        return view('posts.create');
    }

    public function store(Request $request){
        $input = $request->all();
        $input['user_id']=Auth::user()->id;

        $post = Post::create($input);
        if($post){
            Session::flash('flash.message', "Post submitted successfully.");
            Session::flash('flash.class', 'success');
            return redirect()->route('home')->with(['success'=>true]);
        }else{
            Session::flash('flash.message', "Post submitted unsuccessfully");
            Session::flash('flash.class', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function follow($user_id){
        $input['user_id'] = $user_id;
        $input['follower_id'] = Auth::user()->id;
        $userFollower = UserFollower::create($input);

        if($userFollower){
            Session::flash('flash.message', "You have followed successfully.");
            Session::flash('flash.class', 'success');
            return redirect()->route('home')->with(['success'=>true]);
        }else{
            Session::flash('flash.message', "You have followed unsuccessfully.");
            Session::flash('flash.class', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function unfollow($user_id){
        $userFollower = UserFollower::where('user_id',$user_id)->where('follower_id',Auth::user()->id)->delete();

        if($userFollower){
            Session::flash('flash.message', "You have unfollowed successfully.");
            Session::flash('flash.class', 'success');
            return redirect()->route('home')->with(['success'=>true]);
        }else{
            Session::flash('flash.message', "You have unfollowed unsuccessfully.");
            Session::flash('flash.class', 'error');
            return redirect()->back()->withInput();
        }
    }
}
