$(function(){
        $('#nameerr').hide();
        $('#emailerr').hide();
        $('#phoneerr').hide();
        $('#qualerr').hide();
        $('#poserr').hide();

        var err_name = false;
        var err_email = false;
        var err_phone = false;
        var err_qual = false;
        var err_pos = false;
       
        $('#name1').focusout(function(){
            checkname();
        }); 

        $('#email1').focusout(function(){
            checkemail();
        }); 

        $('#phone1').focusout(function(){
            checkphone();
        }); 

        $('#qual1').focusout(function(){
            checkqual();
        }); 

        $('#pos1').focusout(function(){
            checkpos();
        }); 
        
        // function to check name field for not null
        function checkname(){
            if($('#name1').val()== ''){
                $('#nameerr').html("Enter name");
                 $('#nameerr').show();
                err_name = true;
            }else {
                 $('#nameerr').hide();
             }
        }

        //function to check email is not null
        function checkemail() {
             if($('#email1').val()== ''){
                $('#emailerr').html("Enter email");
                 $('#emailerr').show();
                err_email = true;
            }else {
                 $('#emailerr').hide();
             }
        }

        //function to check phone is not null
        function checkphone() {
             if($('#phone1').val()== ''){
                $('#phoneerr').html("Enter mobile number");
                 $('#phoneerr').show();
                err_phone = true;
            }else {
                 $('#phoneerr').hide();
             }
        }

        //function to check qualification is not null
        function checkqual() {
             if($('#qual1').val() == ''){
                $('#qualerr').html("Enter your Qualification");
                 $('#qualerr').show();
                err_qual = true;
            }else {
                 $('#qualerr').hide();
             }
        }

        //function to check position is not null
        function checkpos() {
             if($('#pos1').val()== ''){
                $('#poserr').html("Enter your Position");
                 $('#poserr').show();
                err_pos = true;
            }else {
                 $('#poserr').hide();
             }
        }

$('#butn').click(function(){
         err_name = false;
         err_email = false;
         err_phone = false;
         err_qual = false;
         err_pos = false;

         checkname();
         checkphone();
         checkemail();
         checkqual();
         checkpos();

     if(err_name == false && err_email == false && err_phone == false && err_qual == false && err_pos == false)
    {
         var x = $(".ab").serializeArray();
            $.ajax({
                type: "POST",
                url: "all-edit-data.php",
                data: x,
                success: function(data){
                        alert('UPDATED !!!');
                },
            });
    }else{
        alert("ERROR!!");
    }
});

//end function
});