<style>
	html,body{
		width:100%;
		height:100%;
		box-sizing:border-box;
		margin:0;
		padding:0;
	}
	body{
		background:#EBEBEB;
		letter-spacing:-1px;
	}
	dl{
		margin:0;
	}

	input, textarea, button {-webkit-appearance:none; -moz-appearance:none; appearance:none;}
	input, textarea, button, select {-webkit-border-radius:0; -moz-border-radius:0; -o-border-radius:0; border-radius:0;}

	form{
		display:table;
		width:100%;
		height:100%;
		margin:0;
	}
	.login_all_area{
		height:673px;
		margin:0 auto;
		display:table-cell;
		vertical-align:middle;
	}
	.login_area{
		width: 75%;
		height:520px;
		background: #fff;
		margin: 0 auto;
		max-width:870px;
		padding: 45px 430px 10px 35px;
		box-sizing: border-box;
		position:relative;
		box-shadow: 15px 15px 13px rgba(0,0,0,0.4);
		min-width: 385px;
	}
	.login_area:after{
		background:url('/images/login_image.png') no-repeat;
		content:'';
		position:absolute;
		right:0;
		top:0;
		background-size:cover;
		width:430px;
		height:100%;
	}
	.login_title_area{
		font-weight:600;
		font-size:22px;
		color:#5a5a5a
	}

	.login_title_area small{
		font-size:10px;
		line-height:10px;
		display:block;
		padding: 5px 0;
		color: #b1adad;
		margin-bottom:40px;
	}
	dd{
		margin-inline-start: 0;
		margin:0;
	}
	#admin_id,#admin_passwd{
		padding: 13px;
		border: 1px solid #eee;
		box-shadow: none;
		font-size: 12px;
	}

	.btn-box{
		text-align:center;
		width: 100%;
	}
	.btn-box:after,.btn-box div:after{
		clear:both;
		content:'';
		display:block;
	}
	.btn-box div{
		width:301px;
		margin:0 auto;

	}
	.btn_login_cls{
		background:#FA6980;
		-webkit-background:#FA6980;
		-moz-background:#FA6980;
		-ms-background:#FA6980;
		-o-background:#FA6980;
		border:1px solid #FA6980;
		color:#fff;
		border-radius:3px;
		-webkit-border-radius:3px;
		-moz-border-radius:3px;
		-ms-border-radius:3px;
		-o-border-radius:3px;
		width:143px;
		height:43px;
		padding:6px 12px;
		float: left;
		margin-right: 15px;
		display:inline-block;
	}
	.btn_id_create{
		background:#fff;
		-webkit-background:#fff;
		-moz-background:#fff;
		-ms-background:#fff;
		-o-background:#fff;
		border:1px solid #FA6980;
		color:#FA6980;
		border-radius:3px;
		-webkit-border-radius:3px;
		-moz-border-radius:3px;
		-ms-border-radius:3px;
		-o-border-radius:3px;
		width:143px;
		height:43px;
		padding:6px 12px;
		float: left;
		display:inline-block;
	}

	.login_copyright{
		font-size:9px;
		position:absolute;
		bottom:10px;
		color:#afaeae;
		left:113px;
	}
	input[type=button],input[type=submit]{
		cursor:pointer;
	}
	.google-capcha{
		text-align:center;
		margin-top:20px;
	}
	.g-recaptcha{
		display:inline-block;
	}



	@media all and (max-device-width:1024px) and (min-device-width:560px){
		#admin_id,#admin_passwd{
			width:43% !important;
			float:left;
		}
		#admin_id:after,#admin_passwd:after{
			content:'';
			display:block;
			clear:both;
		}

		.login_area:before{
			width: 100px;
			height: 100px;
			content: '';
			position: absolute;
			top: -46px;
			left: 46%;
			background: gray;
			border-radius: 100px;
			border: 18px solid #fff;
			box-sizing: border-box;
		}
		.login_area:after{
			display:none;
		}
		.login_area{
			padding: 90px 0 30px 15px;
			height:calc(95% + 20px);
			width: 100%;
			margin: 164px auto 30px;
		}
		.login_all_area{
			height:100%;
		}

		.login_copyright{
			font-size: 1.2em;
			position:absolute;
			bottom:5px;
			color:#afaeae;
			width:100%;
			text-align:center;
			left:0;
		}
		.login_title_area{
			font-size:4em;
		}
		.login_title_area small{
			font-size: 0.4em;
			line-height: 1;
			padding-bottom:4em
		}
		.hosting{
			font-size:1em !important;
		}

		#admin_id,#admin_passwd{
			padding: 20px;
			border: 1px solid #eee;
			box-shadow: none;
			font-size: 2.5em;
		}

		#admin_passwd{
			margin-bottom:20px
		}

		.btn-box div{
			width:100%
		}

		.btn-box input{
			width:48% !important;
			height:84px;
			font-size:2em;
		}
		.google-capcha{
			width:96%;
			overflow:hidden;
			height:200px;
			text-align:left;
			margin-top:20px;
		}
		.g-recaptcha{
			transform:scale(2.6);
			-webkit-transform:scale(2.6);
			transform-origin:0 0;
			-webkit-transform-origin:0 0;
		}

	}


	@media all and (max-device-width:559px){
		.login_area:before{
			width: 100px;
			height: 100px;
			content: '';
			position: absolute;
			top: -46px;
			left: 46%;
			background: gray;
			border-radius: 100px;
			border: 18px solid #fff;
			box-sizing: border-box;
		}
		.login_area:after{
			display:none;
		}
		.login_area{
			padding: 90px 0 30px 15px;
			height:calc(95% + 20px);
			width: 100%;
			margin: 164px auto 30px;
		}
		.login_all_area{
			height:100%;
		}

		.login_copyright{
			font-size: 1.2em;
			position:absolute;
			bottom:5px;
			color:#afaeae;
			width:100%;
			text-align:center;
			left:0;
		}
		.login_title_area{
			font-size:4em;
		}
		.login_title_area small{
			font-size: 0.4em;
			line-height: 1;
			padding-bottom:4em
		}
		.hosting{
			font-size:1em !important;
		}

		#admin_id,#admin_passwd{
			padding: 20px;
			border: 1px solid #eee;
			box-shadow: none;
			font-size: 2.5em;
		}
		.btn-box div{
			width:100%
		}

		.btn-box input{
			width:48% !important;
			height:84px;
			font-size:2em;
		}
		#admin_id,#admin_passwd{
			width:89% !important;
		}
		#admin_passwd{
			margin-bottom:20px
		}

		.google-capcha{
			width:96%;
			overflow:hidden;
			height:200px;
			text-align:left;
			margin-top:20px;
		}
		.g-recaptcha{
			transform:scale(2.6);
			-webkit-transform:scale(2.6);
			transform-origin:0 0;
			-webkit-transform-origin:0 0;
		}
	}

	@media all and (max-width:960px){
		.login_area:after{
			display:none;
		}
		.login_area{
			padding-right:0;
			padding-left: 15px;
		}
		#admin_id,#admin_passwd{
			width:89% !important;
		}
	}

	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px)  {
		.login_title_area small{
			padding-bottom:1em;
		}
	}

	.clfix:after {
		content: ".";
		display: block;
		height: 0;
		clear: both;
		visibility: hidden;
	}
