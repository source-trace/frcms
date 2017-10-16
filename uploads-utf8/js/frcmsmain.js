function Get_login(urlstr){
    $.ajax({
      type: "get",
      url: urlstr,      
      success: function(data, textStatus){
        $('#member_center').html(data).show();
      }
    });
}
function Check_login(path,v){
    if ($("#login").val() == ""){alert("请输入登录帐号!");$("#login").focus();return (false);}
    if ($("#pwd").val() == ""){alert("请输入登录密码!");$("#pwd").focus();return (false);}
    if (v==1&&$("input[name='verifycode']").val() == ""){alert("请输入验证码!");$("input[name='verifycode']").focus();return (false);}
    $.ajax({type: "POST",url: path+'login.php?do=login&t=ajax&g_t=' + new Date().getTime(),data: "login="+$("#login").val()+"&pwd="+$("#pwd").val()+"&verifycode="+$("input[name='verifycode']").val(),
        success: function(msg){
            var msgs,msgshow;
            msgs=msg.split(":");
            if(msgs[0]!='succeed'){
                msgshow=msg.substr(6);
                $.dialog({id: 'alertdiv',content: msgshow,yesFn:true});
            }else{
                msgshow=msg.substr(8);
                $.dialog({
                    id: 'alertdiv',
                    width: '300px',
                    content: msgshow,
                    yesFn: function(){
                        Get_login(path+'logins.php?t=ajax&g_t=' + new Date().getTime());
                    }
                });        
            }
        }
    });
}
function Check_loginout(path){
    $.ajax({
        type: "get",
        url: path+'login.php?do=loginout&t=ajax&g_t=' + new Date().getTime(),
        success: function(msg){
            var msgshow;
            msgshow=msg.substr(8);
            $.dialog({
                id: 'alertdiv',
                width: '300px',
                content: msgshow,
                yesFn: function(){
                    Get_login(path+'logins.php?t=ajax&g_t=' + new Date().getTime());
                }
            });
        }
    }); 
}
function Check_loginact(path,v){
    $.dialog.get('alertdiv').close();
    $.ajax({
        type: "get",
        url: path+'login.php?do=login&t=ajax&typeid=' + v + '&g_t=' + new Date().getTime(),
        success: function(msg){
            var msgs,msgshow;
            msgs=msg.split(":");
            if(msgs[0]!='succeed'){
                msgshow=msg.substr(6);
                $.dialog({id: 'alertdiv',content: msgshow,yesFn:true});
            }else{
                msgshow=msg.substr(8);
                $.dialog({
                    id: 'alertdiv',
                    width: '300px',
                    content: msgshow,
                    yesFn: function(){
                        Get_login(path+'logins.php?t=ajax&g_t=' + new Date().getTime());
                    }
                });
            }
        }
    });
}