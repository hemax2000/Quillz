@extends('layouts.app')
@section('content')
                <!-- About Us
            ===================================== -->
            <div class="content-wrap">
                <div class="container clearfix">
                    <div class=" text-secondary px-4 py-5 text-center row justify-content-center gutter-50 col-mb-30">
                        <div class="py-5">
                            <h1 class="display-5 fw-bold ">{{__('landing.about1')}}</h1>
                                <div class="col-lg-6 mx-auto">
                                    <p class="fs-5 mb-4">{{__('landing.about2')}}</p>
                                </div>
                        </div>
                    
                        <div class="col">
                            <div class="d-flex align-items-center border border-default rounded">
                                <img width="100" height="100" src="https://i.pinimg.com/564x/64/5a/97/645a97899b437f047f4f88bee2e7755c.jpg" alt="Author" class="rounded-start me-3 h-100">
                                <div class="ps-3">
                                    <h5 class="mb-0 ml-3 mr-3">{{__('text.baderName')}}</h5>
                                    <!-- <h5 class="text-muted mb-0 fw-normal">CEO</h5> -->
                                </div>
                            </div>
                        </div>
    
                        <div class="col">
                            <div class="d-flex align-items-center border border-default rounded-3">
                                <img width="100" height="100" src="https://i.pinimg.com/564x/64/5a/97/645a97899b437f047f4f88bee2e7755c.jpg" alt="Author" class="rounded-start me-3 h-100">
                                <div class="ps-3">
                                    <h5 class="mb-0">{{__('text.ibrahimName')}}</h5>
                                    <!-- <h5 class="text-muted mb-0 fw-normal">CTO</h5> -->
                                </div>
                            </div>
                        </div>
    
                        <div class="col">
                            <div class="d-flex align-items-center border border-default rounded-3">
                                <img width="100" height="100" src="https://i.pinimg.com/564x/64/5a/97/645a97899b437f047f4f88bee2e7755c.jpg" alt="Author" class="rounded-start me-3 h-100">
                                <div class="ps-3">
                                    <h5 class="mb-0">{{__('text.yousefName')}}</h5>
                                    <!-- <h5 class="text-muted mb-0 fw-normal">CFO</h5> -->
                                </div>
                            </div>
                        </div>
    
                        <div class="col">
                            <div class="d-flex align-items-center border border-default rounded-3">
                                <img width="100" height="100" src="https://i.pinimg.com/564x/64/5a/97/645a97899b437f047f4f88bee2e7755c.jpg" alt="Author" class="rounded-start me-3 h-100">
                                <div class="ps-3">
                                    <h5 class="mb-0">{{__('text.mohammedName')}}</h5>
                                    <!-- <h5 class="text-muted mb-0 fw-normal">UX Designer</h5> -->
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
@endsection