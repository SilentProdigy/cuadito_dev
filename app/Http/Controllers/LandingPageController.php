<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionType;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::check()) {
            $data = [
                'auth_text' => 'Dashboard',
                'auth_url' => "client.dashboard",
            ];
        }else{
            $data = [
                'auth_text' => 'Login',
                'auth_url' => "client.auth.show-login-form",
            ];
        }

        return view('landing-page/home')->with(compact('data'));
    }
    public function about()
    {   
        return view('landing-page/about');
    }
    public function projects()
    {   
        return view('landing-page/projects');
    }
    public function pricing()
    {   
        $products = SubscriptionType::get();
        $latest_subscription = auth('client')->user()->active_subscription;

        return view('landing-page/pricing')->with(compact('products', 'latest_subscription'));
    }
    public function contact()
    {   
        return view('landing-page/contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
