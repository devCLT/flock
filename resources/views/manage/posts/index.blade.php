@extends('layouts.manage')

@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">Blog Posts</h1>         
      </div>
      <div class="column">
         <a href="{{route('posts.create')}}" class="button is-primary is-pulled-right"><i class="fa fa-user-add m-r-10"></i>Create New Blog Post</a>
      </div>
   </div>
   <hr>
   <div class="card">
      <div class="card-content">
         <table class="table is-narrow">
            {{--
            <thead>
               <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Date Created</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
               <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->created_at->toFormattedDateString()}}</td>
                  <td>
                     <a href="{{route('users.show', $user->id)}}" class="button is-outlined m-l-15">View</a>                     
                     <a href="{{route('users.edit', $user->id)}}" class="button is-outlined m-l-15">Edit</a>
                     <a href="{{route('users.destroy', $user->id)}}" class="button is-outlined">Delete</a>
                  </td>
               </tr>
               @endforeach
            </tbody>
            --}}
         </table>
      </div>
   </div>
   
   {{-- $users->links() --}}
</div>


@endsection