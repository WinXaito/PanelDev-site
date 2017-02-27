/**
 * Created by Kevin Vuilleumier on 26.02.2017.
 */

$(document).ready(function(){
    var hash = window.location.hash;
    hash && $('.nav-tabs a[href="' + hash + '"]').tab('show');

    if(hash == '#files' || hash == '')
        $('.tab-content').css('display', 'block');

    $('.nav-tabs').on('shown.bs.tab', function (e) {
        $('.tab-content').css('display', 'block');
    });

    $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop() || $('html').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });
});