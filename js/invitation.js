function invitelog() {
    var name = $("#fname").val();
    var email = $("#email_id").val();
    var message = $("#message").val();

    var regEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var regname = /^[A-Za-z,\s]+$/;

    var flag = true;

    var err_name = "";
    $("#firname").html("");
    $("#emailid").html("");
    $("#invitemessage").html("");


    if (name == "") {
        err_name += "**Enter name<br>";
        flag = false;
    } else {
        var result1 = name.split(',');

        var len1 = result1.length;
        var arr = [];
        for (var i = 0; i < len1; i++) {
            if (!regname.test(result1[i])) {
                arr.push(result1[i]);
                $("#firname").html("**Name should not contain Number or special Characters in " + arr);
                flag = false;
            }
        }
    }

    if (err_name != "") {
        document.getElementById('firname').innerHTML = err_name;
    }
    if (email == "") {
        document.getElementById('emailid').innerHTML = "**Enter the email address";
        flag = false;
    }
    else {
        var result = email.replace(/\s/g, '').split(",");
        var len2 = result.length;
        var arr = [];
        for (var i = 0; i < len2; i++) {
            if (!regEmail.test(result[i])) {
                arr.push(result[i]);
                $("#emailid").html("**Invalid Email: " + arr);
                flag = false;
            }
        }
    }
    if (len1 > len2) {
        $("#emailid").html("**Count of emails should be same as count of names entered");
        flag = false;
    }
    else if (len1 < len2) {
        $("#firname").html("**Count of names should be same as count of emails entered");
        flag = false;
    }

    if (message == "") {
        $("#invitemessage").html("**Enter the message");
        flag = false;
    }
    return flag;
}