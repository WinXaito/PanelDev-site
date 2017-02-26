/**
 * Created by Kevin Vuilleumier on 26.02.2017.
 */

$('#myTabs a').click(function(e){
    e.preventDefault();
    $(this).tab('show');
});