app.directive('zeappsHappylittletree',
    function(){
        return{
            restrict: 'E',
            replace: true,
            scope: {
                tree: '=',
                activeBranch: '='
            },
            template:   '<ul class="tree list-unstyled">' +
                            '<branch ng-repeat="branch in tree" data-branch="branch" data-active-branch="activeBranch"></branch>' +
                        '</ul>'
        }
})

.directive('branch', function($compile){
    return{
        restrict: 'E',
        replace: true,
        scope: {
            branch: '=',
            activeBranch: '='
        },
        template:   "<li class='branch' ng-class='{\"open\": isOpen(), \"disabled\": !hasBranches() && !hasLeaves()}'>" +
                        "<span class='branch-name text-capitalize' ng-class='{\"bg-primary\": isCurrent(branch.id)}' ng-click='toggleBranch()'>" +
                            "<span class='glyphicon glyphicon-folder-close' aria-hidden='true' ng-hide='isOpen()'></span>" +
                            "<span class='glyphicon glyphicon-folder-open' aria-hidden='true' ng-show='isOpen()'></span>" +
                            "{{ branch.name }}" +
                        "</span>" +
                    "</li>",
        link: function(scope, element, attrs){
            if(angular.isArray(scope.branch.branches)){
                $compile("<zeapps-happylittletree data-tree='branch.branches' data-active-branch='activeBranch'></zeapps-happylittletree>")(scope, function(cloned, scope){
                    element.append(cloned);
                });
            }


            scope.toggleBranch = function(){
                scope.branch.open = !scope.branch.open;
                scope.activeBranch.data = scope.branch;
            };

            scope.hasBranches = function(){
                return angular.isArray(scope.branch.branches);
            };

            scope.hasLeaves = function(){
                return angular.isArray(scope.branch.leaves);
            };

            scope.isOpen = function(){
                return scope.branch.open;
            };

            scope.isCurrent = function(id){
                return id == scope.activeBranch.data.id;
            };
        }
    }
});