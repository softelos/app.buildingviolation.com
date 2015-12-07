@extends('layouts/home')

@section('pageName','Home')

@section('content')

   <section id="register">  

        <div class="row">
            <div class="col-md-6">
                <div class="price-box customer">
                    <header>
                        <h2>I want to hire professionals</h2>
                        <h3>Get introduced to the right contractor for your violation!</h3>
                        <a href="{{url('signup-customer')}}" class="btn btn-default orange">I need a Pro</a>
                    </header>
                </div>
            </div>
            <div class="col-md-6">
                <div class="price-box pro">
                    <header>
                        <h2>I want to work on violations</h2>
                        <h3>Respond to customers requests and get hired!</h3>
                        <a href="{{url('signup-pro')}}" class="btn btn-default orange">I'm a Pro</a>
                    </header>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 center">
                <p>Already have an account? <a href="{{url('/sign-in')}}">Sign in</a></p>
            </div>
        </div>

    </section>
	
@endsection


