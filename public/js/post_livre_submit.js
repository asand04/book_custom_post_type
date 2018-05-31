jQuery( document ).ready( function ( $ ) {
    $( '#fep-new-post' ).on( 'submit', function(e) {
        
        e.preventDefault();
       
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: post_livre_submit,
            data: {
            'action': 'fep_add_post',
            'titre': $( 'form#fep-new-post #nom' ).val(), 
            'nom': $( 'form#fep-new-post #nom' ).val(),
            'auteur': $( 'form#fep-new-post #auteur' ).val(),
            'nombre_de_pages': $( 'form#fep-new-post #nombre_de_pages' ).val(),
            'categorie': $('form#fep-new-post #categorie').val(),
            'resume': $('form#fep-new-post #resume').val(),
        },
            
            success: function(data){
                
                $( 'form#fep-new-post #result' ).html("<h2>"+data.message+"</ph2>");
            },
        });
    });

} );