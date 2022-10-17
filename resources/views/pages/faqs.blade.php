@extends('layouts.app')
@section('content')
    <!-- FAQs
    ================================= -->
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 text-center mb-6">
                    <h3 class="display-5 fw-bold">{{__("landing.faq0")}}</h3>
                </div>

                <div class="clear"></div>

                <!-- Post Content
                ============================================= -->
                <div class="col-lg-8">

                    <div class="clear"></div>

                    <div id="faqs" class="faqs">
                        <hr>
                        <div class="toggle faq pb-3 mb-3 faq-marketplace faq-authors">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-question-sign"></i>
                                    <i class="toggle-open icon-question-sign"></i>
                                </div>
                                <div class="toggle-title ps-1 fw-bold">
                                    {{ __('landing.faq1') }}
                                </div>
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-line-chevron-down text-50"></i>
                                    <i class="toggle-open icon-line-chevron-up text-50"></i>
                                </div>
                            </div>
                            <div class="toggle-content text-50 ps-4">{{ __('landing.faq2') }}</div>
                            <hr>
                            <div class="toggle faq pb-3 mb-3 faq-authors faq-miscellaneous">
                                <div class="toggle-header">
                                    <div class="toggle-icon">
                                        <i class="toggle-closed icon-comments-alt"></i>
                                        <i class="toggle-open icon-comments-alt"></i>
                                    </div>
                                    <div class="toggle-title ps-1 fw-bold">
                                        {{ __('landing.faq3') }}
                                    </div>
                                    <div class="toggle-icon">
                                        <i class="toggle-closed icon-line-chevron-down text-50"></i>
                                        <i class="toggle-open icon-line-chevron-up text-50"></i>
                                    </div>
                                </div>
                                <div class="toggle-content text-50 ps-4">{{ __('landing.faq4') }}</div>
                                <hr>
                                <div class="toggle faq pb-3 mb-3 faq-miscellaneous">
                                    <div class="toggle-header">
                                        <div class="toggle-icon">
                                            <i class="toggle-closed icon-lock3"></i>
                                            <i class="toggle-open icon-lock3"></i>
                                        </div>
                                        <div class="toggle-title ps-1 fw-bold">
                                            {{ __('landing.faq5') }}
                                        </div>
                                        <div class="toggle-icon">
                                            <i class="toggle-closed icon-line-chevron-down text-50"></i>
                                            <i class="toggle-open icon-line-chevron-up text-50"></i>
                                        </div>
                                    </div>
                                    <div class="toggle-content text-50 ps-4">{{ __('landing.faq6') }}</div>

                                </div>

                            </div>

                        </div><!-- .postcontent end -->

                    </div>
                </div><!-- #content end -->
            @endsection
