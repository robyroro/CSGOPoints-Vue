<template>
     <div class="flex items-center justify-between p-2">
       <span class="flex text-gray-700 dark:text-gray-300 mr-9">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
         <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
        </svg>
        1212
       </span>
       <select class="relative z-10 block rounded bg-gray-200 p-1 dark:bg-c-d-blue border-gray-300 dark:border-gray-700 focus:outline-none" v-model="selected" @change="$emit('roomChanged',selected)">
        <option v-for="(room,index) in chatRooms" :key="index" :value="room" class="block px-4 py-2 text-sm capitalize text-gray-700 dark:text-white hover:bg-blue-500 hover:text-white">{{ room.name }}</option>
       </select>
     </div>
</template>

<script>
export default {
  props:['currentRoom','chatRooms'],
  data:function(){
			return{
				selected:'',
			}
		},
		created(){
			this.selected = this.currentRoom;
		}
	}
</script>