@extends('layouts.manage')

@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">{{$user->name}}</h1>
         <h4 class="subtitle">View User Details</h4>
      </div>
         <div class="column">
         <a href="{{route('users.edit', $user->id)}}" class="button is-primary is-pulled-right"><i class="fa fa-user m-r-10"></i>Edit User</a>
      </div>
   </div>



<hr class="m-t-10">
<div class="columns">
   <div class="column">

      <div class="field">
         <label for="name" class="label">Name:</label>
         <pre>{{$user->name}} </pre>
      </div>
      <div class="field">
         <label for="email" class="label">Email:</label>
         <pre>{{$user->email}} </pre>
      </div>

      <div class="field">
         <label for="role" class="label">Roles:</label>
         <label class="label m-l-15" v_cloak v-if="{{$user->roles->count()}} == 0"> ** NO ASSIGNED ROLES **</label>
         <ul>
            @foreach ($user->roles as $role)
            <li>{{$role->display_name}}<em class="m-l-10">({{$role->description}})</em></li>
            @endforeach
         </ul>
      </div>


   </div>
</div>

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
