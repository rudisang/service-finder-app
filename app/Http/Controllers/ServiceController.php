<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Rating;
use Illuminate\Http\Request;
use Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index')->with('services', $services);
    }

    public function rate(Request $request)
    {
        if(auth()->user()){
            $request->validate([
                'rating' => 'required',
            ]);
    
            $id = intval($request->id);
            $rating = new Rating;
    
            $rating->rating = intval($request->rating);
            if($request->has('review')){
                $rating->review = $request->review;
            }
            $rating->user_id = auth()->user()->id;
            $rating->service_id = $id;
    
            

            $rating->save();

            return back()->with('success', 'Thank you for your feedback');
        }else{
         return back()->with('error', 'You need to be logged in to post a review');
        }
       
     
    }


    public function apiGetAllServices()
    {
        $products = Service::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
     
    }

    public function search(Request $request) {
        // get the search term
        $search = $request->input('text');
  
        // search the members table
        $services = Service::where('title', 'like', '%'.$search.'%')->get();
    
    
        // return the results
        return response()->json($services);
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return view('services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
