app.factory('zeapps_productFactory', ['$http',
    function ($http) {
        var get_categories_tree = function(){
            return $http.get('/com_zeapps_crm/product/get_categories_tree');
        };
        var get_category = function(id){
            return $http.get('/com_zeapps_crm/product/get_category/'+id);
        };
        var save_category = function(data){
            return $http.post('/com_zeapps_crm/product/save_category', data);
        };
        var update_category_order = function(data){
            return $http.post('/com_zeapps_crm/product/update_categories_order', data);
        };
        var delete_category = function(id){
            return $http.post('/com_zeapps_crm/product/delete_category/'+id);
        };
        var force_delete_category = function(id){
            return $http.post('/com_zeapps_crm/product/delete_category/'+id+'/true');
        };
        var safe_delete_category = function(id){
            return $http.post('/com_zeapps_crm/product/delete_category/'+id+'/false');
        };
        var get_product = function(id){
            return $http.get('/com_zeapps_crm/product/get_product/'+id);
        };
        var get_products_of = function(id){
            return $http.get('/com_zeapps_crm/product/getProductsOf/'+id);
        };
        var save_product = function(data){
            return $http.post('/com_zeapps_crm/product/save_product', data);
        };
        var delete_product = function(id){
            return $http.post('/com_zeapps_crm/product/delete_product/'+id);
        };

        var recursiveOpening = function(branch, id){
            if(angular.isArray(branch.branches)){
                for(var i = 0; i < branch.branches.length; i++){
                    if(recursiveOpening(branch.branches[i], id)){
                        branch.open = true;
                        return true;
                    }
                }
            }
            if(branch.id == id){
                return true;
            }
            else{
                return false;
            }
            return false;
        };

        return {
            get: {
                tree: get_categories_tree,
                category: get_category,
                product: get_product,
                products_of: get_products_of
            },
            save: {
                category: save_category,
                product: save_product
            },
            update: {
                category_order: update_category_order
            },
            delete: {
                category: delete_category,
                product: delete_product
            },
            safe_delete: {
                category: safe_delete_category
            },
            force_delete: {
                category: force_delete_category
            },
            openTree: recursiveOpening
        }

    }]);