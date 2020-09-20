document.getElementById("button").addEventListener("click", function(){
   document.querySelector(".popup").style.display = "flex";
 })
document.querySelector(".close").addEventListener("click", function(){
  document.querySelector(".popup").style.display = "none";
})
document.addEventListener("keydown", function(event) {
    if(event.keyCode === 27){
       document.querySelector(".popup").style.display = "none";
   }
});
// refresh page when it is loaded by navigstion history
window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted ||
                         ( typeof window.performance != "undefined" &&
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});
$(document).ready(function(){

  $('#login').click(function(event) {

      event.preventDefault();
      var usern=$("#username").val();
      var passw=$("#password1").val();

      if(!usern==''){
        $.ajax({
          type: "POST",
          url: 'checkLogIn.php',
          data:{'uname':usern,'pass':passw},
          success: function (data){
            if(data == 'ola' ){
              alert('you are invalid');
              $("#divout1").css('color','blue').html('<span class="text-success"> *Συγκεντρώσου!! </span>');
            }
            if(data=='kola'){
               window.location="//localhost/WEB_APPS/user/main_user.php";
               $("#divout1").css('color','green').html('<span class="text-success"> *Match </span>');
            }
            if(data=='koka'){
               window.location="//localhost/WEB_APPS/admin/madmin1.html";
            }
            if(data=='Yparxei hdh'){
               $("#divout1").css('color','green').html('<span class="text-success"> *Yparxei hdh </span>');
            }
          }
        });
      }
    });
});
