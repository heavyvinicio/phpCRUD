
//jQuery para validar los campos obligatorios
// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='update']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      dni: "required",
      nombre: "required",

      direccion: {
        required: true,
        minlength: 15
      },
      edad: {
        required: true,

        number: true,
         digits: true,
         range: [10, 100]
      }
    },
    // Specify validation error messages
    messages: {
      dni: "Ingrese su DNI",
      nombre: "Ingrese sus nombres completos",
      direccion: {
        required: "Ingrese la dirección",
        minlength: "La direccion deberia tener almenos 15 caracteres"
      },
      edad: {
          required: "Ingrese su edad",

          number: "Debe ingresar números",
          digits: "Debe ingresar números",
          range: "La edad debe estar entre 10 y 100 años"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
