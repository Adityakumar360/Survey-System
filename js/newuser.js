function emptyuser() {

    var fname = $("#fname").val();
    var email_id = $("#email_id").val();
    var phoneno = $("#phoneno").val();
    var getSelectedValue = document.querySelector('input[name="gender"]:checked');


    var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;
    var regname = /^[A-Za-z\s]+$/;

    var flag = true;

    var err_name = "";
    $("#firname").html("");
    $("#emailid").html("");
    $("#ugender").html("");

    var err_phone = "";
    $("#sphone").html("");


    if (fname == "") {
        err_name += "**Enter name<br>";
        flag = false;
    }
    else if (!regname.test(fname)) {
        err_name += "**Name should not contain number or special characters<br>";
        flag = false;
    }
    if (err_name != "") {
        $("#firname").html(err_name);
    }
    if (email_id == "") {
        $("#emailid").html("**Enter email address");
        flag = false;
    }

    else if (!regEmail.test(email_id)) {
        $("#emailid").html("**Enter valid email address");
        flag = false;
    }

    if (getSelectedValue == null) {
        $("#ugender").html("**Select gender");
        flag = false;
    }

    if (phoneno == "") {
        $("#sphone").html("**Enter user phone no");
        flag = false;
    }
    else {
        if (isNaN(phoneno)) {
            err_phone += "**Phone number should  only contains number<br>";
            flag = false;
        }
        if (phoneno.length < 10) {
            err_phone += "**Phone number must be of 10 digits<br>";
            flag = false;
        }
        if (phoneno.length > 10) {
            err_phone += "**Phone number must be of 10 digits<br>";
            flag = false;
        }
        if ((phoneno.charAt(0) != 9) && (phoneno.charAt(0) != 8) && (phoneno.charAt(0) != 7) && (phoneno.charAt(0) != 6)) {
            err_phone += "**Phone number must start with 9,8,7 and 6";
            flag = false;
        }
        if (err_phone != "") {
            $("#sphone").html(err_phone)
        }
    }

    return flag;

}