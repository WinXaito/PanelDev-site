/**
 * Created by Kevin Vuilleumier on 26.02.2017.
 */

var URL = "/winxaito/paneldev";
$.getJSON(URL + "/ajax/print3d/gcode/1", function(data){
    //var obj = $.parseJSON(data.response);
    //alert(obj);

    $.each(data, function (index, value) {
        if(index == 'files'){
            $.each(value, function(i2, v2){
                $.each(v2, function(i3, v3){
                    if(i3 == 'content') {
                        $.each(v3, function(i4, v4){
                            //valueArray.forEach(function (entry) {
                            //});
                        });

                    }
                });
            });
        }
    });

    /*var items = [];
    $.each( data, function( key, val ) {
        items.push( "<li id='" + key + "'>" + val + "</li>" );
    });

    $( "<ul/>", {
        "class": "my-new-list",
        html: items.join( "" )
    }).appendTo( "body" );*/
});