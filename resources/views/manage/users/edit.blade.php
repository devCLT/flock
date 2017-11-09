@extends('layouts.manage')


@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">Edit {{$user->name}} Details</h1>
      </div>

   </div>
   <hr class="m-t-10">
   <form action="{{route('users.update', $user->id)}}" method="POST">
      {{method_field('PUT')}}
      {{csrf_field()}}

<div class="columns">
   <div class="column">
      <div class="field">
         <label for="name" class="label">Name:</label>
         <p class="control">
            <input type="text" class="input" name="name" id="name" value="{{$user->name}}">
         </p>
      </div>
      <div class="field">
         <label for="email" class="label">Email:</label>
         <p class="control">
            <input type="text" class="input" name="email" id="email" value="{{$user->email}}">
         </p>
      </div>
      <div class="field">
         <label for="password" class="label">Password:</label>
<div class="field">
    <b-radio v-model="password_options" native-value="keep">Do not change Password</b-radio>
</div>
<div class="field">
    <b-radio v-model="password_options" native-value="auto">Auto generate Password</b-radio>
</div>
<div class="field">
    <b-radio v-model="password_options" native-value="manual">Manually set Password</b-radio>
    <p class="control m-t-10">
        <input type="text" class="input"
               name="password" id="password"
               v-if="password_options == 'manual'"
               placeholder="Enter your password">
    </p>
</div>
      </div>

</div>

         <div class="column">
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
      <button class="button is-success"><i class="fa fa-user-add m-r-10"></i>Save User</button>

         <input type="hidden" name="roles_selected" :value="rolesSelected">
         <input type="hidden" name="dummy" v-text="popRole({{$user->roles->pluck('id')}})">


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
