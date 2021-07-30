<script type="text/javascript">


$(document).ready(function(){
	//AJAX.get($('div#top_alert_list'),'/admin/ksalert/lists/ajax2?request_uri=');
});


function main_msg_alert_proc2(idx){
    var url = '/admin/ksalert/modify/ajax2';
    var params = {idx:idx};
    var sFunc = function(data){
        var link_url = data.url;
        var msg = data.msg;
        var msg2 = data.msg2;
        if(msg=="N"){
            $('#annonce_area').hide();
        }else{
            $('#annonce_area').show();
            $('a#annonce_area_href').attr('href',link_url);
            $('span#annonce_area_span').text(msg);
            $('span#annonce_area_span2').text(msg2);

            //2013/11/18 이미지 알림 ani 추가
            setInterval(div_fadein_out,1000);
        }
    }
    AJAX.proc(url,params,sFunc);
}
main_msg_alert_proc2();
setInterval(main_msg_alert_proc2,60000); // 1000 -> 1초

function div_fadein_out(){ // 알림 ani
    if($("#annonce_conts").css("display")=="none") $("#annonce_conts").css("display","none").fadeIn(500);
    else $("#annonce_conts").css("display","block").fadeOut(500);;
}
</script>
<script src="https://www.gstatic.com/firebasejs/5.3.1/firebase.js"></script>
<link rel="manifest" href="/manifest.json">
<script type="text/javascript">
function cf_view(mem_idx){
    ;if(!confirm("메세지를 '읽음'으로 처리하시겠습니까?")) return;
    var url = "/admin/ksalert/modify/ajax03";
    var params = {mem_idx:mem_idx};
    var func = function(data){
        location.reload();
    }

    AJAX.proc(url,params,func);
}

function annonce_close(){
    $("#annonce_area").remove();
}
</script>




<!-- 전광판때기 시작 -->


<!-- 스위치 모니터 에러 현황 -->
<style>
	.error_body{
		width:100%;
		border-collapse:collapse;
	}

	.error_body td{
		background-color:#ff6b6b;
		text-align:center;
		font-size: calc(5px + 2.2vw);
		font-weight:bold;
	}
</style>
<script>
//스위치 에러 체크하는 함수
function error_manager(){
	$.ajax({
		type:"POST",
		url:"/admin/ksalert/switch/ajax01",
		dataType:"json",
		success:function(result){
			var aError_list = result.data;
			if(aError_list){
				$(".se").each(function(){
					var is_error = true;
					for(var i in aError_list){
						;if($(this).hasClass("e_"+aError_list[i].kmse_ip_idx)){//에러가 존재하는지 체크
							is_error = false;
							break;
						}
					}
					if(is_error){
						$(this).remove();
					}
				});

				var sHtml = "";
				//에러 없는 경우 체크 하여 표시
				if(aError_list.length != 0){
					for(var i in aError_list){
						;if($(".e_"+aError_list[i].kmse_ip_idx).length <= 0){
							var sDate =aError_list[i].kmse_reg_date;
							sDate = sDate.replace(" ","<br>");
							sHtml += "<tr class='se e_"+aError_list[i].kmse_ip_idx+"'>";
							sHtml += "<td>" + aError_list[i].kmsg_name + "</td>";//호스트 명
							sHtml += "<td>" + aError_list[i].kms_name + "</td>";
							sHtml += "<td>" + aError_list[i].kmsi_ip + "</td>";
							sHtml += "<td>" + sDate + "</td>";
							sHtml += "</tr>";
						}
					}
				}
				$("#switch_error .error_body").append(sHtml);

			}else{
				;if($(".se").html()){
					$(".se").remove();
				}
			}
			//에러 영역 표시 체크
			if($("#switch_error .error_body tr").html() == null){
				$("#switch_error").hide();
			}else{
				$("#switch_error").show();
			}
		}
	});
}
</script>
<div id='switch_error' style='display:none;'>
	<table class='error_body' load="error_manager();">
		<tbody>
		</tbody>
	</table>
</div>

<script type="text/javascript">
setInterval("error_manager()", 10000);//스위치 에러 보여준다.
function top_alarm_div_refresh(){
    //AJAX.get($('div#top_alert_list'),'/admin/ksalert/lists/ajax2?request_uri=');

    //$('.onoff_btn').trigger('click');
}

setInterval(top_alarm_div_refresh,300000); // 1000 -> 1초
</script>
<!-- 전광판때기 끝 -->


