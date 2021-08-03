
// ajax 에 들어가는 data return 해주는 곳,

function certification(authS){

    var token = authS; // Session 에서 token 가져오기
    var header = [
        'Authorization: Bearer '+ token,
        'Content-Type: application/json'
    ];

        $.ajax({
            type: "POST", // POST, GET
            url : "", // 인증확인 부분
            async: false,
            datatype : "json", //json
            xhrFields: {
                withCredentials: true
            }, // 쿠키에 관련된 요청을 사용한는 부분 // COOKIE 에 담아서 return ?

            beforeSend : function(xhr){
                xhr.setRequestHeader(token, header)
            },
            success:function(data){
                return 1;
            },
            fail:function(data){
                return 0;
            }

        });
        return token;

};

// SESSION 에 담아서 return ?
function sessioncall() {
    $.ajax({
           beforeSend: function(xhr) {
            xhr.setRequestHeader("AJAX", "true");
        },
        error: function(xhr, status, err) {
            if(xhr.status=="503"){
                alert("Login Session Expired");
                location.href = "/";
            }
        }});
  
})(jQuery);
});
function (get) {

}


function init() {
    certification();
}

init();
