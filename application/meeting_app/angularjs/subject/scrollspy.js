app.directive('scrollspy', function($window) {

    var $win = angular.element($window); // wrap window object as jQuery object

    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var topClass = attrs.scrollspy, // get CSS class from directive's attribute value
                offsetTop = element.offset().top -184; // get element's offset top relative to document
            console.log("plop");

            $win.on('scroll', function (e) {
                if ($win.scrollTop() >= offsetTop) {
                    element.addClass(topClass);
                } else {
                    element.removeClass(topClass);
                }
            });
        }
    };
});
