function basciAlert(obj){
    Swal.fire({
        // position: 'top-end',
        icon: obj.type,
        title: obj.message,
        showConfirmButton: false,
        timer: 3000
      }).then(function(){
        if(obj.redirect != undefined){
          window.location.href = obj.redirect; 
        }
      })
    
}

function deleteAlert(obj){
  return Swal.fire({
    title: 'Do you want to delete it?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  })
}