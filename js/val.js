function vallogin(){
    var user =$("#usermail").val();
    var password =$("#pass").val();

    var flag=true;
    $("#username").html("");
    $("#passwords").html("");

    if(user=="" ){
        $("#username").html("**Enter the Email Address");
        flag = false;
    }

    if(password==""){
        $("#passwords").html("**Enter the password");
        flag =  false;
    }
    return flag;
}


