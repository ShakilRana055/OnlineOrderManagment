
function Success(message){
    Swal.fire(
        'Success!',
        message,
        'success'
      )
}

function Failed(message){
    Swal.fire(
        'Error!',
        message,
        'error'
      )
}

function Decision (message, buttonName){
  Swal.fire({
    title: message,
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: buttonName
  }).then((result) => {
    if (result.value) {
      return true;
    }
    return false;
  });
}
