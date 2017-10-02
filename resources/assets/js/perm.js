   var app = new Vue({
   el: '#app',
   data: {

         password_options: 'keep',
         auto_password: true,
         crudSelected : ['create', 'update'],        
         permission_options: 'basic',                        
         resource : '',
         permissionSelected : ['create-users']


         },
   methods: {
      crudName: function(item) {
         return item.substr(0,1).toUpperCase() + item.substr(1).toLowerCase() + " " + app.resource.substr(0,1) + app.resource.substr(1);
      },
      crudSlug: function(item) {
         return item.toLowerCase() + "-" + app.resource.toLowerCase();
      },
      crudDescription: function(item) {
         return "Alow a user to " + item.toUpperCase() + " a " + app.resource.substr(0,1) + app.resource.substr(1);
      },
   }
});
