$(document).ready(function(){

    var jsons = $(".json");

    for(var i=0;i<jsons.length;i++) {
        var $el = $(jsons[i]);
        var json = JSON.parse($el.html());
        // $el.html(JSON.stringify(json,undefined,2));
        $el.JSONView(json,{collapsed: false});
    }

});