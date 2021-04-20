@extends('layouts.dashboard')
@section('breadcrumb')
<nav aria-label="breadcrumb" >
    <div class="container">
    <ol class="breadcrumb mt-4" style="background:#fff;max-width:400px;">
      <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item" aria-current="page">{{Auth::user()->role->role}} Account</li>
      <li class="breadcrumb-item active" aria-current="page">Bookings</li>
     
    </ol>
  </div>
  </nav>
@endsection

@section('content')
<section class="container my-4 dis-none">
    <x-flash-messages />
</section>

<section class="container my-4 dis-none">
    <div class="card" style="border:none;border-radius:20px">
        <x-bookings-table />     
    </div>
  </section>

@endsection