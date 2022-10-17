@extends('layouts.app')
@section('content')
<div class="container px-4 py-5" id="hanging-icons">
    <h3 class="pb-2 border-bottom display-5 fw-bold">{{__("landing.feat1")}}</h3>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        
        <div class="col d-flex align-items-start">
            <div class="icon-square bg-dark text-white flex-shrink-0 me-3"></div>
            <div>
                <h4>{{__("landing.feat2")}}</h4>
                <p>{{__("landing.feat3")}}</p>
                <!-- <a href="#" class="btn btn-primary">
                    Primary button
                </a> -->
            </div>
        </div>

        <div class="col d-flex align-items-start">
            <div class="icon-square bg-dark text-light flex-shrink-0 me-3"></div>
            <div>
                <h4>{{__("landing.feat4")}}</h4>
                <p>{{__("landing.feat5")}}</p>
                <!-- <a href="#" class="btn btn-primary">
                    Primary button
                </a> -->
            </div>
        </div>

        <div class="col d-flex align-items-start">
            <div class="icon-square bg-dark text-light flex-shrink-0 me-3">
                <!-- <img src="/inculde/free-icon.png" width="50em" height="50em"> -->
            </div>
            <div>
                <h4>{{__("landing.feat6")}}</h4>
                <p>{{__("landing.feat7")}}</p>
                <!-- <a href="#" class="btn btn-primary">
                    Primary button
                </a> -->
            </div>
        </div>
    </div>
</div>
@endsection