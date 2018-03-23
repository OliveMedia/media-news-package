@extends('backend.layouts.master')

@section('title')
    Change Password
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active"> Change Password</li>
    </ul>
@endsection
@section('search_box')
    {{--<input type="text" id="search" name="search" class="form-control search"  autocomplete="off" onkeyup="search()" placeholder="Search News...">--}}
@endsection
    @section('content')
        <div class="border-bottom white-bg dashboard-header">
            <div class="row">
                <div class="col-lg-12">
                    @include('usermodule::includes.error')
                    @include('usermodule::includes.success')
                    <form class="form-horizontal ng-pristine ng-valid" method="POST" action="{{route('news')}}">
                        {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{$user->id}}">

                            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="old_password" class="col-md-4 control-label">Old Password</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control" name="old_password" required>

                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="input-group">
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    @endsection

@section('after-scripts')
    <script src="{{ asset('backend_theme/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $(".side-menu").find(".menu-user-management").addClass('active');
        $( "#register-form" ).validate( {
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
                password_confirmation: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                password_confirmation: {
                    required: "Please provide a password",
                    equalTo: "Please enter the same password as above"
                },
            }
        } );

    </script>
@endsection