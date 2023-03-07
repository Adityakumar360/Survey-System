// Session alert
setTimeout(function () {
    $('.mydiv').fadeOut('slow');
}, 1000);

// Hide And Show
$(document).ready(function () {
    $("#ques-type").change(function () {
        var name = $("#ques-type").val();
        $(".btne2").hide();
        $("." + name).show();
    });
});

$(document).ready(function () {
    $("#ques-type").change(function () {
        var name = $("#ques-type").val();
        $(".edit").hide();
        $("." + name).show();
    });
});

// ----------------SINGLE CHOICE--------------
$(document).ready(function () {
    var i = 1;
    $('.addopt').click(function () {
        $('.dynamicfield1').append('<div  class="form-row mb-3" style="margin-left:22px;" ><div class="form-check "><input class="form-check-input" type="radio" style="height:15px; width:15px;" name="options" id="radioExample1" /><label class="form-check-label" for="radioExample1"><input type="text" placeholder="Enter Option"  name="add[]" style="color:black;" /></label>&nbsp;&nbsp;<td><button type="button"   class="btn  btn_remove" ><i class="fa-solid fa-trash"></i></button></td> </div></div>');
    });
    $(document).on('click', '.btn_remove', function () {
        $(this).parents('.form-row').remove();
    });

    //------------------ Multiple Choice------------------------
    $('.addoptmul').click(function () {
        $('#dynamic_field2').append('<div class="form-row mb-3 "><div class="form-check "><input type="checkbox" disabled id="chkbox" /><label for="chkbox">&emsp;<input type="text" placeholder="Enter Option" name="add[]" ></label>&nbsp;&nbsp;&nbsp;&nbsp;<td><button type="button" name="add" class="btn  btn_remove" ><i class="fa-solid fa-trash"></i></button></td> </div> </div> ');
    });

    $(document).on('click', '.btn_remove', function () {
        $(this).parents('.form-row').remove();
    });


    // ----------------------Single Choice and Comments---------------
    $('.addoptcmt').click(function () {
        $('.dynamic_field_new1').append('<div class="form-row mb-3 " style="margin-left: 20px;"  ><div class="form-check" ><input class="form-check-input" disabled type="radio" style="height:15px; width:15px;" name="add[]"  id="radioExample1" /><label class="form-check-label" for="radioExample1"><input type="text" placeholder="Enter Option" name="add[]"  /></label>&nbsp;<td><button type="button" name="add" class="btn  btn_remove" ><i class="fa-solid fa-trash"></i></button></td> </div> </div>');
    });

    $(document).on('click', '.btn_remove', function () {
        $(this).parents('.form-row').remove();
    });

    // --------------------Multiple Choice and Comment----------------
    $('.mcqcmt').click(function () {
        $('.dynamic_field_new1').append('<div class="form-row mb-3" ><div class="form-check "><input type="checkbox" disabled id="chkbox" /><label for="chkbox">&emsp;<input type="text"  placeholder="Enter Option" name="add[]"></label>&nbsp;&nbsp;&nbsp;&nbsp;<td><button type="button" name="add" class="btn  btn_remove" ><i class="fa-solid fa-trash"></i></button></td> </div> </div>');
    });

    $(document).on('click', '.btn_remove', function () {
        $(this).parents('.form-row').remove();
    });

});