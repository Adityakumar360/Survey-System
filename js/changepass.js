function validation() {
    var oldpassword = $("#oldpass").val();
    var password = $("#floatingPassword").val();
    var conf_password = $("#floatingconfirmPassword").val();

    //Regular Expressions

    var regpass = /[A-Z]/;
    var regpass1 = /[a-z]/;
    var regpass2 = /[0-9]/;
    var regpass3 = /[~`!@#$%^&*()\[\]\\.,;:\s@"\-\\_+={}<>?]/;

    var flag = true;

    var err_pass = "";
    $("#userpass").html("");
    $("#userconfpass").html("");
    $("#oldpass_warning").html("");


    //PASSWORD

    if (oldpassword == "") {
        $("#oldpass_warning").html("**Enter Old Password");
        flag = false;
    }

    if (password == "") {
        err_pass += "**Enter the new password<br>";
        flag = false;
    }

    else {

        if (password.length < 5) {
            err_pass += "**Password should not be less than 5 characters...!<br>";
            flag = false;
        }

        if (password.length >= 20) {
            err_pass += "**Password should not be greater than 20 characters...!<br>";
            flag = false;
        }

        if (!regpass1.test(password)) {
            err_pass += "**Password must contain At least 1 Lower case<br>";
            flag = false;
        }

        if (!regpass.test(password)) {
            err_pass += "**Password must contain At least 1 Upper case<br>";
            flag = false;
        }

        if (!regpass2.test(password)) {
            err_pass += "**Password must contain At least 1 digit<br>";
            flag = false;
        }

        if (!regpass3.test(password)) {
            err_pass += "**Password must contain At least 1 special character<br>";
            flag = false;
        }
    }
    if (err_pass != "") {
        $("#userpass").html(err_pass);
    }

    //Confirm Password

    if (conf_password == "") {
        $("#userconfpass").html("**Please confirm the password");
        flag = false;
    }

    if (password != conf_password) {
        $("#userconfpass").html("**Enter the Same Password");
        flag = false;

    }

    return flag;

}