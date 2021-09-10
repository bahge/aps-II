function loadMenu(menuId, path) {
    $.getJSON( path, function( data ) {
        var items = '';
        $.each( data, function( key, val ) {
            if (key == 'menu'){
                $.each( val, function( item, val ) {
                    items += '<li><a class="grey-text text-lighten-3" href="' + val.link + '">' + val.text + '</a></li>';
                });
            }
        });
        $("#"+ menuId +" ul").append(items);
    }).fail(function(err){
        console.log(err)
    });
}