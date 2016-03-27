angular.module('app.controllers')
    .controller('ProjectNoteShowController',
        ['$scope','$routeParams','ProjectNote', function($scope,$routeParams,ProjectNote){
        $scope.note = ProjectNote.query({id:$routeParams.id,idNote:$routeParams.idNote});

    }]);