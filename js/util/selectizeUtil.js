function setSelectizeOpt(data){
    var res = [];
    var curr = 0;
    for(var key in data){
        var keySplit = key.split(",");
        var optData = {};
        // alert(keySplit[0]);
        optData.id = keySplit[0];
        optData.name = keySplit[1];
        res[curr++] = optData;
    }
    return res;
}
function setSelectizeOptWithLimit(data,limit){
    var res = [];
    var curr = 0;

    // alert(limit);
    for(var dataKey in data){
        var dataKeySplit = dataKey.split(",");
        for(var limitKey in limit){
         if(dataKeySplit[2] == limit[limitKey]){
                // alert(limit[limitKey]);
                var optData = {};
                optData.id = dataKeySplit[0];
                optData.name = dataKeySplit[1];
                // alert(optData);
                res[curr++] = optData;
            }
        }
            
    }
    return res;
}

 