<template>
  <div class="flex flex-col bg-gray-200 dark:bg-c-black text-gray-700 h-auto px-2 py-1 mx-2 mb-1 shadow rounded">
    <div class="flex">
    <div class="flex items-center justify-between">
      <img v-if="message.user.avatar" src="{{ message.user.avatar }}" class="w-7 h-7 rounded-full"/>
      <img v-else :src="'https://ui-avatars.com/api/?rounded=false&bold=true&background=adadad&color=fff&uppercase=true&name='+ message.user.name" class="w-7 h-7 rounded-full" :class="{'lg:block':isChatopen }"/>
      <div class="flex flex-col ml-2">
      <span class="font-semibold" v-if="message.user" :class="{'text-red-600': message.user && message.user.is_admin == 1, 'text-white': message.user && message.user.is_admin == 0}" style="font-size:12px;">{{message.user.name}}</span>
      <span class="font-semibold" v-else style="font-size:12px;">{{ message.user ? message.user.name : 'Unknown' }}</span>
      <span class="text-gray-700 dark:text-white" style="font-size: 10px;">{{ format_date(message.created_at) }}</span>
      </div>
    </div> 
      <div class="flex space-x-1 ml-auto">
        <button class="text-gray-700 dark:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
          </svg>
        </button>
        <button class="text-gray-700 dark:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>
      </div>
    </div>
  <p class="chat_message mt-2 font-normal text-gray-700 dark:text-white" style="font-size:12px;">{{ message.message }}</p>
  </div>
</template>
  
<script>
import moment from 'moment'
export default {
    props:['message'],
    data() {
      return {
       isChatopen: false
  }
 },
 methods: { 
      format_date(value){
         if (value) {
           return moment(String(value)).format('hh:mm a')
          }
      },
  },      
}
</script>