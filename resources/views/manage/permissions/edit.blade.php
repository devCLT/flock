@extends('layouts.manage')

@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">Edit Permission {{$permission->name}}</h1>         
      </div>

   </div>
   <hr class="m-t-10">
<div class="columns">
   <div class="column">
   <form action="{{route('permissions.update',$permission->id)}}" method="POST">
      {{method_field('PUT')}}      
      {{csrf_field()}}
      <div class="field">
         <label for="name" class="label">Name:</label>
            <pre>{{$permission->name}}</pre>
      </div>
      <div class="field">
         <label for="email" class="label">Display Name:</label>
         <p class="control">
            <input type="text" class="input" name="disp_name" id="disp_name"  value="{{$permission->display_name}}">
         </p>
      </div>
      <div class="field">
         <label for="email" class="label">Description:</label>
         <p class="control">
            <input type="text" class="input" name="description" id="description" value="{{$permission->description}}">
         </p>
      </div>
      <button class="button is-success"><i class="fa fa-user-add m-r-10"></i>Save Permission</button>
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