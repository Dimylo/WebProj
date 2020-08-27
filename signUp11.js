//Ανοιγμα και κλεισιμο των popups για signup και login

    document.getElementById("button1").addEventListener("click", function(){
       document.querySelector(".popup1").style.display = "flex";
     })
    document.querySelector(".close1").addEventListener("click", function(){
      document.querySelector(".popup1").style.display = "none";
    })
    document.addEventListener("keydown", function(event) {
        if(event.keyCode === 27){
           document.querySelector(".popup1").style.display = "none";
       }
    });

    $(document).ready(function(){
      var username_state = false;
      var email_state = false;
      $('#username1').keyup(function() {
          var u_name = $(this).val();
          if(!u_name==''){
          $.ajax({
            url: "checkSignUp.php",
            method: "POST",
            data: { 'uname':u_name},
            dataType:"text",
            success: function (data){
              if(data == "UNAME"){
                    username_state = true;
                    $("#divout").css('color','green').html('<span class="text-success"> Valid Username </span>');
                    if (username_state == true && email_state == true){
                      $( "#submit" ).prop( "disabled", false );
                      }
              }
              else{
                  username_state = false;
                  $( "#submit" ).prop( "disabled", true );
                  $("#divout").css('color','red').html('<span class="text-success"> Username taken, please try again! </span>');
              }
            }
          });
        }
        else{
          username_state = false;
          $("#divout").html('<span class="text-success"> *Τα πεδία είναι υποχρεωτικά </span>');
        }
        });
    $('#email1').keyup(function() {
        var e_mail = $(this).val();
        if (!e_mail==''){
        $.ajax({
          url: "checkSignUp.php",
          method: "POST",
          data: { 'email':e_mail},
          dataType:"text",
          success: function (data){
              if(data == "EMAIL"){
                    email_state = true;
                    $("#divout").css('color','green').html('<span class="text-success"> Valid email </span>');
                    if (username_state == true && email_state == true){
                      $( "#submit" ).prop( "disabled", false );

                    }
                    setInterval('refreshPage()', 5000);
              }
              else {
                    email_state = false;
                    $("#divout").css('color','red').html('<span class="text-success"> Email taken, please give another e-mail address! </span>');
                    $( "#submit" ).prop( "disabled", true );
              }
      }

      });
      }
      else{
        email_state = false;
        $("#divout").html('<span class="text-success"> *Τα πεδία είναι υποχρεωτικά </span>');
      }
    });

  });
