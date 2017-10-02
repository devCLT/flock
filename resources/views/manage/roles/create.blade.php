@extends('layouts.manage')

@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">Create New Role</h1>         
      </div>
      <div class="column">
         <a href="{{route('roles.store')}}" class="button is-primary is-pulled-right"><i class="fa fa-user m-r-10"></i>Create Role</a>
      </div>
   </div>
   <hr class="m-t-10">

   <form action="{{route('roles.store')}}" method="POST">
      {{csrf_field()}}

      <div class="columns">
         <div class="column">
            <div class="box">
               <article class="media">
                  <div class="media-content">
                     <div class="content">
                        <h2 class="title">Role Details:</h2>
                        <div class="field">
                           <label for="disp_name" class="label">Display Name:</label>
                           <p class="control">
                              <input type="text" class="input" name="disp_name" id="disp_name" value="{{old('display_name')}}" required>
                           </p>
                        </div>
                        <div class="field">
                           <label for="name" class="label">Slug:</label>
                           <p class="control">
                              <input type="text" class="input" name="name" id="name" placeholder="manager" value="{{old('name')}}" required>
                           </p>

                        </div>

                        <div class="field">
                           <label for="description" class="label">Description:</label>
                           <p class="control">
                              <input type="text" class="input" name="description" id="description" value="{{old('description')}}">
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
         <button class="button is-success"><i class="fa fa-user-add m-r-10"></i>Create Role</button>   
         <input type="hidden" name="permissions_selected" :value="permissionSelected">
      </form>                 

</div> <!-- end of flex container -->
@endsection

