$(document).ready(function(){
    // au clic sur un lien
    $('a[href^="#"]').on('click', function(evt){
    evt.preventDefault();
    let target = $(this).attr('href');
    /* le sélecteur $(html, body) permet de corriger un bug sur chrome et safari (webkit) */
    $('html, body').stop().animate({scrollTop: ($(target).offset().top)-145}, 1000 ); // stop arrête toutes les animations en cours
    });
});