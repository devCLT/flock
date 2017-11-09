@extends('layouts.manage')

@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">Create New User</h1>
      </div>

   </div>
   <hr class="m-t-10">
   <form action="{{route('users.store')}}" method="POST">
      {{csrf_field()}}

      <div class="columns">
         <div class="column is-three-quarters">

      <div class="field">
         <label for="name" class="label">Name:</label>
         <p class="control">
            <input type="text" class="input" name="name" id="name">
         </p>
      </div>
      <div class="field">
         <label for="email" class="label">Email:</label>
         <p class="control">
            <input type="text" class="input" name="email" id="email">
         </p>
      </div>
      <div class="field">
         <label for="password" class="label">Password:</label>
         <p class="control">
            <input type="password" class="input" name="password" id="password" v-if="!auto_password">
            <b-checkbox class="m-t-10" name="auto-generate" v-model="auto_password" >Auto Generate Password</b-checkbox>
         </p>
      </div>
   </div>

      <div class="column is-one-quarter">
         <div class="box">
            <article class="media">
               <div class="media-content">
                  <div class="content">
                     <h2 class="title">Roles:</h2>
                     <div class="block">
                        @foreach ($roles as $r)
                        <div class="field">
                           <b-checkbox v-model="rolesSelected" :native-value="{{$r->id}}">{{$r->display_name}} <em class="m-l-10">({{$r->description}})</em></b-checkbox>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </article>
         </div>

      </div>

</div>
      <button class="button is-success"><i class="fa fa-user-add m-r-10"></i>Create User</button>
      <input type="hidden" name="roles_selected" :value="rolesSelected">
      
   </form>


</div> <!-- end of flex container -->
@endsection


@section('scripts')
<script>
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
