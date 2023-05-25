/**
 * --------------------------------------------------------------------------
 * CoreUI Pro Boostrap Admin Template (3.2.0): validation.js
 * Licensed under MIT (https://coreui.io/license)
 * --------------------------------------------------------------------------
 */
var token = $("meta[name='csrf-token']").attr("content");

/* eslint-disable no-magic-numbers */
Ladda.bind('button[type=submit]');
// console.log(l);
var button = $('.btn-ladda');

  // Ladda.bind('.btn-ladda');
  // basciAlert({
  //   type: 'success',
  //   message: 'hi there',
  // })
$('form.ajax-form').on('submit',function(e){
    
  e.preventDefault();
  var $this = $(this);  
  var data = new FormData(this);

  var url = $this.attr('action');
  //submitting form
  $.ajax({
     url: url,
     type: 'POST',
     data: new FormData(this),
     contentType: false,
     cache: false,
     processData:false,
     beforeSend : function(){
     
      // l.start();
    },
     success: function(res){
          $(".is-valid").removeClass("is-valid");
          Ladda.stopAll();
            if (data.get('_method') == null) {
               if (res[0] === 'success') {
                  $this.trigger('reset');
               }
            }

            if (res[0] === 'success') {
              // in case of successfull request
              // if there is redirect
              if (res[2] != null) {
                basciAlert({
                  type: 'success',
                  message: res[1],
                  redirect: res[2]
                })
              }else{
                basciAlert({
                  type: 'success',
                  message: res[1],
                })
              }

               // Clear Dropzone files
              var dropzoneInstance = Dropzone.forElement("#dropzone");
              dropzoneInstance.removeAllFiles();
            }else{
              // in case any error
              button.attr('disabled','true');
              basciAlert({
                type: 'error',
                message: res[1],
                
              })
            }
        

          // button.attr('disabled','true');



     }
  });

}).validate({
  rules: {
    firstname: 'required',
    lastname: 'required',
    username: {
      required: true,
      minlength: 2
    },
    password: {
      minlength: 5
    },
    // eslint-disable-next-line camelcase
    password_confirmation: {
      minlength: 5,
      equalTo: '#password'
    },
    email: {
      
      email: true
    },
  },
  messages: {
    firstname: 'Please enter your firstname',
    lastname: 'Please enter your lastname',
    username: {
      required: 'Please enter a username',
      minlength: 'Your username must consist of at least 2 characters'
    },
    password: {
      minlength: 'Your password must be at least 5 characters long'
    },
    // eslint-disable-next-line camelcase
    password_confirmation: {
      minlength: 'Your password must be at least 5 characters long',
      equalTo: 'Please enter the same password as above'
    },
    email: 'Please enter a valid email address',
    agree: 'Please accept our policy'
  },
  errorElement: 'em',
  errorPlacement: function errorPlacement(error, element) {
    error.addClass('invalid-feedback');

    if (element.prop('type') === 'checkbox') {
      error.insertAfter(element.parent('label'));
    } else {
      error.insertAfter(element);
    }
  },
  // eslint-disable-next-line object-shorthand
  highlight: function highlight(element) {
    Ladda.stopAll();
     button.attr('disabled','true');
    $(element).addClass('is-invalid').removeClass('is-valid');    
  },
  // eslint-disable-next-line object-shorthand
  unhighlight: function unhighlight(element) {
    button.removeAttr('disabled');
    $(element).addClass('is-valid').removeClass('is-invalid');
  }
});
//# sourceMappingURL=validation.js.map

// deleting data 

$('body').on('click','#table_data_delete',function(e){
  e.preventDefault();
    var $this = $(this);
    var action = $this.attr('data-action');
    var parent = $this.attr('data-parent');
    
    var data = {_token: token};
  deleteAlert({}).then((answer)=> {
    if (answer.isConfirmed) {
      // send ajax request to delete the file
      $.ajax({
        url: action,
        method: "Delete",
        data: data,
        error: function(res){
          console.log(res.responseJSON.message);
          basciAlert({
            type: 'error',
            message: "Could not send request to the server",
          })
        },
        success: function(res){
          console.log(res[2]);
            if(res[0] == "deleted"){
            $this.closest(parent).hide();
            let obj;
            if (res[2] != undefined) {
               obj = {
                type: 'success',
                message: res[1],
                redirect: res[2]
              }
            }else{
               obj = {
                type: 'success',
                message: res[1],
              }
            }
            basciAlert(obj)
        }else{
          basciAlert({
            type: 'error',
            message: res,
          })
        }
        }
      });

    }
   })
})
