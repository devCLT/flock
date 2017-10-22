
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./manage');

window.Vue = require('vue');
import Buefy from 'buefy';

Vue.use(Buefy);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
var app = new Vue({
   el: '#app',
   data: {

         password_options: 'keep',
         auto_password: true,
         crudSelected : ['create', 'read', 'update', 'delete'],        
         permission_options: 'basic',                        
         resource : '',
         permissionSelected : [],
         permissionInit : true,
         rolesSelected : [],
         roleInit : true


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
      popPerm: function(arrItem) {
         if (this.permissionInit)
         {
           this.permissionSelected = arrItem;
           this.permissionInit = false;
         }
         return "ok";
      },      
      popRole: function(arrItem) {
         if (this.roleInit)
         {
           this.rolesSelected = arrItem;
           this.roleInit = false;
         }
         return "ok";
      },      

   }
});

//$(document).ready(function() {
//   $('button.dropdown').hover(function(e) {
//      $(this).toggleClass('is-open');
//   });
//});


