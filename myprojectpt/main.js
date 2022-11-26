//register
$('#btnRegister').click(function(){
    reg();
}); 

var reg =()=>{
    if ($('#user').val() != "" && $('#pass').val() != "" && $('#conpass').val() != "") {
        if ($('#pass').val() == $('#conpass').val() ) {
            register();
        }else{
            alert("Password not Matched!");
        }
    }else{
        alert("Please fill-in empty field(s)");
    }
}

var register =()=>{
    $.ajax({
        type: "POST",
        url: "./router.php",
        data: {choice:'register',user:$('#user').val(),pass:$('#pass').val()},
        success: function(data){
            alert(data);
        }, 
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}

//login
$('#btnLogin').click(function(){
    log();
});

var log =()=>{
    if ($('#username').val() != "" && $('#password').val() != "") {
        login();
    }else{
        alert("Please fill-in empty field(s)");
    }
}

var login =()=>{
    $.ajax({
        type: "POST",
        url: "./router.php",
        data: {choice:'login',user:$('#user').val(),pass:$('#pass').val()},
        success: function(data){
            if (data == "200") {
                window.location.href = "./dashboard.html";
            }else if(data!=200){
                alert("Invalid Username or Password! You must register first");
            }
        }, 
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}

// //delete
// $('#btnDel').click(function(){
//     del();
// });
// var del =()=>{
//     if ($('#user').val() != "" && $('#pass').val() != "") {
//         doDelete();
//     }else{
//         alert("Please fill-in empty field(s)");
//     }
// }
// var doDelete =()=>{
//     $.ajax({
//         type: "POST",
//         url: "./router.php",
//         data: {choice:'delete',user:$('#user').val(),pass:$('#pass').val()},
//         success: function(data){
//             alert(data);
//         }, 
//         error: function (xhr, ajaxOptions, thrownError) {
//             alert(thrownError);
//         }
//     });
// }

//logout
$('#btnLogout').click(function(){
    logout();
});

var logout =()=>{
    $.ajax({
        type: "POST",
        url: "./router.php",
        data: {choice:'logout'},
        success: function(data){
            if (data == "200") {
                window.location.href = "./login.html";
            }
        }, 
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}