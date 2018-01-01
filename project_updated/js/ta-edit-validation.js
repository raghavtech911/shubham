$(function(){
        $('#nameerr').hide();
        $('#emailerr').hide();
        $('#phoneerr').hide();
        $('#qualerr').hide();
        $('#poserr').hide();

        var err_name = 0;
        var err_email = 0;
        var err_phone = 0;
        var err_qual = 0;
        var err_pos = 0;
       
        $('#name2').focusout(function(){
            checkname();
        }); 

        $('#email2').focusout(function(){
            checkemail();
        }); 

        $('#phone2').focusout(function(){
            checkphone();
        }); 

        $('#qual2').focusout(function(){
            checkqual();
        }); 

        $('#pos2').focusout(function(){
            checkpos();
        }); 
        
        // function to check name field for not null
        function checkname(){
            if($('#name2').val()== ''){
                $('#nameerr').html("Enter name");
                 $('#nameerr').show();
                 err_name = 1;
            }else {
                 $('#nameerr').hide();
             }
        }

        //function to check email is not null
        function checkemail() {
             if($('#email2').val()== ''){
                $('#emailerr').html("Enter email");
                 $('#emailerr').show();
                 err_email = 1;
            }else {
                 $('#emailerr').hide();
             }
        }

        //function to check phone is not null
        function checkphone() {
             if($('#phone2').val()== ''){
                $('#phoneerr').html("Enter mobile number");
                 $('#phoneerr').show();
                err_phone = 1;
            }else {
                 $('#phoneerr').hide();
             }
        }

        //function to check qualification is not null
        function checkqual() {
             if($('#qual2').val() == ''){
                $('#qualerr').html("Enter your Qualification");
                $('#qualerr').show();
                err_qual = 1;
            }else {
                 $('#qualerr').hide();
             }
        }

        //function to check position is not null
        function checkpos() {
             if($('#pos2').val()== ''){
                $('#poserr').html("Enter your Position");
                 $('#poserr').show();
                err_pos = 1;
            }else {
                 $('#poserr').hide();
             }
        }
$('#buttn').click(function(){

         checkname();
         checkphone();
         checkemail();
         checkqual();
         checkpos();

         var x = $(".ab").serializeArray();

         // var name = $('#name2').val();
         // var email = $('#email2').val();
         // var phone = $('#phone2').val();
         // var qual = $('#qual2').val();
         // var pos = $('#pos2').val();

         // var x = {"name1": name, "email1": email, "phone1": phone, "qual1": qual, "pos1":pos};
        //var x = 'name1=' + name + '&email1=' + email + '&phone1=' + phone + '&qual1=' + qual + '&pos1=' + pos;

        //  dataObj = {};
        // $(x).each(function(i, field){
        //   dataObj[field.name] = field.value;
        // });
        // alert(dataObj['name1']);
        // alert(dataObj['phone1']);
        // alert(dataObj['email1']);

if(err_name == 0 && err_email == 0 && err_phone == 0 && err_qual == 0 && err_pos == 0)
    {
            $.ajax({
                type: "POST",
                url: "ta-edit-ajax.php",
                data: x,
                cache: false,
                success: function(data){
                        alert('UPDATED !!!');
                    },
            });
    }else{
        alert("ERROR!!");
    }
});

});
