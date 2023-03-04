<template>
  <div class="fixed bottom-1 mr-1 mt-1">
    <div class="flex w-12/12 h-8">
     <input type="text" v-model="message" @keyup.enter="sendMessage()" class="w-full mr-1 text-base font-normal text-gray-700 bg-white border-gray-300 rounded focus:text-gray-700 focus:outline-none" placeholder="Message"/>
     <button @click="sendMessage()" class="bg-green-400 dark:bg-green-600 text-gray-700 dark:text-white text-sm px-3 py- rounded">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
       <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
      </svg>
     </button>
    </div>
  </div>
  
</template>
  
<script>
  export default {
     props: ['room'],
     data: function () {
       return {
          message: '',
       }
     },
     methods: {
       sendMessage() {
        if(this.message == '') {
          return;
         }
         axios.post('/api/chat/room/' + this.room.id + '/message', {
           message: this.message
         })
         .then(response => {
           if(response.status == 201) {
              this.message = '';
              this.$emit('messageSent');
           }
         })
         .catch(error => {
          console.log(error);
         })
       }
     }
  }
</script>