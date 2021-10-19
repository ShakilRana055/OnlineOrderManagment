(function(){
    let selector = {
        addUserMessage :$("#AddUserMessage"),
    }

    window.onload = function(){
        $('.select2').select2();

        var errorMessage = selector.addUserMessage.val();
        selector.addUserMessage.val('');
        
        if (errorMessage && errorMessage =="success") {
            Success('User Created Successfully');
        }
        else if(errorMessage && errorMessage =="update"){
            Success('Food Item Updated Successfully');
        }
        else if(errorMessage && errorMessage =="failed"){
            Failed('Email is already taken');
        }

    }
})();