 angular
       .module('app')
       .controller('ParceirosController', ['$scope', '$http', 'serviceUtil', function($scope, $http,service){

    	   var url = service.getUrl();
    	   
    	   $scope.filtroCidade = {cidade : 'todas'};
    	   
    	   $scope.listar = function(){
    	         $http.post(url + 'php/consulta.php/consultarParceiros', {cidade : $scope.filtroCidade.cidade}).then(function(data){
    	            $scope.listaParceiros = data.data;
    	            }, function(erro){
    	             service.alertarErro(erro.statusText);
    	            });
    	       }
    	   
    	   $scope.listar();
    	   
    }]);