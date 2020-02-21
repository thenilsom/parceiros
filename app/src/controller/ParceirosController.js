 angular
       .module('app')
       .controller('ParceirosController', ['$scope', '$http', 'serviceUtil', function($scope, $http,service){

    	   var url = service.getUrl();
    	   
    	   var listar = function(){
    	         $http.post(url + 'php/consulta.php/consultarParceiros', {cidade : 'todas'}).then(function(data){
    	            $scope.listaParceiros = data.data;
    	            }, function(erro){
    	             service.alertarErro(erro.statusText);
    	            });
    	       }
    	   
    	   listar();
    	   
    }]);