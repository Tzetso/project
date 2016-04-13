@extends('layouts.app')

@section('content')
        <div class="table-container">
	            	    <div class="panel-heading">Change password</div>
						<form action="" method="post" class="change">
							{!! csrf_field() !!}
							{{ method_field('PATCH')}}
							
							<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
	                            <label >Old password</label>
	
	                            <div >
	                                <input type="password" class="form-control" name="old_password">
	
	                                @if (isset($wrong))
	                                    <span class="help-block">
	                                        <strong>Wrong password</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	
	                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
	                            <label>New Password</label>
	
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
	                            <label>Confirm Password</label>
	
	                            <div >
	                                <input type="password" class="form-control" name="new_password_confirmation">
	
	                                @if ($errors->has('new_password_confirmation'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        <button type="submit" class="form-group">Change password</button>
						</form>
</div>
@endsection
