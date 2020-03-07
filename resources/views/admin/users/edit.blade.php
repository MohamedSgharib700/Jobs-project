@extends('admin.layout')
<?php use App\Constants\UserTypes;?>
@section('content')
<!--app-content open-->
<div class="app-content">
    <section class="section">
        <!--page-header open-->
        <div class="row">
            <div class="col-6">
                <div class="page-header">
                    <h4 class="page-title">{{ trans('new_user') }}</h4>

                </div>
            </div>
        </div>
        <!--page-header closed-->

        <div class="section-body">

            <!--row open-->
            <div class="row">
                <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                  <div class="card">
                    <div class="card-header">
                      <h4>{{ trans('new_user') }}</h4>
                  </div>
                  <div class="card-body">
                     @if(session()->has('success'))
                     <div class="alert alert-success alert-has-icon alert-dismissible show fade">
                        <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            <div class="alert-title">{{trans('success')}}</div>
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="post">
                        @csrf
                        @method("Put")
                        <div class="form-group row">
                          <label for="inputName" class="col-md-3 col-form-label">{{ trans('first_name') }} </label>
                          <div class="col-md-9">
                            <input type="text" class="form-control"
                            name="first_name" id="first_name"
                            value="{{old('first_name', $user->first_name)}}"
                            placeholder="{{ trans('first_name') }} ">
                            <input type="hidden" name="id"
                            value="{{ $user->id}}"/>
                            <input type="hidden" class="form-control"
                                        name="type" id="name" value="{{UserTypes::ADMIN}}">
                            @if ($errors->has('first_name'))
                            <strong style="color:red">{{ $errors->first('first_name') }}</strong>
                            @endif

                        </div>
                    </div>
                         <div class="form-group row">
                          <label for="inputName" class="col-md-3 col-form-label">{{ trans('last_name') }} </label>
                          <div class="col-md-9">
                            <input type="text" class="form-control"
                            name="last_name" id="last_name"
                            value="{{old('last_name', $user->last_name)}}"
                            placeholder="{{ trans('last_name') }} ">
                            <input type="hidden" name="id"
                            value="{{ $user->id}}"/>
                            @if ($errors->has('last_name'))
                            <strong style="color:red">{{ $errors->first('last_name') }}</strong>
                            @endif

                        </div>
                    </div>

             <div class="form-group row">
              <label for="inputPassword3" class="col-md-3 col-form-label">{{ trans('email') }}</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="email"
                id="email"
                value="{{ old('email',$user->email) }}"
                placeholder="{{ trans('email') }}">
                @if ($errors->has('email'))
                <strong style="color:red">{{ $errors->first('email') }}</strong>
                @endif

            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-md-3 col-form-label">{{ trans('phone') }}</label>
            <div class="col-md-9">
             <input type="text" class="form-control"
             name="phone" id="phone"
             value="{{ old('phone', $user->phone) }}"
             placeholder="{{trans('phone')}}"/>
             @if ($errors->has('phone'))

             <strong style="color:red">{{ $errors->first('phone') }}</strong>

             @endif

         </div>
     </div>


     <div class="form-group row">
        <label for="inputPassword3" class="col-md-3 col-form-label">{{ trans('password') }}</label>
        <div class="col-md-9">
           <input type="password" class="form-control"
           name="password" id="password"
           placeholder="{{ trans('password') }}">
           @if ($errors->has('password'))
           <strong style="color:red">{{ $errors->first('password') }}</strong>
           @endif

       </div>
   </div>
   <div class="form-group mb-0 mt-2 row justify-content-end text-left">
      <div class="col-md-9 float-left">
       <input type="submit" class="btn btn-primary mt-1"
       value="{{ trans('save') }}">
       <input type="reset" class="btn btn-danger mt-1"
       value="{{ trans('reset') }}">
   </div>
</div>
</form>
</div>
</div>
</div>
</div>
<!--row closed-->
</div>
</section>
</div>
<!--app-content closed-->
@stop
