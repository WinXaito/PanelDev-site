/**
 * Created by Kevin Vuilleumier on 15.02.2017.
 */

$(document).ready(function(){
    $('.upload').change(function(){
        var input = $(this).data('input');

        if(typeof input != 'undefined'){
            $('#' + input).val($(this).val());
        }
    });
});