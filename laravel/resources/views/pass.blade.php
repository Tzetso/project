@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            	<div class="panel-heading">Change password</div>
					<form action="" method="post">
						{!! csrf_field() !!}
						{{ method_field('PATCH')}}
						
						<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Old password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="old_password">

                                @if (isset($wrong))
                                    <span class="help-block">
                                        <strong>Wrong password</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new_password">

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new_password_confirmation">

                                @if ($errors->has('new_password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Change password</button>
					</form>
                
                
            </div>
        </div>
    </div>
</div>
@endsection
