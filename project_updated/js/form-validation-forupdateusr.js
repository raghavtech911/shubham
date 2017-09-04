$(function(){
        var email_pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
   
    $('#bttn').click(function(){
        var valid = true,
                errorMessage = "",
                $email1 = $('#email1');

            if ($('#name1').val() == '') {
                errorMessage  = "Please Enter your Name \n";
                valid = false;
            }

            if ($('#phone1').val() == '') {
                errorMessage += "Please Enter your Phone\n";
                 valid = false;
            } 
            if ($('#qual1').val() == '') {
                errorMessage += "Please Enter your Qualification\n";
                 valid = false;
            }    

            if ($('#pos1').val() == '') {
                errorMessage += "Please Enter your Position\n";
                 valid = false;
            }    

            if ($email1.val() == '') {
                errorMessage += "Please Enter your Email\n";
                valid = false;
            } 

            if($email1.val() !== ""){
            if(!email_pattern.test($email1.val())){
                errorMessage += "Please enter Email in correct format\n";                
                valid  = false;
            }
        }
            if( !valid && errorMessage.length > 0){
                alert(errorMessage);
        }

        if(errorMessage.length == 0 && valid == true){
          // to send data on register-page-data for insertion into database 
            var x = $('.input1').serializeArray();
            $.ajax({
                type: "POST",
                url: "update-usr2-ajax.php",
                data: x,
                success: function(data){ 
                    location.reload(true);
                    alert('UPDATED!');
                },
            });
        }
     });
}); 
