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