<script type="text/javascript">
<!--
// 팝업창 띄우기.
function openPopup_top(sample_page,popup_name,width,height){
    LeftPosition = (screen.width) ? (screen.width-width)/2 : 0;
    TopPosition = (screen.height) ? (screen.height-height)/2 : 0;
    var winopts = "width="+width+",height="+height+",top="+TopPosition+",left="+LeftPosition+",toolbar=no,location=no,directories=no,status=yes,menubar=no, status=yes,menubar=no,scrollbars=yes,resizable=no";
    var popWindow = window.open(sample_page,popup_name, winopts);
}
//-->
</script>

<script type="text/javascript">
//<![CDATA[
function shBtn(){
    var mWid, widNo;
    var sumWid = 0;
    for(var i=0; i<$("#menu > li").size(); i++){
        mWid = $("#menu > li").eq(i).css("width");
        widNo = mWid.replace(/px/gi, "");
        sumWid += Number(widNo)+2; // 2는 li의 양쪽 border line값
    }
    var w = Math.round(sumWid)+7; // 7은 버튼의 width 값 포함

    if($("#customBtnArea").css("display")=="none"){
        $("#customBtnArea").css("width", w+"px");
        $("#customBtnArea").animate({opacity:1,width:'toggle'},1000);
        $("#btnArr").text("◀");
    }else{
        $("#customBtnArea").css("width", w+"px");
        $("#customBtnArea").animate({opacity:0,width:'toggle'},1000);
        $("#btnArr").text("▶");
    }
}
//]]>
</script>

<!-- navigation 시작 -->
<div id="gnb_area" class="gnb_top0">
	<div class="topbar">
		<div class="logoImg clfix"><a href="/"><img src="/images/gnb_v1/logo.png" alt="로고"></a></div>
		<div class="quickLink_box clfix">
			<a href="//mail.ksidc.net/" class="sitebtn" target='_blank'><i class="fas fa-envelope"></i> MAIL</a>
			<a href="https://msg.ksidc.net/" class="sitebtn" target='_blank'><i class="fab fa-facebook-messenger"></i> MESSENGER</a>
			<a href="https://data.ksidc.net/index.php/" class="sitebtn" target='_blank'><i class="fab fa-cloudversify"></i> OWN CLOUD</a> &nbsp;<font style="color:#fff;">&nbsp;|&nbsp;</font>
			<a href="https://eyeon.ksidc.net/" class="sitebtn_eyeon" target='_blank'><i class="fas fa-eye"></i> EYEON ADMIN</a>
		</div>
		<div class="topbar_btn clfix">
			<div id="customBtnArea" class="clfix">
				<div class="clfix"><a href="#" class="button" onclick="openWindow('//helpu.co.kr/download/HelpU_Setup.exe');">원격지원(ksidc1/ks0074)</a></div>
				<div class="clfix"><a href="#" class="button"  onclick="location.href='/company/board?bcode=faq';">통합 FAQ 게시판</a></div>
			</div>

			<div class="quickLink clfix">
				<a href="https://www.ksidc.net/" class="sitebtn" target='_blank'>IDC</a>
				<a href="https://domain.ksidc.net/" class="sitebtn" target='_blank'>DOM</a>
				<a href="https://vod.ksidc.net/" class="sitebtn" target='_blank'>VOD</a>
				<a href="https://sms.ksidc.net/" class="sitebtn" target='_blank'>SMS</a>
				<a href="https://cloud.ksidc.net/" class="sitebtn" target='_blank'>CLOUD</a>&nbsp;<font style="color:#fff;">&nbsp;|&nbsp;</font>
				<a href="https://www.eyeonsecurity.co.kr/" class="sitebtn_eyeon" target='_blank'> EYEON</a>
			</div>

			<div class="member_btn clfix">
				<div>
					<a href="javascript:openPopup_top('/admin/ksmember/ksmember_detail?ka_idx=','ksmember_detail_pop',820,860);" onfocus='this.blur();' title='내정보 수정'><i class="fas fa-cog"></i>&nbsp;{ name } 정보수정</a>
					<a href="#" onclick="location.href='/login/logout'"><i class="fas fa-chevron-circle-right"></i> 로그아웃</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="topbar_bot clfix">
	<div class="infoName clfix">
		<div class="info_picture">
				<img src="" border="0" style="width:100%;margin-top:-5px;" alt="사진">
			</div>
		<span>{ name }</span>님 안녕하세요<i>~! </i>
	</div>
	<div class="mobile_ham"><i class="fas fa-bars"></i></div>
	<!-- Top menu start -->
	<ul class="menu lgray slide clfix" id="menu">
		<?php
			$iNo = 0;
			$iRoot = 0;
			$iFirst = 0;
			$iSecond = 0;
			$aLastDepth = 0;
			if ($aMenu){
				foreach ($aMenu as $nKey => $nMenu){
					$aLastDepth = $nMenu['kn_depth'];
					if ($nMenu['kn_depth'] == 1){
						if ($iRoot != 0){
							if ($iSecond != 0){
		?>
					</ul>
		<?php
							}
							if ($iFirst != 0){
		?>
				</li>
			</ul>
		<?php
							}
		?>
		</li>
		<?php
						}
		?>
		<li style='margin-left:1px'>
			<a href="<?= $nMenu['kn_url'] ?>" onmouseover=""><?= $nMenu['kn_name'] ?></a>
		<?php
						$iRoot++;
						$iFirst = 0;
						$iSecond = 0;
					} else if ($nMenu['kn_depth'] == 2){
						if ($iFirst == 0){
		?>
			<ul class="first_dept" style="width:600px">
		<?php
						} else if ($iFirst != 0){
		?>
					</ul>
				</li>
		<?php
						}
		?>
				<li>
					<a href="<?= $nMenu['kn_url'] ?>"><?= $nMenu['kn_name'] ?></a>
		<?php
						$iFirst++;
						$iSecond = 0;
					} else {
						if ($iSecond == 0){
		?>
					<ul class='dropdown-menu' style='z-index:1000; position:absolute; width:260px !important; padding:10px;'>
		<?php
						}
		?>
						<li>
							<a href="<?= $nMenu['kn_url'] ?>"><?= $nMenu['kn_name'] ?></a>
						</li>
		<?php
						$iSecond++;
					}
				}
				if ($aLastDepth >= 3){
		?>
					</ul>
		<?php
				}
				if ($aLastDepth >= 2){
		?>
				</li>
			</ul>
		<?php
				}
				if ($aLastDepth >= 1){
		?>
		</li>
		<?php
				}
			}
		?>
	</ul>
	<!-- Top menu end -->
