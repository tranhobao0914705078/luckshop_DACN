@extends('layout')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-sm-offset-1">
				@if(session()->has('messageMail'))
                    <div class="alert alert-success">
                        {!!session()->get('messageMail')!!}
                    </div>
                @elseif(session()->has('errorMail'))
                    <div class="alert alert-danger">
                        {!!session()->get('errorMail')!!}
                    </div>
                @endif
					<div class="login-form"><!--login form-->
						<h2>Nhập Email Của Bạn </h2>
						<form action="{{URL::to('/recover-pass')}}" method="POST">
							{{csrf_field() }}
							<input type="email" name="email_account" placeholder="Nhập Email" />
							<button type="submit" class="btn btn-default">Gửi Mail</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
</section><!--/form-->
@endsection