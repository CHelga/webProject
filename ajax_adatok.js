$('#felhasznalok').hide();
$(document).on('click', function(e) {
    if ( $(e.target).closest('#edit').length ) {
        $("#felhasznalok").show();
        setTimeout(function() {
            $('#felhasznalok').hide();
        }, 2000);
    }else if ( ! $(e.target).closest('#felhasznalok').length ) {
        $('#felhasznalok').hide();
    }
});