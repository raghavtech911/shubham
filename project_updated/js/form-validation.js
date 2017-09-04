// $(function(){
//         var email_pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
   
//     $('#butn').click(function(){
//         var valid = true,
//                 errorMessage = "",
//                 $email = $('#email');

//             if ($('#name').val() == '') {
//                 errorMessage  = "Please Enter your Name \n";
//                 valid = false;
//             }

//             if ($('#phone').val() == '') {
//                 errorMessage += "Please Enter your Phone\n";
//                  valid = false;
//             }  

//             if ($('#qual').val() == '') {
//                 errorMessage += "Please Enter your Qualification\n";
//                  valid = false;
//             }    

//             if ($('#pos').val() == '') {
//                 errorMessage += "Please Enter your Position\n";
//                  valid = false;
//             }    

//             if ($email.val() == '') {
//                 errorMessage += "Please Enter your Email\n";
//                 valid = false;
//             } 

//             if($email.val() !== ""){
//             if(!email_pattern.test($email.val())){
//                 errorMessage += "Please enter Email in correct format\n";                
//                 valid  = false;
//             }
//         }

//             if( !valid && errorMessage.length > 0){
//                 alert(errorMessage);
//             }
        
//         if(errorMessage.length == 0 && valid == true){
//           // to send data on register-page-data for insertion into database 
//       var mydata = $('.input1').serializeArray();
//         $.ajax({
//                 type: "POST",
//                 url: "register-page-data.php",
//                 data: mydata,
//                 success: function(data){
//                     location.reload(true);
//                     alert('INSERTED!');
//                 },
//             });
//         }
//   });
// }); 

$(function(){
        $('#nameerr').hide();
        $('#emailerr').hide();
        $('#phoneerr').hide();
        $('#qualerr').hide();
        $('#poserr').hide();
        $('#experr').hide();

        var err_name = false;
        var err_email = false;
        var err_phone = false;
        var err_qual = false;
        var err_pos = false;
        var err_exp = false;
       
        $('#name').focusout(function(){
            checkname();
        }); 

        $('#email').focusout(function(){
            checkemail();
        }); 

        $('#phone').focusout(function(){
            checkphone();
        }); 

        $('#qual').focusout(function(){
            checkqual();
        }); 

        $('#pos').focusout(function(){
            checkpos();
        }); 
        
        $('#comp1').focusout(function(){
            checkexp();
        }); 
        
        // function to check name field for not null
        function checkname(){
            if($('#name').val()== ''){
                $('#nameerr').html("Enter name");
                 $('#nameerr').show();
                err_name = true;
            }else {
                 $('#nameerr').hide();
             }
        }

        //function to check email is not null
        function checkemail() {
             if($('#email').val()== ''){
                $('#emailerr').html("Enter email");
                 $('#emailerr').show();
                err_email = true;
            }else {
                 $('#emailerr').hide();
             }
        }

        //function to check phone is not null
        function checkphone() {
             if($('#phone').val()== ''){
                $('#phoneerr').html("Enter mobile number");
                 $('#phoneerr').show();
                err_phone = true;
            }else {
                 $('#phoneerr').hide();
             }
        }

        //function to check qualification is not null
        function checkqual() {
             if($('#qual').val() == ''){
                $('#qualerr').html("Enter your Qualification");
                 $('#qualerr').show();
                err_qual = true;
            }else {
                 $('#qualerr').hide();
             }
        }

        //function to check position is not null
        function checkpos() {
             if($('#pos').val()== ''){
                $('#poserr').html("Enter your Position");
                 $('#poserr').show();
                err_pos = true;
            }else {
                 $('#poserr').hide();
             }
        }
        
        //function to check experiance is not null
        function checkexp() {
             if($('#comp1').val()== ''){
                $('#experr').html("Enter - (dash) if you don't have Experiance in all Fields");
                 $('#experr').show();
                err_exp = true;
            }else {
                 $('#experr').hide();
             }
        }
        
$('#butn').click(function(){
         err_name = false;
         err_email = false;
         err_phone = false;
         err_qual = false;
         err_pos = false;
         err_exp = false;

         checkname();
         checkphone();
         checkemail();
         checkqual();
         checkpos();
         checkexp();

     if(err_name == false && err_email == false && err_phone == false && err_qual == false && err_pos == false && err_exp == false)
    {
        var mydata = $('.input1').serializeArray();
        $.ajax({
                type: "POST",
                url: "register-page-data.php",
                data: mydata,
                success: function(data){
                    //location.reload(true);
                    alert('INSERTED!');
                },
            });
    }else{
        alert("ERROR!!");
    }
});

//end function
});