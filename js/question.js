// Session Alert
setTimeout(function () {
    $('.mydiv').fadeOut('slow');
}, 1000);


$(document).ready(function () {
    $("#bt").click(function () {
        $("#hide1").show();
    });

    $("#ques-type").change(function () {
        var name = $("#ques-type").val();
        $(".btne2").hide();
        $("." + name).show();
    });
});

// Deleting Button
$("#delete").click(function () {
    $(".btne2").hide();

});

// Question Types
$(document).ready(function () {
    var i = 1;
    // single choice
    $('#add').click(function () {
        i++;
        $('#dynamic_field').append('<div class="form-row" id="row' + i + '"><div class="form-check "><input class="form-check-input" type="radio" disabled name="options" id="radioExample1" /><label class="form-check-label" for="radioExample1"><input type="text" placeholder="Enter Option" name="add[]" style="border-width: 0px; color:black;" /></label>&nbsp;&nbsp;<td><button type="button" name="add" class="btn btn_remove"  id="' + i + '" style="border-width:0px;font-size:larger;" title="Delete Option"><i class="fa-solid fa-xmark"></i></button></td> </div> </div>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });


    // Multiple Choice
    $('#add2').click(function () {
        i++;
        $('#dynamic_field2').append('<div class="form-row" id="row2' + i + '"><div class="form-check "><input type="checkbox" disabled id="chkbox" /><label for="chkbox">&emsp;<input type="text" placeholder="Enter Option" name="add[]" style="border-width: 0px;"></label>&nbsp;&nbsp;&nbsp;&nbsp;<td><button type="button" name="add" class="btn  btn_remove" id="' + i + '" style="border-width:0px;font-size:larger;" title="Delete Option"><i class="fa-solid fa-xmark"></i></button></td> </div> </div>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row2' + button_id + '').remove();
    });


    // Single Choice and Comments
    $('#add3').click(function () {
        i++;
        $('#dynamic_field3').append('<div class="form-row" id="row3' + i + '"><div class="form-check "><input class="form-check-input" disabled type="radio" name="exampleForm" id="radioExample1" /><label class="form-check-label" for="radioExample1"><input type="text" placeholder="Enter Option" name="add[]" style="border-width: 0px;" /></label>&nbsp;<td><button type="button" name="add" class="btn  btn_remove" id="' + i + '" style="border-width:0px;font-size:larger;" title="Delete Option"><i class="fa-solid fa-xmark"></i></button></td> </div> </div>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");

        $('#row3' + button_id + '').remove();
    });

    // Multiple Choice and Comment
    $('#add4').click(function () {
        i++;
        $('#dynamic_field4').append('<div class="form-row" id="row4' + i + '"><div class="form-check "><input type="checkbox" disabled id="chkbox" /><label for="chkbox">&emsp;<input type="text"  placeholder="Enter Option" name="add[]" style="border-width: 0px;"></label>&nbsp;&nbsp;&nbsp;&nbsp;<td><button type="button" name="add" class="btn  btn_remove" id="' + i + '" style="border-width:0px;font-size:larger;" title="Delete Option"><i class="fa-solid fa-xmark"></i></button></td> </div> </div>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");

        $('#row4' + button_id + '').remove();
    });

});


// Active Inactive Status
$(document).ready(function () {
    $('.mycheck').click(function () {

        var chid = this.id;
        if ($("input[id='" + chid + "']").is(':checked')) {
            curren_status = "Active";
        } else {
            curren_status = "Inactive";
        }

        $.ajax({
            type: "POST",
            url: "../questions/questionstatus.php",
            data: {
                name: curren_status,
                id: chid
            },
            success: function (data) {
                location.reload(true);
            }
        });
    });
});

// Required
$(document).ready(function () {
    $('.switch-input').on('change', function () {
        var ques_id = this.id;

        var is_checked = $(this).is(':checked');
        var selected_data;
        var $switch_label = $('.switch-label');

        if (is_checked) {
            selected_data = $switch_label.attr('data-on');
        } else {
            selected_data = $switch_label.attr('data-off');
        }
        $.ajax({
            type: "POST",
            url: "../questions/compulsory.php",
            data: {
                name: selected_data,
                id: ques_id
            },
            success: function (data) {
                location.reload(true);
            }
        });
    });
});