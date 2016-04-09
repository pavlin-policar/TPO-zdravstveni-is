$(document).ready(function(){
  $("#password").keyup(function(){
    check_pass();
  });

  $("#glyphicon-user").click(function(){
      if($('#dash-user').is(":visible")){
          $("#glyphicon-user").attr('class','fa fa-expand icon-arrow-right');
          $("#dash-user").hide(1000);
      }
      else{
          $("#glyphicon-user").attr('class','fa fa-compress icon-arrow-right');
          $("#dash-user").show(1000);
      }
  });
  $("#glyphicon-medical").click(function(){
        if($('#dash-medical').is(":visible")){
            $("#glyphicon-medical").attr('class','fa fa-expand icon-arrow-right');
            $("#dash-medical").fadeOut('slow');
        }
        else{
            $("#glyphicon-medical").attr('class','fa fa-compress icon-arrow-right');
            $("#dash-medical").fadeIn('fast');
        }
  });
  $("#glyphicon-measurments").click(function(){
        if($('#dash-measurments').is(":visible")){
            $("#glyphicon-measurments").attr('class','fa fa-expand icon-arrow-right');
            $("#dash-measurments").hide(1000);
        }
        else{
            $("#glyphicon-measurments").attr('class','fa fa-compress icon-arrow-right');
            $("#dash-measurments").show(1000);
        }
    });
    $("#glyphicon-allergy").click(function(){
        if($('#dash-allergy').is(":visible")){
            $("#glyphicon-allergy").attr('class','fa fa-expand icon-arrow-right');
            $("#dash-allergy").hide(1000);
        }
        else{
            $("#glyphicon-allergy").attr('class','fa fa-compress icon-arrow-right');
            $("#dash-allergy").show(1000);
        }
    });
    $("#glyphicon-diet").click(function(){
        if($('#dash-diet').is(":visible")){
            $("#glyphicon-diet").attr('class','fa fa-expand icon-arrow-right');
            $("#dash-diet").hide(1000);
        }
        else{
            $("#glyphicon-diet").attr('class','fa fa-compress icon-arrow-right');
            $("#dash-diet").show(1000);
        }
    });

    $("#password").keyup(function() {
        checkPassword();
    });
    $("#password").focus(function() {
        checkPassword();
    });
    $("#password").blur(function() {
        checkPassword();
    });
    $("#password").keyup(function() {
        checkPassword();
    }).focus(function() {
        checkPassword();
    }).blur(function() {
        checkPassword();
    });
    $("#password").keyup(function() {
        checkPassword();
    }).focus(function() {
        $('#pswd_info').show();
    }).blur(function() {
        $('#pswd_info').hide();
    });
});

$(function() {
  $(".navbar-expand-toggle").click(function() {
    $(".app-container").toggleClass("expanded");
    return $(".navbar-expand-toggle").toggleClass("fa-rotate-90");
  });
  return $(".navbar-right-expand-toggle").click(function() {
    $(".navbar-right").toggleClass("expanded");
    return $(".navbar-right-expand-toggle").toggleClass("fa-rotate-90");
  });
});

$(function() {
  return $('select').select2();
});
// This is needed so that when the select2 is in an invisible tab on lead, the width is calculated
// when the select box is shown
$(function() {
  return $('[role="tab"]').click(function (e) {
      setTimeout(function() {
          return $('select').select2();
      }, 200);
  });
});

$(function() {
  return $('.toggle-checkbox').bootstrapSwitch({
    size: "small"
  });
});

$(function() {
  return $('.match-height').matchHeight();
});

$(function() {
  return $('.datatable').DataTable({
    "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>'
  });
});

$(function() {
  return $(".side-menu .nav .dropdown").on('show.bs.collapse', function() {
    return $(".side-menu .nav .dropdown .collapse").collapse('hide');
  });
});

function checkPassword(){
    var pswd = $("#password").val();
    if ( pswd.length < 8 ) {
        $('#length').removeClass('valid').addClass('invalid');
    } else {
        $('#length').removeClass('invalid').addClass('valid');
    }

    //validate letter
    if ( pswd.match(/[A-z]/) ) {
        $('#letter').removeClass('invalid').addClass('valid');
    } else {
        $('#letter').removeClass('valid').addClass('invalid');
    }

//validate number
    if ( pswd.match(/\d/) ) {
        $('#number').removeClass('invalid').addClass('valid');
    } else {
        $('#number').removeClass('valid').addClass('invalid');
    }
}

function check_pass(){
  var val=document.getElementById("password").value;
  var meter=document.getElementById("meter");
  var no=0;
  if(val!="") {
    // If the password length is less than or equal to 6
    if(val.length<=6)no=1;


    // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
    if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;


    // If the password length is greater than 6 and contain alphabet,number,special character respectively
    if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;


    // If the password length is greater than 6 and must contain alphabets,numbers and special characters
    if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;

    if(no==1)
    {
      $("#meter").animate({width:'50px'},300);
      meter.style.backgroundColor="red";
      document.getElementById("pass_type").innerHTML="Very Weak";
    }

    if(no==2)
    {
      $("#meter").animate({width:'100px'},300);
      meter.style.backgroundColor="#F5BCA9";
      document.getElementById("pass_type").innerHTML="Weak";
    }

    if(no==3)
    {
      $("#meter").animate({width:'150px'},300);
      meter.style.backgroundColor="#FF8000";
      document.getElementById("pass_type").innerHTML="Good";
    }

    if(no==4)
    {
      $("#meter").animate({width:'200px'},300);
      meter.style.backgroundColor="#00FF40";
      document.getElementById("pass_type").innerHTML="Strong";
    }
  }

  else
  {
    meter.style.backgroundColor="white";
    document.getElementById("pass_type").innerHTML="";
  }

}
