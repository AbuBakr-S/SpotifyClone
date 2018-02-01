//Once page is ready and dependancies have loaded
$(document).ready(function(){
  //Show and Hide the appropriate form
  $("#hideLogin").click(function(){
    $("#loginForm").hide();
    $("#registerForm").show();
  });

  $("#hideRegister").click(function(){
    $("#loginForm").show();
    $("#registerForm").hide();
  });

});
