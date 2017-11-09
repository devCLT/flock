@extends('layouts.manage')

@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">Create New Permission</h1>         
      </div>

   </div>
   <hr class="m-t-10">
   <div class="columns">
      <div class="column">
         <form action="{{route('permissions.store')}}" method="POST">
            {{csrf_field()}}

            <div class="field m-b-20">
               <b-radio name="permission_options" v-model="permission_options" native-value="basic">Basic Permission</b-radio>
               <b-radio name="permission_options" v-model="permission_options" native-value="crud">CRUD Permission</b-radio>
            </div> <!-- END OF radio button group -->

            <div class="field" v-if="permission_options == 'basic'">
               <div class="field">
                  <label for="email" class="label">Display Name:</label>
                  <p class="control">
                     <input type="text" class="input" name="disp_name" id="disp_name">
                  </p>
               </div>
               <div class="field">
                  <label for="name" class="label">slug:</label>
                  <p class="control">
                     <input type="text" class="input" name="name" id="name">
                  </p>
               </div>
               <div class="field">
                  <label for="email" class="label">Description:</label>
                  <p class="control">
                     <input type="text" class="input" name="description" id="description">
                  </p>
               </div>
            </div> <!-- end of Basic Permisisons -->

            <div class="field" v-if="permission_options == 'crud'">
               <div class="field">
                  <label for="name" class="label">Name of the Resource</label>
                  <p class="control">
                     <input type="text" class="input" name="resource" id="resource" v-model="resource">
                  </p>
               </div>
               <div class="columns">
                  <div class="column">
                     <div class="block">
                        <div class="field">
                           <b-checkbox v-model="crudSelected" native-value="create">Create</b-checkbox>
                        </div>
                        <div class="field">
                           <b-checkbox v-model="crudSelected" native-value="read">Read</b-checkbox>
                        </div>
                        <div class="field">
                           <b-checkbox v-model="crudSelected" native-value="update">Update</b-checkbox>
                        </div>
                        <div class="field">
                           <b-checkbox v-model="crudSelected" native-value="delete">Delete</b-checkbox>
                        </div>
                     </div>               
                  </div> <!-- end of crud column -->

                  <input type="hidden" name="crud_selected" :value="crudSelected">

                  <div class="column">
                     <table class="table">
                        <thead>
                           <th>Name</th>
                           <th>Slug</th>
                           <th>Description</th>
                        </thead>
                        <tbody v-if="resource.length >= 3">
                           <tr v-for="item in crudSelected">
                              <td v-text="crudName(item)"></td>
                              <td v-text="crudSlug(item)"></td>
                              <td v-text="crudDescription(item)"></td>                                                
                           </tr>
                        </tbody>
                     </table>
                  </div>    <!-- end of crud table -->

               </div> <!-- end of crud columnS -->

            </div> <!-- end of CRUD Permisisons -->
      <button class="button is-success"><i class="fa fa-user-add m-r-10"></i>Create Permisison</button>
      </form>
   </div>
</div>

</div> <!-- end of flex container -->
@endsection


@section('scripts')
<script>
   alert('ok');
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
   </script>
@endsection
