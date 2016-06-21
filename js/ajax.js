    //hides all the images
    $('.hideImg').hide();
    // This function will check if the value of the input in username is allready in the database. this is triggerd when the focus on the input field is lost. 
    $('#uName').blur(function(){
        //makes a variabel that has the value och the input.
         var username=$('#uName').val();
        //if username is empty a error text will appear and an error icon and it will remove the attribut correct from it.
        if (username == '') {
            $('#uchecked').hide();
            $('#uunchecked').fadeIn('slow');
            $('#message').text('This field needs to be filled out');
            $(this).removeAttr('correct');
        }
        else{
            $('#message').text('checking...');
            //if the above dosent match an ajax rutine will run with will send the value of username 
            //with post to vaildate.php who will check with the database if value match any usernames in the database.
            $.ajax({
                type:"post",
                url:"validate.php",
                data:"username="+username,
                    success:function(data){
                        //if it succeds with the check it will send back and return 0 with is no match, wich means that it does not allready exists.
                        if(data==0){
                            //hides the error icon if is set and gives it the correct icon. gives a message and gives the input the attribute correct.
                            $('#uunchecked').hide();
                            $('#uchecked').fadeIn('slow');
                            $('#message').text('Username available');
                            $('#uName').attr('correct', 'correct');
                        }
                        else if(data==-1){
                             //If their was something wrong with the request and it will put out a error icon and a error message and remove the attrbute correct if it has been given.
                            $('#uchecked').hide();
                            $('#uunchecked').fadeIn('slow');
                            $('#message').text('Something with your request when wrong. Try again or a diffrent username.');
                            $('#uName').removeAttr('correct');
                        }
                        else{
                            //if the undername is taken it will put out a error icon and a error message and remove the attrbute correct if it has been given.
                            $('#uchecked').hide();
                            $('#uunchecked').fadeIn('slow');
                            $('#message').text('Username already taken');
                            $('#uName').removeAttr('correct');
                        }
                    }
            });
        }
    });
    
    //checks the given password if it holdes up to password rules.
    $('#psw').blur(function (){
        var inputVal = $(this).val();
        //pswCheck gets Regexp rules that checks if the password has minimum of 1 digit, minimun of 1 capital letter, minimum of 1 special sign
        //and that it is minimum of 8 characters. 
        var pswCheck = /^(.{6,})$/; 
         //if the inputs value i empty it will output a error message and en error icon. It will also remove the attribute correct if it has been given.
        if(inputVal == ''){
            $('#pswchecked').hide();
            $('#pswunchecked').fadeIn('slow');
            $('#pswMsg').text('This field needs to be filled out');
            $(this).removeAttr('correct');
        //Checks if the rules in pswCheck does not match the given value in inputVal. If it does not an error icon will appear
        //and a error message. The attribute correct will be removed if it is set.    
        }else if(!pswCheck.test(inputVal)){
            $('#pswchecked').hide();
            $('#pswunchecked').fadeIn('slow');
            $('#pswMsg').text('The password needs to contain minimum of 6 characters.');
            $(this).removeAttr('correct');
        //if inputVal matches the rules it will put out the correct icon and give it the attribute correct.
        }else{
            $('#pswunchecked').hide();
            $('#pswchecked').fadeIn('slow');
             $('#pswMsg').html('&nbsp;');
            $(this).attr('correct', 'correct');
        }
    });


    //Checks if it is a valid email adress that has been given.
    $('#email').blur(function(){
        var inputVal = $(this).val();
        //emailCheck gets Regexp rules of what is a valid email.
        var emailCheck = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        //if the inputs value i empty it will output a error message and en error icon. It will also remove the attribute correct if it has been given.
        if(inputVal == ''){
            $('#echecked').hide();
            $('#eunchecked').fadeIn('slow');
            $('#emailMsg').text('This field needs to be filled out');
            $(this).removeAttr('correct');
        //Checks if the rules in emailCheck does not match the given value in inputVal. If it does not an error icon will appear
        //and a error message. The attribute correct will be removed if it is set.
        }else if(!emailCheck.test(inputVal)){
            $('#echecked').hide();
            $('#eunchecked').fadeIn('slow');
            $('#emailMsg').text('You need to fill out a valid Email adress');
            $(this).removeAttr('correct');
        //if inputVal matches the rules it will put out the correct icon and give it the attribute correct. 
        }else if($('#email_check').val() !== ''){
            if($(this).val() !== $('#email_check').val()){
                $('#echecked').hide();
                $('#eunchecked').fadeIn('slow');
                $('#ecchecked').hide();
                $('#ecunchecked').fadeIn('slow');
                $('#emailMsg').text('Email adresserna matchar inte :/');
                $(this).removeAttr('correct');
                $('#email').removeAttr('correct');
            }else{
                $('#eunchecked').hide();
                $('#echecked').fadeIn('slow');
                $('#ecunchecked').hide();
                $('#ecchecked').fadeIn('slow');
                $('#emailMsg').html('&nbsp;');
                $(this).attr('correct', 'correct');
                $('#email').attr('correct', 'correct');
            }
        }else{
            $('#eunchecked').hide();
            $('#echecked').fadeIn('slow');
            $('#emailMsg').html('&nbsp;');
        }
    }); 

    $('#email_check').blur(function(){
        if($(this).val() == ''){
            $('#echecked').hide();
            $('#eunchecked').fadeIn('slow');
            $('#ecchecked').hide();
            $('#ecunchecked').fadeIn('slow');
            $('#emailMsg').text('Du måste upprepa din mail adress :/');
            $(this).removeAttr('correct');
            $('#email').removeAttr('correct');

        }else if($(this).val() !== $('#email').val()){
            $('#echecked').hide();
            $('#eunchecked').fadeIn('slow');
            $('#ecchecked').hide();
            $('#ecunchecked').fadeIn('slow');
            $('#emailMsg').text('Email adresserna matchar inte :/');
            $(this).removeAttr('correct');
            $('#email').removeAttr('correct');

        }else{
            $('#eunchecked').hide();
            $('#echecked').fadeIn('slow');
            $('#ecunchecked').hide();
            $('#ecchecked').fadeIn('slow');
            $('#emailMsg').html('&nbsp;');
            $(this).attr('correct', 'correct');
            $('#email').attr('correct', 'correct');
        }
    });
    
    //This function will run when the form is submited.
    $("form#registrationform").submit(function() {
        //it will count allt the inputs that doest have the type submit. it will check if any of the does nor have the attribute correct.
        //if any doesnt have that attribute it will alret a message and return false so it dosent submit.
    if($(this).find("input[type!='submit'][correct!='correct']").length != 0) {
        $('#big-message').text('Du verkar ha missat ett fält ^_!');
        return false;
    }
    });

  
