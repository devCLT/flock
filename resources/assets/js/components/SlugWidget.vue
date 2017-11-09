<style scoped>
.slug-widget {
   display: flex;
   justify-content: flex-start;
   align-items: center;
}

.wrapper {
   margin-left: 8px;

}
.url-wrapper {
   display: flex;
   align-items: center;
   height: 28px;
}

.slug {
   background-color: #fdfd96;
   padding:   3px;
}
.input {
   width: auto;
}
</style>

<template>
    <div class="slug-widget">  <!-- Vue component needs to be contained inside a single tag -->
       <div class="icon-wrapper wrapper">
          <i class="fa fa-link"></i>
       </div>
       <div class="url-wrapper wrapper">
          <span class="root-url">{{url}}</span
          ><span class="subdirectory-url">/{{subdirectory}}/</span
          ><span class="slug" v-show="slug &&!isEditing">{{slug}}</span
          ><span class="slug-edit" v-show="isEditing"><input type="text" class="input" v-model="customSlug" name="slug" /></span>
       </div>

      <div class="button-wrapper wrapper">
         <button class="edit-slug-button button" v-show="!isEditing" @click.prevent="editSlug">Edit</button>
         <button class="edit-slug-button button" v-show="isEditing" @click.prevent="saveSlug">Save</button>
         <button class="edit-slug-button button" v-show="isEditing" @click.prevent="resetSlug">Reset</button>
      </div>

    </div>
</template>

<script>
   export default {
      // Props are one way updated from web page into component
      // cannot go from component back to web page
      //
      // events triggered will set web page fields
      props: {
         url: {
            type: String,
            required: true
         },
         subdirectory: {
            type: String,
            required: true
         },
         title: {
            type: String,
            required: true
         }
      },
      data: function() {
         return {
            slug: this.convertTitle(),
            isEditing: false,
            customSlug: '',
            wasEdited: false
         }
      },
      methods: {
         convertTitle: function() {
            return Slug(this.title)
         },
         editSlug: function() {
            this.customSlug = this.slug;
            this.isEditing = true;
         },
         saveSlug: function() {
            // TODO: run ajax to verify unique
            this.slug = Slug(this.customSlug);
            if (this.customSlug != this.slug)
            {
               this.wasEdited = true;
            }
            this.isEditing = false;
         },
         resetSlug: function() {
            this.wasEdited = false;
            this.slug = this.convertTitle();
            this.isEditing = false;
         },

      },
      watch: {
            // using lodash debounce method
            // TODO: run ajax to verify unique -- if not then customize
         title: _.debounce(function() {
            if (!this.wasEdited) {
               this.slug = this.convertTitle()
            }
         }, 500),
         slug: function(val) {
            this.$emit('slug-changed', this.slug)
         }
      },
      mounted() {

      }
   }
   </script>
