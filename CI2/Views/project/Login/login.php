<div class="container">
	<div class="row" style="margin-top:45px">
		<div class="col-md-4 col-md-offset-4">
			<h4>Korea server hosting sign In</h4>
			<form id="frmlogin" method="POST" action="/sjlee/login/logincheck">
				<div class="form-group">
					<label for="">Email</label>
					<input type="text" class="form-control" name="username" placeholder="Enter your email"><br>
				</div>
				<div class="form-group">
					<label for="">Password</label>
					<input type="text" class="form-control" name="password" placeholder="Enter your Password"><br>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit" > Sign in</button>
				</div>
				<br>
				<a href="/test/register">Have no account, create new account</a>
			</form>
		</div>
	</div>
</div>