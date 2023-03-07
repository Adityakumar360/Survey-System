function emptystr() {
    var title = $("#title").val();
    var description = $("#descri").val();
    var dtecreation = $("#dte").val();
    var enddate = $("#enddte").val();
    var category = $("#category_type").val();


    var flag = true;

    $("#stitle").html("");
    $("#cat").html("");
    $("#sdescr").html("");
    $("#dtecr").html("");
    $("#enddtre").html("");


    if (title == "") {
        $("#stitle").html("**Survey title cannot be empty");
        flag = false;
    }
    if (category == null) {
        $("#cat").html("**Select category");
        flag = false;
    }
    if (description == "") {
        $("#sdescr").html("**Survey description cannot be empty");
        flag = false;
    }
    if (dtecreation == "") {
        $("#dtecr").html("**Select the creation date");
        flag = false;
    }

    if (dtecreation > enddate) {
        $("#enddtre").html("**End date should be greater or equal to date of creation");
        flag = false;
    }
    return flag;
}