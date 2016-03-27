angular.module('app.controllers')
    .controller('ProjectNoteNewController',
        ['$scope','$location','$routeParams','ProjectNote', function($scope,$location,$routeParams,ProjectNote){
            $scope.note = new ProjectNote();

            var idProject = $routeParams.id;
            $scope.note.project_id = idProject;

            $scope.save = function(){
                if($scope.form.$valid){
                    $scope.note.$save({id:idProject}).then(function(data){
                        console.log(data);
                        $location.path('/project/'+$routeParams.id+'/notes');
                    })
                }
            }

        }]);