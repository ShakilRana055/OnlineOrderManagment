(function(){
    let selector = {
        CartAdded :$("#CartAdded"),
        CartRemove :$("#CartRemove"), 
        Favorites :$("#Favorites"), 
    }

    window.onload = function (){
        let errorMessage = selector.CartAdded.val();
        selector.CartAdded.val('');
        if (errorMessage && errorMessage =="success") {
            Success('Successfully Added to Cart');
        }
        else if(errorMessage && errorMessage =="taken"){
            Failed('Already Taken');
        }
        else if (errorMessage && errorMessage =="failed"){
            Failed('Something went wrong');
        }

        errorMessage = selector.CartRemove.val();
        selector.CartRemove.val('');
        if (errorMessage && errorMessage =="success") {
            Success('Successfully Removed from Cart');
        }
        else if(errorMessage && errorMessage =="taken"){
            Failed('Please add to cart first');
        }
        else if (errorMessage && errorMessage =="failed"){
            Failed('Something went wrong');
        }

        errorMessage = selector.Favorites.val();
        selector.Favorites.val('');
        if (errorMessage && errorMessage =="success") {
            Success('Successfully Added to Favorite');
        }
        else if(errorMessage && errorMessage =="taken"){
            Failed('Already taken into Favorite');
        }
        else if (errorMessage && errorMessage =="failed"){
            Failed('Something went wrong');
        }

    }
})();