</style>
<form method="post" name="login_frm" action="/login/logincheck">
	<div class="login_all_area">
		<div class="login_area">
			<div class="login_title_area">
				<span style="color:#D50C18">KS</span><span class="hosting" style="font-size:18px;">HOSTING</span> Administrator
				<small>Welcome To the KShosting Administrator page.<br>Please Login to your account.</small>
			</div>
			<div class="login_input_area">
				<dl>
					<dt style="font-size:0;color:#fff;width:0;">ID</dt>
					<dd><input name="username" id="admin_id" value="" style="width:96%;"  placeholder="ID"/></dd>
					<dt style="font-size:0;color:#fff;width:0;">PASS</dt>
					<dd><input type="text" name="password" id="admin_passwd" value="" style="width:96%;"  placeholder="PASSWORD"/></dd>
					<dt> </dt>
					<dt style="margin-top:15px;">&nbsp;</dt>
					<dd class="btn-box"  style="margin-top:15px;">
						<div style="display:inline-block">
							<input name="login_btn" type="submit" class="btn_login_cls" style="padding:12px; width:46%;" value="Login" /> &nbsp;
							<input name="id_btn" type="button" class="btn_id_create" style="padding:12px; width:46%;" value="ID 발급신청" onclick="location.href='?act=join';" />
						</div>
					</dd>
				</dl>
			</div>

			<div class="login_copyright">Copyright 2019. <b>KSIDC.NET</b> All Rights Reserved.</div>
		</div>
	</div>
</form>

<script type="text/javascript">
</script>
