var app = angular.module('panaceasCloudApp', []) 
//['validation', 'uploadPhoto'] original dependency
.controller('panaceasCloudController', function($scope,$http) {
  // console.log($scope);
  $scope.patientData =  JSON.parse(getDataFromPHP("loadPatientData.php"));
  $scope.staffData =  JSON.parse(getDataFromPHP("loadStaffData.php"));
  $scope.incidentData = JSON.parse(getDataFromPHP("loadIncidentData.php"));

  $scope.incidentFilterData = null;
  var staffFilterBar = document.getElementById('staffFilterBar');
  var patientFilterBar = document.getElementById('patientFilterBar');

  var patientIds = [];

  $scope.initStaData = function(staffData){
      var postData = [];
      var curr = 0;
      for(var staffKey in staffData){
          var staffKeyArray = staffKey.split(",");
          var sta_data = {};
          sta_data.staffId = staffKeyArray[0];
          sta_data.staffName = staffKeyArray[1];
          for(var key in staffData[staffKey]){
            var tmpJsonData = JSON.parse(staffData[staffKey][key]);
            sta_data.staffTime = tmpJsonData.sTime;
            sta_data.staffLat = tmpJsonData.sta_lat;
            sta_data.staffLng = tmpJsonData.sta_lng;
            break;
          }      
          // console.log(sta_data.staffId + "," + sta_data.staffName + "," + sta_data.staffTime + "," + sta_data.staffLat + "," + sta_data.staffLng);
          postData[curr++] = sta_data;
      }
      return postData;
  }

  $scope.initPatData = function(patientData){
      var postData = [];
      var curr = 0;
      for(var patientKey in patientData){
          var patientKeyArray = patientKey.split(",");
          var pat_data = {};
          pat_data.patientId = patientKeyArray[0];
          pat_data.patientName = patientKeyArray[1];
          for(var key in patientData[patientKey]){
            var tmpJsonData = JSON.parse(patientData[patientKey][key]);
            pat_data.patientTime = tmpJsonData.pTime;
            pat_data.patientLat = tmpJsonData.pat_lat;
            pat_data.patientLng = tmpJsonData.pat_lng;
            pat_data.patientStatus = tmpJsonData.pStatus;
            break;
          }      
          // console.log(pat_data.patientId + "," + pat_data.patientName + "," + pat_data.patientTime + "," + pat_data.patientLat + "," + pat_data.patientLng + "," + pat_data.patientStatus);
          postData[curr++] = pat_data;
      }
      return postData;
  }


  $scope.staffPostData = $scope.initStaData($scope.staffData);
  $scope.patientPostData = $scope.initPatData($scope.patientData);

  $scope.patientModalData = collectModalData($scope.patientPostData);
  initialize($scope.staffPostData,$scope.patientPostData);

  var incSelecOpt = setSelectizeOpt($scope.incidentData);
  var incSelectize = $("#incidentFilter").selectize({
    //options here
        maxItems: 1,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        options: incSelecOpt,
        create: false,
        onChange : function(value){
            $scope.changeSwitch(value);
            $scope.staffPostData = $scope.setStaPostData($scope.staffData,value,staSelectize[0].selectize.getValue());
            $scope.patientPostData = $scope.setPatPostData($scope.patientData,value,patSelectize[0].selectize.getValue());
            localRefresh($scope.staffPostData,$scope.patientPostData);
           // $scope.setPatPostData($scope.patientData,value,staSelectize[0].selectize.getValue());
           // setStaffPatientFilter(value,$scope.staffFilterSwitch,$scope.patientFilterSwitch);
        }
  });
  // incSelectize.clearOptions();
  var patSelecOpt = [{status:"MINOR"},{status:"IMMEDIATE"},{status:"DELAYED"},{status:"MORGUE"}];
  var patSelectize = $("#patientFilter").selectize({
    //options here
        maxItems: 4,
        valueField: 'status',
        labelField: 'status',
        searchField: 'status',
        options: patSelecOpt,
        create: false,
        onChange : function(value){
            // alert(value);
            $scope.patientPostData = $scope.setPatPostData($scope.patientData,incSelectize[0].selectize.getValue(),value);
            localRefresh($scope.staffPostData,$scope.patientPostData);
        }
  }); 
  var staSelecOpt = setSelectizeOpt($scope.staffData);;
  var staSelectize = $("#staffFilter").selectize({
    //options here
        maxItems: 10,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        options: staSelecOpt,
        create: false,
        onChange : function(value){
            // var staValue = value;
            // alert(incSelectize[0].selectize.getValue());
            $scope.staffPostData = $scope.setStaPostData($scope.staffData,incSelectize[0].selectize.getValue(),value);
            // console.log($scope.staffPostData);
            // console.log($scope.patientPostData);
            localRefresh($scope.staffPostData,$scope.patientPostData);

        }
  }); 
  // staSelectize.clearOptions();

  $scope.setStaPostData = function(staffData,incLimit,staLimit){
      var postData = [];
      // alert(incLimit+"*"+staLimit);
      var curr = 0;
      if(staLimit != null && staLimit != ""){
        for(var staffKey in staffData){
            var staffKeyArray = staffKey.split(",");   
            // alert(staffKeyArray[0]);
            // console.log(staffKeyArray[0] + "," + staLimit + "," + staffKeyArray[2]+ "," + incLimit);
            if(staLimit.indexOf(staffKeyArray[0]) != -1){

                var sta_data = {};
                sta_data.staffId = staffKeyArray[0];
                sta_data.staffName = staffKeyArray[1];
                for(var key in staffData[staffKey]){
                  var tmpJsonData = JSON.parse(staffData[staffKey][key]);
                  sta_data.staffTime = tmpJsonData.sTime;
                  sta_data.staffLat = tmpJsonData.sta_lat;
                  sta_data.staffLng = tmpJsonData.sta_lng;
                  break;
                }      
                // console.log(sta_data.staffId + "," + sta_data.staffName + "," + sta_data.staffTime + "," + sta_data.staffLat + "," + sta_data.staffLng);
                postData[curr++] = sta_data;
            }         
        }
      }else{
        var curr = 0;
        for(var staffKey in staffData){
            var staffKeyArray = staffKey.split(",");
            var sta_data = {};
            sta_data.staffId = staffKeyArray[0];
            sta_data.staffName = staffKeyArray[1];
            for(var key in staffData[staffKey]){
              var tmpJsonData = JSON.parse(staffData[staffKey][key]);
              sta_data.staffTime = tmpJsonData.sTime;
              sta_data.staffLat = tmpJsonData.sta_lat;
              sta_data.staffLng = tmpJsonData.sta_lng;
              break;
            }      
            // console.log(sta_data.staffId + "," + sta_data.staffName + "," + sta_data.staffTime + "," + sta_data.staffLat + "," + sta_data.staffLng);
            postData[curr++] = sta_data;
        }
      }
      return postData;
  
  }

      $scope.setPatPostData = function(patientData,incLimit,patLimit){
          var postData = [];
          // alert(incLimit+"*"+staLimit);
          if(patLimit != "" && patLimit != null){
              var curr = 0;
              for(var patientKey in patientData){
                var patientKeyArray = patientKey.split(",");
                if(patLimit.indexOf(patientKeyArray[4]) != -1){

                    var pat_data = {};
                    pat_data.patientId = patientKeyArray[0];
                    pat_data.patientName = patientKeyArray[1];
                    for(var key in patientData[patientKey]){
                      var tmpJsonData = JSON.parse(patientData[patientKey][key]);
                      pat_data.patientTime = tmpJsonData.pTime;
                      pat_data.patientLat = tmpJsonData.pat_lat;
                      pat_data.patientLng = tmpJsonData.pat_lng;
                      pat_data.patientStatus = tmpJsonData.pStatus;
                      break;
                    }      
                    // console.log(pat_data.patientId + "," + pat_data.patientName + "," + pat_data.patientTime + "," + pat_data.patientLat + "," + pat_data.patientLng + "," + pat_data.patientStatus);
                    postData[curr++] = pat_data;
                }         
              }
            }else{
              var curr = 0;
              for(var patientKey in patientData){
                  var patientKeyArray = patientKey.split(",");
                  var pat_data = {};
                  pat_data.patientId = patientKeyArray[0];
                  pat_data.patientName = patientKeyArray[1];
                  for(var key in patientData[patientKey]){
                    var tmpJsonData = JSON.parse(patientData[patientKey][key]);
                    pat_data.patientTime = tmpJsonData.pTime;
                    pat_data.patientLat = tmpJsonData.pat_lat;
                    pat_data.patientLng = tmpJsonData.pat_lng;
                    pat_data.patientStatus = tmpJsonData.pStatus;
                    break;
                  }      
                  // console.log(pat_data.patientId + "," + pat_data.patientName + "," + pat_data.patientTime + "," + pat_data.patientLat + "," + pat_data.patientLng + "," + pat_data.patientStatus);
                  postData[curr++] = pat_data;
              }
          }
          return postData;
      }



  $scope.setRefreshInterval = function(){
      var intervalWholeMap = setInterval(
          function(){
              $scope.patientData =  JSON.parse(getDataFromPHP("loadPatientData.php"));
              $scope.staffData =  JSON.parse(getDataFromPHP("loadStaffData.php"));
              $scope.incidentData = JSON.parse(getDataFromPHP("loadIncidentData.php"));
              $scope.staffPostData = $scope.initStaData($scope.staffData);
              $scope.patientPostData = $scope.initPatData($scope.patientData);
              if(incSelectize[0].selectize.getValue != "" && incSelectize[0].selectize.getValue != null){
                  $scope.staffPostData = $scope.setStaPostData($scope.staffData,incSelectize[0].selectize.getValue(),staSelectize[0].selectize.getValue());
                  localRefresh($scope.staffPostData,$scope.patientPostData);

                  $scope.patientPostData = $scope.setPatPostData($scope.patientData,incSelectize[0].selectize.getValue(),patSelectize[0].selectize.getValue());
                  localRefresh($scope.staffPostData,$scope.patientPostData);
              }else{
                  initialize($scope.staffPostData,$scope.patientPostData);
              }
              
          },
          12000);
  }

  $scope.setRefreshInterval();

  $scope.searchLocation = function(){
      if($scope.locationSearchBar != ""){
          geoLocate($scope.locationSearchBar + ",Columbia,MO,USA");
          
      }else{
          showWholeMap();
      }
  }


  
  $scope.detectModal = function(pid){
      detectModalUtil(pid,$scope.patientModalData);
  }

});//end controller

app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
 
                event.preventDefault();
            }
        });
    };
});