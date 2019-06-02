<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserFollowController extends Controller
{
    public function store(Request $request, $id) {
        
        \Auth::user()->follow($id);
        
        return back();
    }
    
    public function destroy($id) {
        
        \Auth::user()->unfollow($id);
        
        return back();
    }
}
