@extends('web.layout')
<?php
use \App\Constants\UserTypes;
?>
@section('content')

    <section class="choose" id="choose-bg">
        <div class="container">

            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="choose-form">
                        <div class="row">
                            <div class="col-12">
                                <h2>{{trans('choose_your_account_type')}}</h2>
                                <p>{{trans('one_place_to_find_your_job')}}</p>
                            </div>
                        </div>
                        <div class="row">
                            @if(session()->has('alert'))
                                <span style="color:red">{{ session()->get('alert') }}</span>
                            @endif
                            <div class="col-md-12 col-12">
                                <form action="{{route('web.auth.register')}}" method="get">
                                    <div class="search-job">
                                        <label id="seekerLabel">
                                            <img id="seekerImage"
                                                 src="{{ asset("assets/img/Icons/radio_unchecked.png")}}">
                                            <input type="radio" id="seeker" name="type"
                                                   value="{{UserTypes::SEEKER}}">{{trans('looking_for_job')}}
                                        </label>
                                    </div>

                                    <div class="search-job">
                                        <label id="ownerLabel">
                                            <img id="ownerImage"
                                                 src="{{ asset("assets/img/Icons/radio_unchecked.png") }}">
                                            <input type="radio" id="owner" name="type"
                                                   value="{{UserTypes::OWNER}}">{{trans('looking_for_employers')}}
                                        </label>
                                    </div>
                                    <input type="submit" id="sign" class="sign-now btn sign-btn"
                                           value="{{trans('sign_now')}}">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
