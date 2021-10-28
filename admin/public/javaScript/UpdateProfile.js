(function(){
    let selector = {
        updateMessage :$("#updateMessage"),
    }
    
    window.onload = function (){
        var errorMessage = selector.updateMessage.val();
        selector.updateMessage.val('');
        
        if(errorMessage && errorMessage =="update"){
            Success('Profile Updated Successfully');
        }
        else if(errorMessage && errorMessage =="failed"){
            Failed('Something went wrong!');
        }
    }
})();