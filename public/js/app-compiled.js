'use strict';

$(document).ready(function () {
    // expand / collapse dashboard items
    var elements = $('[class^=col-] > .card');
    elements.each(function (idx) {
        var element = $(elements[idx]);
        // only apply the event handler to functions with defined data-expanded attributes
        if (typeof element.data('expanded') == 'undefined' || element.data('expanded') === null) {
            return;
        }
        // change halder function
        var handleChange = function handleChange(card) {
            var duration = 300;
            if (card.data('expanded')) {
                card.children('.card-body').slideUp(duration);
                setTimeout(function () {
                    return card.children('.card-header').css({ 'borderWidth': '0 ' });
                }, duration);
                card.children('.card-header').find('.expand-trigger').removeClass('fa-compress');
                card.children('.card-header').find('.expand-trigger').addClass('fa-expand');
                card.data('expanded', 0);
            } else {
                card.children('.card-body').slideDown(300);
                card.children('.card-header').css({ 'borderWidth': '1px' });
                card.children('.card-header').find('.expand-trigger').removeClass('fa-expand');
                card.children('.card-header').find('.expand-trigger').addClass('fa-compress');
                card.data('expanded', 1);
            }
        };
        // set up the triggers
        element.find('.card-header').click(function () {
            handleChange($(this).parent());
        });
        // hide if the initial state is hidden
        if (!element.data('expanded')) {
            element.children('.card-body').slideUp(0);
            element.children('.card-header').css({ 'borderWidth': '1px' });
            element.children('.card-header').find('.expand-trigger').removeClass('fa-compress');
            element.children('.card-header').find('.expand-trigger').addClass('fa-expand');
        }
    });

    // convert some elements to clickable links
    $('.clickable-link').click(function () {
        window.document.location = $(this).data('href');
    });

    $("#password").keyup(function () {
        check_pass();
    });

    $("#glyphicon-user").click(function () {
        if ($('#dash-user').is(":visible")) {
            $("#glyphicon-user").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-user").hide(1000);
        } else {
            $("#glyphicon-user").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-user").show(1000);
        }
    });
    $("#glyphicon-personal").click(function () {
        if ($('#dash-personal').is(":visible")) {
            $("#glyphicon-personal").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-personal").hide(1000);
        } else {
            $("#glyphicon-personal").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-personal").show(1000);
        }
    });
    $("#glyphicon-check").click(function () {
        if ($('#dash-check').is(":visible")) {
            $("#glyphicon-check").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-check").hide(1000);
        } else {
            $("#glyphicon-check").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-check").show(1000);
        }
    });
    $("#glyphicon-check-old").click(function () {
        if ($('#dash-check-old').is(":visible")) {
            $("#glyphicon-check-old").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-check-old").hide(1000);
        } else {
            $("#glyphicon-check-old").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-check-old").show(1000);
        }
    });
    $("#glyphicon-add-check").click(function () {
        if ($('#dash-add-check').is(":visible")) {
            $("#glyphicon-add-check").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-add-check").hide(1000);
        } else {
            $("#glyphicon-add-check").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-add-check").show(1000);
        }
    });
    $("#glyphicon-medical").click(function () {
        if ($('#dash-medical').is(":visible")) {
            $("#glyphicon-medical").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-medical").hide(1000);
        } else {
            $("#glyphicon-medical").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-medical").show(1000);
        }
    });
    $("#glyphicon-measurments").click(function () {
        if ($('#dash-measurments').is(":visible")) {
            $("#glyphicon-measurments").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-measurments").hide(1000);
        } else {
            $("#glyphicon-measurments").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-measurments").show(1000);
        }
    });
    $("#glyphicon-allergy").click(function () {
        if ($('#dash-allergy').is(":visible")) {
            $("#glyphicon-allergy").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-allergy").hide(1000);
        } else {
            $("#glyphicon-allergy").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-allergy").show(1000);
        }
    });
    $("#glyphicon-diet").click(function () {
        if ($('#dash-diet').is(":visible")) {
            $("#glyphicon-diet").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-diet").hide(1000);
        } else {
            $("#glyphicon-diet").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-diet").show(1000);
        }
    });
    $("#glyphicon-patient").click(function () {
        if ($('#dash-patient').is(":visible")) {
            $("#glyphicon-patient").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-patient").hide(1000);
        } else {
            $("#glyphicon-patient").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-patient").show(1000);
        }
    });
    $("#glyphicon-doctor-dates").click(function () {
        if ($('#dash-doctor-dates').is(":visible")) {
            $("#glyphicon-doctor-dates").attr('class', 'fa fa-expand icon-arrow-right');
            $("#dash-doctor-dates").hide(1000);
        } else {
            $("#glyphicon-doctor-dates").attr('class', 'fa fa-compress icon-arrow-right');
            $("#dash-doctor-dates").show(1000);
        }
    });

    if ($('button#delete')) {
        $('button#delete').on('click', function () {
            swal({
                title: "Ali ste prepričani?",
                text: "Podatki se bodo za vedno izbrisali!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ja, izbriši!",
                cancelButtonText: "Prekliči",
                closeOnConfirm: false
            }, function () {
                $("#deleteMeasurementForm").submit();
            });
        });
    }

    if ($("#profileChangePassword").html() != null) {
        console.log("change password");
        console.log($("#password-reset").html());
        /*
         $("#profileView").html($("#password-reset").html());
         $("#li-personal-info").attr("class", "");
         $("#li-password-reset").attr("class", "active");
         */
        $("#password-reset-tab").click();
    }

    if ($("#profileChangeDoctor").html() != null) {
        $("#doctors-tab").click();
    }

    $('#timepicker2').timepicker({
        minuteStep: 10,
        template: 'modal',
        appendWidgetTo: 'body',
        showSeconds: true,
        showMeridian: false,
        defaultTime: false
    });

    $("#password").keyup(function () {
        checkPassword();
    });
    $("#password").focus(function () {
        checkPassword();
    });
    $("#password").blur(function () {
        checkPassword();
    });
    $("#password").keyup(function () {
        checkPassword();
    }).focus(function () {
        checkPassword();
    }).blur(function () {
        checkPassword();
    });
    $("#password").keyup(function () {
        checkPassword();
    }).focus(function () {
        $('#pswd_info').show();
    }).blur(function () {
        $('#pswd_info').hide();
    });

    $(".measurementT").change(function () {
        /*
         var min = $('option:selected', this).attr('min');
         var max = $('option:selected', this).attr('max');
         $(".measurementR").attr('min', min);
         $(".measurementR").attr('max', max);*/

        $("#showMeasurement").click();
    });

    if ($("#graph").length) {
        if ($("#graph1").length) {
            var json = jQuery.parseJSON($("#graph").text());
            var json1 = jQuery.parseJSON($("#graph1").text());
            json1 = jQuery.parseJSON(JSON.stringify(json1).replace(/"result":/g, '"result1":'));
            var jsonData = $.merge(json, json1);

            var minimal = jQuery.parseJSON($("#minimal").text());
            var maximal = jQuery.parseJSON($("#maximal").text());
            var minNormal = jQuery.parseJSON($("#minNormal").text());
            var maxNormal = jQuery.parseJSON($("#maxNormal").text());
            var plus = (maxNormal - minNormal) / 20;
            var array = [];
            while (minNormal <= maxNormal) {
                array.push(minNormal);
                minNormal += plus;
            }
            var minimal1 = jQuery.parseJSON($("#minimal1").text());
            var maximal1 = jQuery.parseJSON($("#maximal1").text());
            var minNormal1 = jQuery.parseJSON($("#minNormal1").text());
            var maxNormal1 = jQuery.parseJSON($("#maxNormal1").text());
            var plus1 = (maxNormal1 - minNormal1) / 20;
            var array1 = [];
            while (minNormal1 <= maxNormal1) {
                array.push(minNormal1);
                minNormal1 += plus1;
            }
            //alert(array);
            Morris.Line({
                element: 'graf-meritev',
                data: jsonData,
                xkey: 'time',
                ykeys: ['result', 'result1'],
                labels: ['Sistolični', 'Diastolični'],
                xLabelFormat: function xLabelFormat(d) {
                    return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear();
                },
                hoverCallback: function hoverCallback(index, options, content) {
                    var d = new Date(content.substring(36, 55)),
                        dformat = [d.getDate(), d.getMonth() + 1, d.getFullYear()].join('.') + ' ' + [d.getHours(), d.getMinutes()].join(':');
                    return dformat + content.substring(55, 255);
                },
                behaveLikeLine: true,
                resize: true,
                ymin: Math.min(minimal, minimal1),
                ymax: Math.max(maximal, maximal1),
                goals: array,
                goalLineColors: ['#22FF22'],
                goalStrokeWidth: 3
            });
        } else {
            var jsonData = jQuery.parseJSON($("#graph").text());
            var minimal = jQuery.parseJSON($("#minimal").text());
            var maximal = jQuery.parseJSON($("#maximal").text());
            var minNormal = jQuery.parseJSON($("#minNormal").text());
            var maxNormal = jQuery.parseJSON($("#maxNormal").text());
            var plus = (maxNormal - minNormal) / 20;
            var array = [];
            while (minNormal <= maxNormal) {
                array.push(minNormal);
                minNormal += plus;
            }
            //alert(array);
            Morris.Line({
                element: 'graf-meritev',
                data: jsonData,
                xkey: 'time',
                ykeys: ['result'],
                labels: ['Vrednost'],
                xLabelFormat: function xLabelFormat(d) {
                    return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear();
                },
                hoverCallback: function hoverCallback(index, options, content) {
                    var d = new Date(content.substring(36, 55)),
                        dformat = [d.getDate(), d.getMonth() + 1, d.getFullYear()].join('.') + ' ' + [d.getHours(), d.getMinutes()].join(':');
                    return dformat + content.substring(55, 255);
                },
                behaveLikeLine: true,
                resize: true,
                ymin: minimal,
                ymax: maximal,
                goals: array,
                goalLineColors: ['#22FF22'],
                goalStrokeWidth: 3
            });
        }
    }

    $("#measurementType").ready(function () {

        var ind = $("#measurementType").prop('selectedIndex');
        var val = $("option:selected", this).text();

        if (val == "Merjenje telesne teže") {
            $("#labelWeight").text('Višina');
            $("#measurementWeightResult").attr('required', true);
            $("#measurementWeight").attr('class', 'form-group');
        }
    });

    $('input[name=start]').change(function () {
        var start = $(this).val();
        //$('input[name=end]').attr('min', start);
        $(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('min', start);
    });

    $('input[name=end]').change(function () {
        var end = $(this).val();
        $(':input:eq(' + ($(':input').index(this) - 1) + ')').attr('max', end);
    });
});

$(function () {
    $(".navbar-expand-toggle").click(function () {
        $(".app-container").toggleClass("expanded");
        return $(".navbar-expand-toggle").toggleClass("fa-rotate-90");
    });
    return $(".navbar-right-expand-toggle").click(function () {
        $(".navbar-right").toggleClass("expanded");
        return $(".navbar-right-expand-toggle").toggleClass("fa-rotate-90");
    });
});

$(function () {
    return $('select').select2();
});
// This is needed so that when the select2 is in an invisible tab on lead, the width is calculated
// when the select box is shown
$(function () {
    return $('[role="tab"]').click(function (e) {
        setTimeout(function () {
            return $('select').select2();
        }, 200);
    });
});

$(function () {
    return $('.toggle-checkbox').bootstrapSwitch({
        size: "small"
    });
});

$(function () {
    return $('.match-height').matchHeight();
});

$(function () {
    return $('.datatable').DataTable({
        "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>'
    });
});

$(function () {
    return $(".side-menu .nav .dropdown").on('show.bs.collapse', function () {
        return $(".side-menu .nav .dropdown .collapse").collapse('hide');
    });
});

function checkPassword() {
    var pswd = $("#password").val();
    if (pswd.length < 8) {
        $('#length').removeClass('valid').addClass('invalid');
    } else {
        $('#length').removeClass('invalid').addClass('valid');
    }

    //validate letter
    if (pswd.match(/[A-z]/)) {
        $('#letter').removeClass('invalid').addClass('valid');
    } else {
        $('#letter').removeClass('valid').addClass('invalid');
    }

    //validate number
    if (pswd.match(/\d/)) {
        $('#number').removeClass('invalid').addClass('valid');
    } else {
        $('#number').removeClass('valid').addClass('invalid');
    }
}

function check_pass() {
    var val = document.getElementById("password").value;
    var meter = document.getElementById("meter");
    var no = 0;
    if (val != "") {
        // If the password length is less than or equal to 6
        if (val.length <= 6) no = 1;

        // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
        if (val.length > 6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))) no = 2;

        // If the password length is greater than 6 and contain alphabet,number,special character respectively
        if (val.length > 6 && (val.match(/[a-z]/) && val.match(/\d+/) || val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) || val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))) no = 3;

        // If the password length is greater than 6 and must contain alphabets,numbers and special characters
        if (val.length > 6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) no = 4;

        if (no == 1) {
            $("#meter").animate({ width: '50px' }, 300);
            meter.style.backgroundColor = "red";
            document.getElementById("pass_type").innerHTML = "Very Weak";
        }

        if (no == 2) {
            $("#meter").animate({ width: '100px' }, 300);
            meter.style.backgroundColor = "#F5BCA9";
            document.getElementById("pass_type").innerHTML = "Weak";
        }

        if (no == 3) {
            $("#meter").animate({ width: '150px' }, 300);
            meter.style.backgroundColor = "#FF8000";
            document.getElementById("pass_type").innerHTML = "Good";
        }

        if (no == 4) {
            $("#meter").animate({ width: '200px' }, 300);
            meter.style.backgroundColor = "#00FF40";
            document.getElementById("pass_type").innerHTML = "Strong";
        }
    } else {
        meter.style.backgroundColor = "white";
        document.getElementById("pass_type").innerHTML = "";
    }
}

//# sourceMappingURL=app-compiled.js.map