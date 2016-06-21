$('#groupname').blur(function(){
    //makes a variabel that has the value och the input.
     var groupName = $('#groupname').val();
    //if username is empty a error text will appear and an error icon and it will remove the attribut correct from it.
    if (groupName == '') {
        $('#checked').hide();
        $('#uunchecked').fadeIn('slow');
        $('#message').text('Du måste välja ett grupp namn.');
        $(this).removeAttr('correct');
    }else{
        $('#message').text('checking...');
        //if the above dosent match an ajax rutine will run with will send the value of username 
        //with post to vaildate.php who will check with the database if value match any usernames in the database.
        $.ajax({
            type:"post",
            url:"group_name_check.php",
            data:"groupName="+groupName,
            success:function(data){
                //if it succeds with the check it will send back and return 0 with is no match, wich means that it does not allready exists.
                if(data==0){
                    //hides the error icon if is set and gives it the correct icon. gives a message and gives the input the attribute correct.
                    $('#uunchecked').hide();
                    $('#checked').fadeIn('slow');
                    $('#message').text('');
                    $('#groupname').attr('correct', 'correct');
                }
                else if(data==-1){
                     //If their was something wrong with the request and it will put out a error icon and a error message and remove the attrbute correct if it has been given.
                    $('#checked').hide();
                    $('#uunchecked').fadeIn('slow');
                    $('#message').text('');
                    $('#groupname').removeAttr('correct');
                }else{
                    //if the undername is taken it will put out a error icon and a error message and remove the attrbute correct if it has been given.
                    $('#checked').hide();
                    $('#uunchecked').fadeIn('slow');
                    $('#message').text('Grupp namenet är redan taget. Välj ett annat.');
                    $('#groupname').removeAttr('correct');
                }
            }
        });
    }
});
$("form#creat_group_form").submit(function() {
    //it will count allt the inputs that doest have the type submit. it will check if any of the does nor have the attribute correct.
    //if any doesnt have that attribute it will alret a message and return false so it dosent submit.
    if($(this).find("input[type!='submit'][correct!='correct']").length != 0) {
        $('#message').text('Nu blev de tokigt! fyll i alla fält och försök igen!');
        return false;
    }
});
