@extends('layouts.manage')

@section('content')
<div class="flex-container">
   <div class="columns m-t-10">
      <div class="column">
         <h1 class="title">Create New Blog Post</h1>
      </div>

   </div>
   <hr class="m-t-10">
<div class="columns">
   <div class="column">
   <form action="{{route('posts.store')}}" method="POST">
      {{csrf_field()}}
      <div class="columns">
         <div class="column is-three-quarter is-desktop">
            <b-field>
               <b-input type="text" placeholder="Post My Title" size="is-large" name="title" v-model="title">
               </b-input>
            </b-field>

            <p>
               <slug-widget url="{{url('/')}}" subdirectory="blog" :title="title" @copied="slugCopied" @slug-changed="updateSlug" ></slug-widget>
               <input type="hidden" v-model="slug" name="slug">
            </p>

            <b-field class="m-t-40">
               <b-input type="textarea"
                  placeholder="Compose your masterpiece here....." rows="20" name="post_content" >
               </b-input>
            </b-field>

            <div class="field">
               <label for="excerpt" class="label">Excerpt:</label>
               <p class="control">
                  <input type="text" class="input" name="excerpt" id="excerpt" >
               </p>
            </div>
         </div> <!-- end of 3/4 column -->

         <div class="column is-one-quarter-desktop is-narrow">
            <div class="card card-widget">
                  <div class="author-widget widget-area">
                     <div class="selected-author">
                        <img src="https://placehold.it/50x50" />
                        <div class="author">
                           <h4>By: CLT</h4>
                           <p class="subtitle">
                              (clt)
                           </p>
                        </div>
                     </div>

                  <div class="post-status-widget">
                     <div class="status">
                        <div class="status-icon">
                           <b-icon icon="assignment"></b-icon>
                        </div>
                        <div class="status-details">
                           <h4><span class="status-emphasis">Draft</span> Saved</h4>
                           <p>A few minutes ago</p>
                        </div>
                     </div>
                  </div>

                  <div class="publish-buttons-widget">
                     <div class="secondary-button-action">
                        <button class="button is-outlined is-info">Save Draft</button>
                     </div>
                     <div class="primary-button-action">
                        <button class="button is-primary">Publish</button>
                     </div>
                  </div>
               </div>  <!-- end author widget -->
            </div>
         </div>  <!-- end of 1/4 column -->
      </div> <!-- end of all columns -->


      <button class="button is-success"><i class="fa fa-user-add m-r-10"></i>Create Blog Post</button>
   </form>

   </div>
</div>

</div> <!-- end of flex container -->
@endsection

@section('scripts')
<script>

   var app = new Vue({
   el: '#app',
   data: {
         title: '',
         slug: '',
         api_token: '{{Auth::user()->api_token}}'
         },
   methods: {
      updateSlug: function(val) {
         this.slug = val;
      },
      slugCopied: function(rspType, msg, val) {
         notifications.toast(msg, {type: 'is-${rspType}'});
      }
   }
});
   </script>
@endsection