</div>

<!-- 전광판때기 시작 -->
<!--
<div class="top_alert">
	<div class="onoff_btn" style="display:none;"><i class="fas fa-caret-down"></i></div>
	<div class="Fonoff_btn"><i class="fas fa-caret-down"></i></div>
	<div id='top_alert_list' class="clfix" ></div>
</div>
-->
<!-- 전광판때기 끝 -->

<!-- navigation 시끝 -->

<!-- 업무전달 알림 시작 -->
<!--
<div id="annonce_area">
	<span class="annonce_close_btn" onclick="annonce_close();">X</span>
	<a href="#" id="annonce_area_href">
		<div id="annonce_conts">
			<span id="annonce_area_span"></span> <span class="annonce_text">건</span>
			<div id="annonce_text_area">
				<ul>
					<li class="annonce_text_align"><span id="annonce_area_span2" style="color:#fff;"></span></li>
					<li class="annonce_text_ml5px"><img src="/images/icon_spk.png" alt="알림" /></li>
				</ul>
			</div>
		</div>
	</a>
</div>
-->
<!-- 업무전달 알림 끝 -->

<!-- 페이지 관리책임자 레이어 시작 -->
<div id="Layer1" style="position:relative; left:-5px; top:102px; z-index:1; width:260px; float:right; margin-top:-47px;">
	<table cellpadding="0" cellspacing="0" border="0">
		<tbody>
			<tr>
				<td colspan="4" style="border-top-left-radius: 5px;border-top-right-radius: 5px;text-align:center;padding:2px 0px;background-color:#737373;color:#FFFFFF;">페이지 관리 책임자</td>
			</tr>
			<tr>
				<td style="border-bottom-left-radius:5px;border-left:1px solid #737373;border-bottom:1px solid #737373;text-align:center;padding:2px 5px;"><strong>정</strong>
				</td>
				<td style="border-right:1px solid #737373;border-bottom:1px solid #737373;text-align:center;padding:2px 5px;">
					<span class="clfix" style="float:left; margin-top:11px;">정123</span>
				</td>
				<td style="border-bottom:1px solid #737373;text-align:center;padding:2px 5px;"><strong>부</strong>
				</td>
				<td style="border-bottom-right-radius:5px;border-bottom:1px solid #737373;border-right:1px solid #737373;text-align:center;padding:2px 5px;">
					<span class="clfix" style="float:left; margin-top:11px;">부123</span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<!-- 페이지 관리책임자 레이어 끝 -->
