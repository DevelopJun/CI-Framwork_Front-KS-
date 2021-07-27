<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<title>{ TITLE }</title>


	<link type="text/css" href="/css/common.css" rel="stylesheet" />

	<script type="text/javascript" src="/common.js"></script>
	<script type="text/javascript" src="/js/web_postit.js"></script>
	<script type="text/javascript" src="/js/jquery.ba-bbq.min.js"></script>
	<script type="text/javascript" src="/js/history.js"></script>
	<script type="text/javascript" src="/js/jquery.formadd.js"></script>

    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/gnb_v1/menu/core.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/gnb_v1/menu/styles/lgray.css" type="text/css" media="screen">
	<!--[if (gt IE 9)|!(IE)]><!-->
	<link rel="stylesheet" href="/css/gnb_v1/menu/effects/slide.css" type="text/css" media="screen">
	<!--<![endif]-->

	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>-->
	<!-- This piece of code, makes the CSS3 effects available for IE -->
	<!--[if lte IE 9]>
		<script src="/js/gnb_v1/menu.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
			$(function() {
				$("#menu").menu({'effect':'slide'});
			});
		</script>
	<![endif]-->

	<script type="text/javascript">
	//<![CDATA[

		function change_bg(n)
		{
			for(var i=0; i>5; i++) $("#gnb_area").removeAttr("class","gnb_top"+i);
			$("#gnb_area").attr("class","gnb_top"+n);
		}

	//]]>
	</script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" type="text/css" media="screen">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" type="text/css" media="screen">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" type="text/css" media="screen">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;500;600;700;800;900&display=swap" type="text/css" media="screen">
	<style>
		br{ font-family:Dotum !important;}
		*{
			box-sizing:border-box;
			font-family: 'Noto Sans KR', sans-serif;
		}

		body{
			position:relative;
		}

		.clfix:after {
			content: ".";
			display: block;
			height: 0;
			clear: both;
			visibility: hidden;
		}

		h1,h2,h3,h4,h5,h6{
			font-family:inherit;
		}

		input.frm_cal1{
			height:21px;
		}


		/* GNB **************************************************** */
		.gnb_top4, .gnb_top1, .gnb_top2, .gnb_top3, .gnb_top0  {
			z-index: 1;
			height: 50px;
			border-bottom: none;
			/*background: #b72708;*/
		}

		.topbar{
			height:100%;
			width:100%;
		}

		.logoImg{
			display:inline-block;
			text-align:center;
			width:180px;
			height:100%;
			padding:5px;
			float:left;
		}
		ul { margin:0px; }

		.topbar_btn{
			float:right;
			height:100%;
			padding-top:15px;
			padding-right:15px;
		}

		.quickLink_box{
			float:left;
			padding-top:15px;
		}

		.quickLink_box .sitebtn:visited {
			border: 1px solid #fff;
			background: transparent;
		}
		.quickLink_box .sitebtn:link {
			border: 1px solid #fff;
			background: transparent;
			box-shadow: none;
			text-shadow: none;
		}

		.quickLink .sitebtn_eyeon,
		.quickLink_box .sitebtn_eyeon{
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			font-size: 11px;
			text-decoration: none;
			vertical-align: middle;
			padding: 0 7px;
			border:1px solid transparent;
			transition:1s;
		}

		.quickLink .sitebtn_eyeon:hover,
		.quickLink_box .sitebtn_eyeon:hover{
			border-color:#fff;
		}

		.quickLink .sitebtn_eyeon:visited,
		.quickLink_box .sitebtn_eyeon:visited {
			/*border: 1px solid #fff;*/
			background: transparent;
			color:#fff;
			transition:1s;
		}

		.quickLink .sitebtn_eyeon:link,
		.quickLink_box .sitebtn_eyeon:link {
			/*border: 1px solid #fff;*/
			background: transparent;
			box-shadow: none;
			text-shadow: none;
			color:#fff;
			transition:1s;
		}

		#customBtnArea,#customBtnArea div,
		.quickLink,.member_btn{
			float:left;
		}

		#customBtnArea,
		.quickLink{
			margin-right:10px;
		}

		.topbar_btn .fas{
			color:#fff
		}

		.topbar_btn .button:link{
			border: none;
			background:transparent;
		}

		.topbar_btn a{
			color:#fff;
		}

		.topbar_btn .button:hover,
		.topbar_btn .sitebtn:hover,
		.topbar_btn a:hover{
			color:#fff
		}

		.topbar_btn .sitebtn:link{
			border: 1px solid #fff;
			background:transparent;
			box-shadow: none;
			text-shadow: none;
		}
		.topbar_btn .sitebtn:visited{
			border: 1px solid #fff;
			background:transparent;
		}

		.topbar_btn a:link{
			color:#fff;
		}
		.member_btn a:first-child{
			display:inline-block;
			margin-right:10px;
		}

		.topbar_bot{
			background: #fff;
			box-shadow: 0 6px 10px rgba(0,0,0,0.3);
			height: 40px;
		}

		.infoName{
			width: 180px;
			height: 100%;
			font-size: 13px;
			text-align: center;
			padding-top: 11px;
			float:left;
		}
		.infoName span{
			color:#363f61;
			font-weight:600;
			margin-left: -10px;
		}

		.info_picture{
		    width: 30px;
			height: 30px;
			overflow: hidden;
			display: inline-block;
			border-radius: 100px;
			float: left;
			margin-left: 10px;
			margin-top: -5px;
		}

		.topbar_bot .lgray{
			padding-top:0;
			border-bottom:none;
			height:100%;
			float:left;
			width:calc(100% - 180px);
		}

		.topbar_bot  .lgray>li {
			border-right: none;
			height: 100%;
			width: 80px;
			text-align: center;
			display: table;
			border-right: 1px solid #efefef;
		}
		.topbar_bot  .lgray>li:last-child{
			border-right:none;
		}

		.lgray>li>a {
			padding-top: 8px;
			background: transparent;
			border: none;
			border-bottom: 0;
			color: #363f61;
			text-shadow: none;
			font-weight: 500;
			font-size: 12px;
			line-height: 16px;
			padding: 12px 15px 10px 15px;
			height: 100%;
			display: table-cell;
			vertical-align: middle;
		}
		.lgray li ul:after,.lgray li ul li:after{
			content: ".";
			display: block;
			height: 0;
			clear: both;
			visibility: hidden;
		}

		.lgray.menu li ul li{
			float:left;
		}

		.slide li ul.first_dept{
			position: absolute;
			left:0;
		}
		.lgray ul.first_dept>li>a{
			line-height:0;
		}

		.slide li:hover ul.first_dept {
			position: absolute;
			left: 0;
			top: 40px;
			background: transparent;
			z-index: 999;
			height: 30px;
		}

		.topbar_bot  .lgray>li:nth-child(7)>ul,
			.topbar_bot  .lgray>li:nth-child(8)>ul,
			.topbar_bot  .lgray>li:nth-child(9)>ul,
			.topbar_bot  .lgray>li:nth-child(10)>ul,
			.topbar_bot  .lgray>li:last-child>ul{
				width:300px !important;
			}

		.dropdown-menu:before{
			left:83px;
		}

		.topbar_bot .lgray>li:last-child>ul>li:nth-child(4)>ul{
			left:-92px;
		}
		.topbar_bot .lgray>li:last-child>ul>li:nth-child(4)>ul:before{
			left:122px;
		}

		.topbar_bot .lgray>li:last-child>ul>li:last-child>ul{
			left:-172px;
		}
		.topbar_bot .lgray>li:last-child>ul>li:last-child>ul:before{
			left:182px;
		}

		.menu ul ul{
			top:33px;
		}

		.mobile_ham{
			display:none;
		}
		/* GNB **************************************************** */
		/* LNB  **************************************************** */
		#leftcolumn{
		    background:transparent;
			position: absolute;
			left: -180px;
			min-height: 500px;
			top:-19px;
			height:100%;
			padding-top:25px;
		}
		#leftcolumn:before {
			content: '';
			display: block;
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0;
			left: 0;
			background: #f5f5f5;
			background: -moz-linear-gradient(top, #f5f5f5 0%, #ffffff 100%);
			background: -webkit-linear-gradient(top, #f5f5f5 0%,#ffffff 100%);
			background: linear-gradient(to bottom, #f5f5f5 0%,#ffffff 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f5f5f5', endColorstr='#ffffff',GradientType=0 );
			z-index: -1;
		}

		#leftcolumn .subtopmn{
			display:none;
		}

		#leftcolumn .subtop ul{
			background:transparent;
		}

		#leftcolumn>.subtop>ul>li{
			background:none;
			padding: 5px 0 5px 20px;
			margin-left: 0;
		}

		#leftcolumn .subtop ul li:first-child{
			padding-bottom:10px;
			border-bottom:2px solid #5a5a5a;
			margin-bottom:10px ;
			font-weight: 600;
			color: #5a5a5a;
		}

		#leftcolumn .subtop ul li.listm a{
			color:#5a5a5a;
		}
		/*#leftcolumn .subtop ul li.listm a span{
			font-weight:normal !important;
		}*/

		#leftcolumn .subtop ul li.listm_on{
			padding-bottom:5px;
			padding-top:10px;
			color: #5a5a5a;
			font-size:14px;
		}

		#leftcolumn .subtop ul li.listm_l{
			background:#5a5a5a;
			padding:5px 0 5px 20px;
		}

		#leftcolumn .subtop ul li.listm_l a span{
			color:#fff !important;
		}

		#leftcolumn .subtop ul li.listm_l a{
			color:#fff;
		}
		#leftcolumn .subtop ul li.listm_on a span{
			color:#5a5a5a !important;
		}
		/* LNB **************************************************** */


		/* 전광판 **************************************************** */
		.top_alert{
			position: fixed;
			width: calc(100% - 180px);
			bottom: 0;
			height: auto;
			transition: 1s;
			z-index: 99;
			left: 180px;
		}
		#top_alert_list{
			height:100%;
		}

		.top_menu{
			width:100%;
			height:100%;
			padding: 10px;
			overflow-y: auto;
			min-width:1300px;
		}

		#top_alert_list>.top_menu>ul{
			/*border-top: none;*/
			border-left: none;
			border-right: none;
		}

		#top_alert_list .top_menu ul li:first-child{
			border-bottom: none !important;
		}

		/*#top_alert_list .top_menu ul li ul li:first-child{
			font-size:1.1em
		}*/

		#top_alert_list .top_menu>ul>li{
			box-sizing:content-box;
		}


		.onoff_btn{
			position: absolute;
			top: -28px;
			left: 60px;
			width: 41px;
			height: 28px;
			padding: 5px;
			background: #5f626c;
			z-index: 999;
			text-align: center;
			border-top-right-radius: 7px;
			border-top-left-radius: 7px;
			color: #fff;
			cursor:pointer;
		}

		.top_alert.closing{
			/*bottom:-180px;*/
			transition:1s;
		}
		.Fonoff_btn{
			position: absolute;
			top: -28px;
			left: 60px;
			width: 41px;
			height: 28px;
			padding: 5px;
			background: #5f626c;
			z-index: 999;
			text-align: center;
			border-top-right-radius: 7px;
			border-top-left-radius: 7px;
			color: #fff;
			cursor:pointer;
		}

		/* 전광판 **************************************************** */

		/* content **************************************************** */

		#loutbd{
			background:#fff;
			margin-left:180px;
			width:calc(100% - 180px);
			min-width:1000px;
			position:relative;
			margin-top:25px;
		}

		#centercolumn{
			margin-left:10px;
			margin-top:0;
			padding-top:0;
			margin-bottom: 20px;
		}
		#centercolumn h2{margin-bottom:20px}

		#Layer1 {
			top: 55px!important;
			width:230px !important;
			left: -7px !important;
		}

		.dombox_tt{
			padding-bottom:30px;
		}
		.ui-dialog .ui-dialog-titlebar{
			padding:6px 8px !important;
		}
		.ui-dialog .ui-dialog-content{
			width:100% !important;
		}

		.dialog_iframe body{
			height:97%
		}
		/* content **************************************************** */

		/* footer **************************************************** */

		 body{
			position:relative;
		 }
		#footer{
		    margin: 0;
			padding: 0;
			width: calc(100% - 180px);
			border-top: 1px solid #dedede;
			color:#b5b5b5;
			margin: 0px;
			text-align: left;
			clear: both;
			background-color: #FFF;
			height: 100px;
			height:40px;
			text-align:right;
			transition:1s;
			margin-left: 180px;
			float: left;
		}

		#footer dl dt{
			float:inherit;
			margin-right:0;
			padding:10px;
		}
		/* footer **************************************************** */


		#top {
			position: fixed;
			text-align: center;
			font-size: 12px;
			bottom: 150px;
			left: 120px;
			display: none;
		}

	#annonce_area {
			bottom: 11%;
			right: 2%;
			padding-top: 10px;
			background: rgba(255, 111, 111, 0.7);
			width: 240px;
			height: 122px;
			color: #fff;
			font-weight: bold;
			text-align: center;
			border-radius: 17px;
			z-index: 9999;
			padding-top: 0;
		}

		.annonce_close_btn {
			margin: -8px -8px 0 0;
			padding: 6px 12px;
			border-radius: 20px;
		}

		#annonce_area_href{
			display: inline-block;
			margin-top: -11px;
			text-align: center;
		}

		#annonce_text_area ul{
			margin-left:0;
		}
		#annonce_text_area ul:after{
			content:'';
			clear:both;
			display:block;
		}

		#annonce_text_area li.annonce_text_align{width:100%;}

		#annonce_text_area li.annonce_text_ml5px{display:none;}

	.annouce_state{
		display:inline-block;
	}
	.annouce_state div{
		display:inline-block;
		padding:2px 3px;
		border-radius:3px;
		width:65px;
		color:#fff;
		text-align:center;
		font-size:11px;
	}

		@media all and (max-width:1400px){
			.topbar_bot .lgray>li:last-child>ul{
				left:0;
			}
		}

		@media all and (max-width:1337px){
			.top_alert{
				left:0;
			}
		}
	</style>
	<script>
	$(document).ready(function(){
		$('#loutbd').addClass('clfix');
    $('#centercolumn').addClass('clfix');
		$("#top").hide();

		$('.onoff_btn').click(function(){
			const topHeight = $('.top_alert').height();
			const bottom = topHeight - 98;
			$('.top_alert').addClass('closing');
			$('.top_alert').css('bottom',-bottom);
			$('.Fonoff_btn i').removeClass('fa-caret-down');
			$('.Fonoff_btn i').addClass('fa-caret-up').addClass('notFull');
		});

		$('.Fonoff_btn').click(function(){
				const topHeights = $('.top_alert').height();
				const bottoms = topHeights - 98;
				const topAlert = $('.top_alert').hasClass('closing');
				const notFull = $('.Fonoff_btn i').hasClass('notFull');
				const isFull = $('.Fonoff_btn i').hasClass('isFull');
				const topA =  $('.top_alert');
				const Fbtn = $('.Fonoff_btn i');

				if(topAlert && notFull){
				Fbtn.removeClass('notFull').addClass('isFull');
				topA.css('bottom',-topHeights);
			 }else if(topAlert && !notFull && !isFull){
					topA.css('bottom',-bottoms);
					Fbtn.removeClass('fa-caret-down');
					Fbtn.addClass('fa-caret-up').addClass('notFull');
				}else if(topAlert && isFull){
					topA.removeClass('closing').css('bottom',0);
					Fbtn.removeClass('fa-caret-up').removeClass('isFull');
					Fbtn.addClass('fa-caret-down');
				}else if(!topAlert&&!notFull && !isFull){
					topA.addClass('closing').css('bottom',-bottoms);
					Fbtn.removeClass('fa-caret-down');
					Fbtn.addClass('fa-caret-up').addClass('notFull');
				}
			});

        /*
        if (window.addEventListener)
        window.addEventListener('DOMMouseScroll', wheel, false);
        window.onmousewheel = document.onmousewheel = wheel;

		$("#top").click(function(){
			$("html,body").animate({scrollTop:0},1000);
			return false;
		});

		$('.listm_on').prepend('<i class="fas fa-sun" style="margin-right:7px;display:inline-block;"></i>')

		$(window).scroll(function(){
			var scrPos = $(this).scrollTop();
			if ( scrPos >= 200) {
				$("#top").fadeIn();
			}
			else if ( scrPos <= 200) {
				$("#top").fadeOut();
			}
		});
        */

	});


    // 마우스 휠~
    function handle(delta) {
        let s = delta + ": ";
        /*
        if(delta < 0){ // 마우스 휠 위로일때.
            //alert("마우스 휠 위로~");
        }else { // 마우스 휠 아래일때.
			const topHeight = $('.top_alert').height();
            //console.log(topHeight);
            $('.top_alert').addClass('closing').css('bottom',-topHeight);
            $('.onoff_btn i').removeClass('fa-caret-down');
            $('.onoff_btn i').addClass('fa-caret-up');
        }
        */
        // 일단 휠 위아래 상관없이 처리..
        const topHeight = $('.top_alert').height();
		const bottom = topHeight - 98
        //console.log(topHeight);
        $('.top_alert').addClass('closing').css('bottom',-bottom);
        $('.onoff_btn i').removeClass('fa-caret-down');
        $('.onoff_btn i').addClass('fa-caret-up');
    }

    //마우스 이벤트
    function wheel(event){
        let delta = 0;
        if (!event) event = window.event;
        if (event.wheelDelta) {
            delta = event.wheelDelta/120;
            if (window.opera) delta = -delta;
        } else if (event.detail) delta = -event.detail/3;
        if (delta) handle(delta);
    }
	</script>
</head>
<body>

{aLib}
{!html!}
{/aLib}