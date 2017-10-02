@extends('layouts.manage')

@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">Edit {{$role->display_name}}</h1>         
         <h5>{{$role->description}}</h5>
      </div>
      <div class="column">
         <a href="{{route('roles.edit', $role->id)}}" class="button is-primary is-pulled-right"><i class="fa fa-user m-r-10"></i>Edit Role</a>
      </div>
   </div>
   <hr class="m-t-10">

   <form action="{{route('roles.update',$role->id)}}" method="POST">
      {{method_field('PUT')}}      
      {{csrf_field()}}

      <div class="columns">
         <div class="column">
            <div class="box">
               <article class="media">
                  <div class="media-content">
                     <div class="content">
                        <h2 class="title">Role Details:</h2>
                        <div class="field">
                           <label for="name" class="label">Name:</label>
                           <pre>{{$role->name}}</pre>
                        </div>
                        <div class="field">
                           <label for="disp_name" class="label">Display Name:</label>
                           <p class="control">
                              <input type="text" class="input" name="disp_name" id="disp_name"  value="{{$role->display_name}}">
                           </p>
                        </div>
                        <div class="field">
                           <label for="description" class="label">Description:</label>
                           <p class="control">
                              <input type="text" class="input" name="description" id="description" value="{{$role->description}}">
                           </p>
                        </div>

                     </div>
                  </div>
               </article>
            </div>

         </div> <!-- End Roll details column -->
      </div>
      <div class="columns">
         <div class="column">
            <div class="box">
               <article class="media">
                  <div class="media-content">
                     <div class="content">
                        <h2 class="title">Permissions:</h2>
                        <div class="block">
                           @foreach ($permissions as $p)
                           <div class="field">
                              <b-checkbox v-model="permissionSelected" :native-value="{{$p->id}}">{{$p->display_name}} <em class="m-l-10">({{$p->description}})</em></b-checkbox>
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </article>
            </div>

         </div>
      </div>
         <button class="button is-success"><i class="fa fa-user-add m-r-10"></i>Save Role</button>   
         <input type="hidden" name="permissions_selected" :value="permissionSelected">
         <input type="hidden" name="dummy" v-text="popPerm({{$role->permissions->pluck('id')}})">
      </form>                 

</div> <!-- end of flex container -->
@endsection

