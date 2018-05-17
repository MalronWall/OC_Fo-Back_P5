// CLASS FOR GO TO THE PREVIOUS PAGE
$(".js-goPageBefore").click( function () {
    window.history.back();
});

// CLASS FOR VALIDATE CAPTCHA (la fonction, data-callback="verifyRecaptchaCallback", intégrée à Bootstrap n'a pas l'air de fonctionner)
const input = document.querySelector(".captcha-custom-checker");
function onUserSubmit(response) {
    input.checked = true;
}

// TYNYMCE
tinymce.init({ selector:'.tinymce' });

// SHOW OR HIDE PASSWORD
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').removeClass( "fa-eye" );
            $('#show_hide_password i').addClass( "fa-eye-slash" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});

// DISABLE FORM SUBMISSION IF NOT VALIDATED
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        const validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// FOR THE DOWNLOAD BUTTON
'use strict';

( function ( document, window, index )
{
    const inputs = document.querySelectorAll('.upload');
    Array.prototype.forEach.call( inputs, function( input )
    {
        const label	 = input.previousElementSibling,
            labelVal = label.innerHTML;

        input.addEventListener( 'change', function( e )
        {
            let fileName = '';
            if( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else
                fileName = e.target.value.split( '\\' ).pop();

            if( fileName )
                label.querySelector( 'span' ).innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
        input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
    });
}( document, window, 0 ));

