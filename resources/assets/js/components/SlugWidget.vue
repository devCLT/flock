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
            isEditing: false,
            customSlug: '',
            wasEdited: false,
            api_token: this.$root.api_token,
            slug: this.setSlug(this.title)
         }
      },
      methods: {
         editSlug: function() {
            this.customSlug = this.slug;
            this.isEditing = true;
         },
         saveSlug: function() {
            if (this.customSlug !== this.slug)
            {
               this.wasEdited = true;
            }
            this.isEditing = false;
            this.setSlug(this.customSlug);
         },
         resetSlug: function() {
            this.setSlug(this.title);
            this.wasEdited = false;
            this.isEditing = false;
         },
         setSlug: function(newVal, count = 0) {
            // Slugify newVal
            let localSlug = Slug(newVal + (count > 0 ? `-${count}` : '' ));
            let vm = this;
            // test unique
               if (vm.api_token && localSlug && vm.url)
               {
               axios.get(vm.url + '/api/posts/unique', {
                  params: {
                     api_token: vm.api_token,
                     slug: localSlug
                  }
               }).then(function (response) {
                  // if unique set Slugify and emit event
                  if (response.data)
                  {
                     vm.slug = localSlug;
                     vm.$emit('slug-changed', localSlug);
                  }
                  else {
                     vm.setSlug(newVal, count+1);
                  }
                  // if not the customerize slug and test again

               }).catch(function (error) {
                  console.log(error);
               });
            }
         },
         copyToClipboard: function(val) {
           let temp = document.createElement('textarea');
           temp.value = val;
           document.body.appendChild(temp);
           temp.select();
           try {
             let success = document.execCommand('copy');
             let rspType = (success ? 'success' : 'warning');
             let msg = (success ? 'Copied to Clipboard: $(val)' : 'Copy failed, your browser may not support this feature');
             this.$emit('copied', rspType, msg, val);

           }
           catch (err) {
             this.$emit('copy-failed', val);
             console.log('Copy failed, your browser may not support this feature');
             console.log('Attempted to copy: ', val);
           }
           document.body.removeChild(temp);
         }

      },
      watch: {
            // using lodash debounce method
         title: _.debounce(function() {
            if (!this.wasEdited) {
               this.slug = this.setSlug(this.title)
            }
         }, 500)

      },
      mounted() {

      }
   }
   </script>
