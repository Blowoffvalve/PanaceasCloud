function getDataFromPHP(url){
    var finalData = null;
    $.ajax({
        type: "GET",
        url: url,
        async: false, /* If set to non-async, browser shows page as "Loading.."*/
        cache: false,
        success:function(data){
            if(data != ""){
                finalData = data;
            }
        },
        error: function(){
            // alert("Data collection error");
        }

    });//end ajax
    return finalData;
}//end getDataFromPhp


