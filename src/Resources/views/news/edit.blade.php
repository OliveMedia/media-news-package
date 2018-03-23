@extends('backend.layouts.master')
@section('title')
    Edit User
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('news') }}">Users</a> </li>
        <li class="breadcrumb-item active">Edit User</li>
    </ul>
@endsection
@section('search_box')
    {{--<input type="text" id="search" name="search" class="form-control search"  autocomplete="off" onkeyup="search()" placeholder="Search News...">--}}
@endsection
    @section('content')
        <div class="border-bottom white-bg dashboard-header">
        <section>
      <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                 <div class="card">
                          <div class="card-header">
                            <h4>Edit User</h4>
                          </div>
                          <div class="card-body">
                    @include('usermodule::includes.error')
                    @include('usermodule::includes.success')
                    <form class="form-horizontal ng-pristine ng-valid" method="POST" id="edit-user-form" role="form" action="{{ route('users.update')}}">
                        {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{$user->id}}">

                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="offset-md-1 col-md-2 control-label">Name</label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                    <input id="name" type="text" class="form-control input-material-create" name="name" value="{{$user->name }}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="name" class="offset-md-1 col-md-2 control-label">Address</label>

                                <div class="col-md-8">
                                    <input id="address" type="text" class="form-control" name="address" value="{{$user->address }}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group row{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="offset-md-1 col-md-2 control-label">Status</label>

                            <div class="col-md-8">
                                <select class="form-control" name="status" id="status">
                                    @if($user->status == 0)
                                        <option value="0" selected>Inactive</option>
                                        <option value="1">Active</option>
                                    @else
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    @endif
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group row{{ $errors->has('role') ? ' has-error' : '' }}">

                                <label for="role_id" class="offset-md-1 col-md-2 control-label">Role</label>

                                <div class="col-md-8">
                                    <select class="form-control" name="role_id" id="role">
                                        @inject('Crypt','Illuminate\Support\Facades\Crypt')
                                            @foreach($roles as $role)   
                                                @foreach ($user->roles as $userRole)
                                                    @if ($role->id  == $userRole->id)
                                                        <option value="{{$role->id}}" selected>{{ $role->display_name }}</option>
                                                    @else    
                                                        <option value="{{$role['id']}}">{{ $role['display_name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                       
                                    </select>
                                    @if ($errors->userValidate->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->userValidate->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                               <div id="updatePasswordField"
                            <?php 
                                if ( $errors->has('password') || $errors->has('password-confirm')  )
                                {
                                    echo ' ';
                                }
                                else {
                                    echo ' style="display:none;" ';
                                }  
                            ?> 
                        >

                            <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}" id="pwd-container-ww">
                                <label for="password" class="offset-md-1 col-md-2 control-label">Password</label>
                                  <!--   <div class="row"> -->
                                         <div class="col-md-8">
                                            <div class="input-group" id="show_hide_password">
                                                <input id="password" type="password" class="form-control" name="password">
                                                 <div class="input-group-addon">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                 </div>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                     </span>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="offset-md-3 col-md-4">
                                            <div class="pwstrength_viewport_progress-ss"></div>
                                        </div>
                                  <!--   </div> -->
                                   
                            </div>
                         

                            <div class="form-group row">
                                <label for="password-confirm" class="offset-md-1 col-md-2 control-label">Confirm Password</label>
                                <div class="col-md-8">
                                 <div class="input-group" id="show_hide_password_confirm">
                                    <input id="password_confirm" type="password" class="form-control" name="password_confirm" >
                                     <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                     </div>
                                 </div>
                                </div>
                            </div>
                        </div>

                            <div class="form-group">
                                <!-- <div class="col-md-3 col-md-offset-5">
                                    <a id="contactBtn" style="margin-right: 15px;" class="btn btn-success">Update Password</a>
                                </div> -->
                                 <div class="offset-md-3 col-md-9">
                                    <div class="form-check">
                                        <span class="badge badge-info" id="updatePasswordUserProfile">Update Password</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="offset-md-10 col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                           

                        </form>
                        </div>
                </div>
            </div>
        </div>
        </div>
        </section>
        </div>
    @endsection
    @section('after-scripts')
        <script src="{{ asset('backend_theme/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
        <script type="text/javascript">
            $(".side-menu").find(".menu-user-management").addClass('active');
            $(document).ready(function () {

                $('#updatePasswordUserProfile').on('click', function (e) {
                    e.preventDefault();
                    $("#updatePasswordField").slideToggle();
                });
            })
               // ------------------------------------------------------- //
    // Password strength meter
    // ------------------------------------------------------ //
         jQuery(document).ready(function () {
            "use strict";

            var options = {};
            options.ui = {
                bootstrap4: true,
                container: "#pwd-container-ww",
                viewports: {
                    progress: ".pwstrength_viewport_progress-ss"
                },
                showVerdictsInsideProgressBar: true
            };
            // options.common = {
            //     debug: true,
            //     onLoad: function () {
            //         $('#messages-ps').text('Start typing password');
            //     }
            // };
            $(':password').pwstrength(options);

            // password strenght shown when key up
            $('.pwstrength_viewport_progress-ss').css("display", "none");
                $("#passwordff").keyup(function(){
                    var password = $(this).val().length;
                    if( password <= 0){

                        $('.pwstrength_viewport_progress-ss').css("display", "none");
                    }else{
                        $('.pwstrength_viewport_progress-ss').css("display", "block");
                    }
                });
         });
        </script>

        <script>
            $( "#edit-user-form" ).validate( {
                rules: {
                    name: {
                        required: true,
                        minlength: 5
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirm: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Name must consist of at least 5 characters"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    password_confirm: {
                        required: "Please provide a password",
                        equalTo: "Please enter the same password as above"
                    },
                }
            } );

        </script>



    @endsection
