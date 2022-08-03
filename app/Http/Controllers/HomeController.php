<?php

namespace App\Http\Controllers;

use App\Models\Tweets;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tweets = Tweets::with('user')->orderBy('created_at','desc')->where('is_public', 1)->get();
        $user = User::find(Auth::user()->id);

        return view('home')->with(['user' => $user, 'tweets' => $tweets]);
    }

    public function store(Request $request)
    {
        $validated = (array) $request->all();
        Log::debug($validated);

        if ($request->file('image')) {
            $thumb_path = $request->file('image')->storeAs(
                'public/tweet_img',
                time() . '.' . $request->file('image')->extension()
            );
            $validated['image'] = basename($thumb_path);
        }
        $validated['user_id'] = Auth::user()->id;
        $validated['is_public'] = $validated['is_public'] === 'public' ? 1 : 0;

        Tweets::create($validated);
        
        return redirect()->route('home');
    }

    public function load()
    {
        try {
            $tweets['body'] = Tweets::with('user')->orderBy('created_at')->where('is_public', 1)->get();
            return response()->json($tweets, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
}
