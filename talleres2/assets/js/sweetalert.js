function enterClick(x,y) {
    var input = document.getElementById(x);
  
    // Execute a function when the user releases a key on the keyboard
    input.addEventListener("keyup", function(event) {
      // Number 13 is the "Enter" key on the keyboard
      if (event.keyCode === 13) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById(y).click();
      }
    });
  }

function alerta2(t) {
    Swal.fire({
  
      title: '¡Exito!',
      text: t,
      icon: 'success',
      allowOutsideClick: false
    })
  }
  
  function alertae(t) {
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: t
    })
  }
  
  function alertaSes(t) {
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: t,
      allowOutsideClick: false
    }).then(function() {
      window.location.href="login";
    })
  }
  
  
  function alertae2(t) {
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: t,
      allowOutsideClick: false
    }).then(function() {
      location.reload(true);
    })
  }
  
  function simpleAlert(t) {
    Swal.fire(t)
  }
  
  function alerta(t) {
    Swal.fire({
  
      title: '¡Exito!',
      text: t,
      icon: 'success',
      allowOutsideClick: false
    }).then(function() {
      location.reload(true);
    })
  }
  
  function alertaNoti(t) {
    Swal.fire({
     // position: 'bottom-end',
      icon: 'success',
      title: 'Exito',
      text: t,
      showConfirmButton: false,
      timer: 2500,
      allowOutsideClick: true
    })
  }
  
  function alertaeNoti(t) {
    Swal.fire({
      //position: 'bottom-end',
      icon: 'error',
      title: 'Error...',
      text: t,
      showConfirmButton: false,
      timer: 2500,
      allowOutsideClick: true
    })
  }
