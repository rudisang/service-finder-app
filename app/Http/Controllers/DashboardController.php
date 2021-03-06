<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use App\Models\Booking;
use Carbon\Carbon;

use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
     
            $roles = Role::all();
            $users = User::all();
            return view('dashboard.index')->with('roles', $roles)->with('users', $users);
    }

    public function createNewService(){

        if(auth()->user()->role_id == 2){
            if(auth()->user()->service){
                return redirect('/dashboard')->with('error', 'You can only manage one service provider account at a time');
            }else{
                return view('dashboard.create-service');
            }
            
        }else{
            return redirect('/dashboard')->with('error', 'You are not authorized to view that page');
        }
    
    }

    public function storeNewService(Request $request){
       
        $request->validate([
            'title' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'logo' => 'image|max:1999',
            'cover' => 'image|max:1999',
            'address' => 'required|string|max:200',
            'location_lat' => 'required',
            'location_long' => 'required',
            'about' => 'required',
            'gallery'=> 'required',
            'services' => 'required',
            'service_list' => 'required|string|max:100',
        ]);

        if($request->hasFile('logo')){
            $logo = $request->logo->getClientOriginalName().time().'.'.$request->logo->extension();  
          // $request->logo->public_path('logos', $logo);
          $request->logo->move(public_path('logos'), $logo);


        } else {
            $logo = 'no_logo.png';
        }

        if($request->hasFile('cover')){
            $cover = $request->cover->getClientOriginalName().time().'.'.$request->cover->extension();  
       //$request->cover->public_path('documents', $cover);
       $request->cover->move(public_path('covers'), $cover);
       
        }else {
            $cover = 'no_cover.jpg';
        }

        $gallery = array();

        if($request->hasFile('gallery')){
            foreach($request->gallery as $image){
                
                array_push($gallery, $image->getClientOriginalName().time().'.'.$image->extension());
                $image->move(public_path('gallery'), $image->getClientOriginalName().time().'.'.$image->extension());
            }

           // $gallery = $request->gallery->getClientOriginalName().time().'.'.$request->gallery->extension();  
          // $request->gallery->public_path('documents', $gallery);
         // $request->gallery->move(public_path('gallery'), $gallery);
        }
        
        $myArray = explode(',', $request->service_list);
        $list = json_encode($myArray);
        $galleryobj = json_encode($gallery);

        
        $service = new Service;

        $service->user_id = auth()->user()->id;
        $service->title = $request->title;
        $service->logo = $logo;
        $service->cover = $cover;
        $service->category = $request->category;
        $service->address = $request->address;
        $service->location_lat = $request->location_lat;
        $service->location_long = $request->location_long;
        $service->about = $request->about;
        $service->services = $request->services;
        $service->service_list = $list;
        $service->gallery = $galleryobj;

        $service->save();

        return redirect('/dashboard')->with("success", "Your Account has been created");
        
    }

    public function editUser($id){
        $user = User::find($id);

        // Check for correct user
        if(auth()->user()->role_id !== 3){
            return redirect('/dashboard')->with('error', 'You are not authorized to view that page');
        }

        return view('/dashboard.edit-users')->with('user', $user);
    }

    public function editService($id){
        $service = Service::find($id);
        
        // Check for correct user
        if($service->user_id !== auth()->user()->id){
    
                return redirect('/dashboard')->with('error', 'You are not authorized to view that page');
           
        }

        return view('/services.edit')->with('service', $service);
    }

    public function updateService(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'address' => 'required|string|max:200',
            'location_lat' => 'required',
            'location_long' => 'required',
            'about' => 'required',
            'services' => 'required',
            'service_list' => 'required|string|max:100',
        ]);

        $myArray = explode(',', $request->service_list);
        $list = json_encode($myArray);

        $service = Service::find($id);

        $service->title = $request->title;
        $service->category = $request->category;
        $service->address = $request->address;
        $service->location_lat = $request->location_lat;
        $service->location_long = $request->location_long;
        $service->about = $request->about;
        $service->services = $request->services;
        $service->service_list = $list;

        $service->save();

        return back()->with("success", "Changes Successful");
    }

    public function updateServiceImages(Request $request, $id){

        $service = Service::find($id);
        
        if($request->hasFile('logo')){
            $request->validate([
                'logo' => 'image|max:1999',
               
            ]);
            $logo = $request->logo->getClientOriginalName().time().'.'.$request->logo->extension();  
          // $request->logo->public_path('logos', $logo);
          $request->logo->move(public_path('logos'), $logo);


        } else {
            $logo = $service->logo;
        }

        if($request->hasFile('cover')){
            $request->validate([
              
                'cover' => 'image|max:1999'
            ]);
            $cover = $request->cover->getClientOriginalName().time().'.'.$request->cover->extension();  
       //$request->cover->public_path('documents', $cover);
       $request->cover->move(public_path('covers'), $cover);
       
        }else {
            $cover = $service->cover;
        }

        $service->logo = $logo;
        $service->cover = $cover;
      
        $service->save();
        return back()->with('success', 'images updated');
    }

    public function editAccount(){
        return view('dashboard.edit-account');
    }

    public function updatePassword(Request $request, $id){
        $user = User::find($id);

        $oldpass = $request->old_pass;
        $newpass = $request->new_pass;
        $confpass = $request->conf_pass;

        if (Hash::check($oldpass, $user->password)) {
            if($newpass == $confpass){
                $request->validate([
                    'new_pass' => 'required|string|min:6',
                    'conf_pass' => 'required|string|min:6',
                    'old_pass' => 'required|string|min:6',
                ]);

                $user->password = Hash::make($request->new_pass);
                $user->save();
                return back()->with("success", "Awesome! Password Updated");

            }else{
                return back()->with("error", "New Password & Confirm Password Don't Match");
            }
        }else{
            return back()->with("error", "The password you entered does not match your current password");

        }


    }

    public function updateDetails(Request $request, $id){
       
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'age' => 'required|date',
            'mobile' => 'required',
            'role_id' => 'required',
        ]);

		$user = User::find($id);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->mobile = $request->mobile;
        $user->role_id = intval($request->role_id);

    
            
        $user->save();
        return back()->with("success", "Details Updated Successfully");

    }

    public function deleteUser($id){
       
		$user = User::find($id);
       
        $user->delete();
        return redirect('/dashboard')->with("success", "User id:".$user->id." Successfully Deleted");

    }
    public function createUser(){
        $roles = Role::all();
     return view('dashboard.create-user')->with('roles', $roles);
    }

    public function storeNewUser(Request $request){
        $agelimit = date("2003-12-29");
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'age' => 'required|date|before:'.$agelimit,
            'mobile' => 'required',
            'role_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'age' => $request->age,
            'mobile' => $request->mobile,
            'role_id' => intval($request->role_id),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

       

        return redirect('/dashboard')->with('success', 'New User Added');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookingForm($id)
    {
        $service = Service::find($id);
        return view('services.booking')->with('service',$service);
    }

    public function book(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date|after:today',
            'start_time' => 'required',
        ]);

        $start = date($request->start_date." ".$request->start_time);

        $start_date = Carbon::parse($start);
        
        
        //$start  = concat($request->start_date, ' ', strtotime($request->start_time));
        $timestamp = strtotime($request->start_time) + 120*60;

        $time = date('H:i', $timestamp);

        $end = date($request->start_date." ".$time);
        $end_date = Carbon::parse($end);
       
        //$end  = concat($request->start_date, ' ', $time);
        

        $service = Service::find($id);

        Booking::create([
            'title' => $request->title,
            'start' => $start_date,
            'end' => $end_date,
            'service_id' => $id,
            'user_id' => Auth::user()->id,
            'confirmed' => 0,
            'message' => null,
            
        ]);
      
        return redirect('/dashboard')->with('success','Appointment Request Successful');
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
    public function approveBooking(Request $request, $id)
    {
        $request->validate([
            'approve' => 'required',
        ]);

        $booking = Booking::find($id);
        $booking->confirmed = $request->approve;
        if($request->has('message')){
            $booking->message = $request->message; 
        }else{
            $booking->message = null;   
        }

        $booking->save();

        return back()->with('success','Booking Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelBooking($id)
    {
        $booking = Booking::find($id);
      
        $booking->delete();
   
 
        return redirect('/dashboard')->with("success", "Your Booking Has Been Cancelled");
    }

    public function allBookings()
    {

        return view('dashboard.all-bookings');
    }
}
