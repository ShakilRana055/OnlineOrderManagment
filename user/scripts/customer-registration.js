
(function(){
    const selector = {
        passwordErrorMsg: $("#passwordErrorMsg"),
        confirmPassword: $("#ConfirmPassword"),
        password: $("#Password"),
        allUserMessage: $("#allUserMessage"),
        successMsg: $("#successMsg"),
        
    }

    const MatchMatching = function(){
        selector.passwordErrorMsg.text('');
        let errorMessage = '';
        if(selector.password.val() == ''){
            errorMessage = "Passowrd Can't be empty";
            return false;
        }
        if(selector.confirmPassword.val() !== selector.password.val())
        {
            errorMessage = "Passowrd is not same";
        }
        selector.passwordErrorMsg.text(errorMessage);
        return true;
    }

    selector.confirmPassword.keyup(function(){
        MatchMatching();
    });

    window.onload = function (){
        let errorMessage = selector.allUserMessage.val();
        selector.successMsg.text('');
        selector.allUserMessage.val('');

        if (errorMessage && errorMessage =="success") {
            selector.successMsg.text('Registered Successfully');
        }
        else if(errorMessage && errorMessage =="update"){
            selector.successMsg.text('Updated Successfully');
        }
        else if(errorMessage && errorMessage =="failed"){
            selector.successMsg.css("color", "red");
            selector.successMsg.text('Email is already taken');
        }
        
    }


})();