/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function()
{
    $("#login").click(function()
    {
        var uname = $("#uname").val();
        var password = $("#psw").val();
        // Checking for blank fields.
        if( uname =='' || password =='')
        {
            $('input[type="text"],input[type="password"]').css("border","2px solid red");
            $('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
            alert("Please fill all fields...!!!!!!");
        }
        else
        {
            $.post("login.php",{email1: uname, password1:password},
                 function(data) 
                 {                
                    if(data=='Email or Password is wrong...!!!!')
                    {
                        $('input[type="text"],input[type="password"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
                        alert(data);
                    } 
                    else if(data=='Successfully Logged in...')
                    {
                        $("form")[0].reset();
                        $('input[type="text"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
                        alert(data);
                    }
                    else
                    {
                        alert(data);
                    }
                });
        }
    });
});