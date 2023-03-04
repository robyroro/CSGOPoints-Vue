<template>
<div class="w-full lg:w-11/12 mx-auto">
 <div class="msg bg-red-200 dark:bg-red-600 text-gray-600 dark:text-white text-lg font-semibold text-center px-2 py-1 mb-4 rounded">
   <span>Your-Surveys is crediting in real time again</span>
 </div>

<div class="flex items-center text-md mb-2 text-gray-500 dark:text-white text-gray-700 dark:text-white">
   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
   </svg>
  <span>Featured Offers</span>
</div>
 
 <div class="grid grid-cols-2 md:grid-cols-6 lg:grid-cols-8 gap-2 mb-5">

  <div v-for="i in 5" v-if="loading" class="animate-pulse bg-white dark:bg-c-d-blue text-gray-700 dark:text-white rounded p-2 text-center">
   <div class="animate-puls flex space-x-4">
    <div class="flex-1 space-y-4 py-1">
      <div class="w-12 h-12 bg-gray-200 dark:bg-c-black rounded mx-auto"></div>
      <div class="space-y-2">
        <div class="h-2 bg-gray-200 dark:bg-c-black rounded"></div>
        <div class="h-5 bg-gray-200 dark:bg-c-black rounded"></div>
      </div>
      <div class="flex items-center justify-between">
        <div class="h-4 w-8 bg-gray-200 dark:bg-c-black rounded mt-4"></div>
        <div class="h-4 w-8 bg-gray-200 dark:bg-c-black rounded mt-4"></div>
      </div>
    </div>
   </div>
  </div>

   <div v-else class="bg-white dark:bg-c-d-blue text-gray-700 dark:text-white rounded p-2 text-center">
     <img src="https://res.cloudinary.com/emil-dev/image/upload/v1671100685/QUR9vNz_g2ylum.png" class="w-12 h-auto mb-1 rounded mx-auto"/>
     <span class="text-sm font-semibold">Poker Star</span>
     <p class="text-xs my-1">Install and Open the App to receive the Reward.</p>
     <div class="flex items-center justify-between mt-2">
       <span class="text-sm mr-3">$10.54</span>
       <button class="bg-green-500 dark:bg-green-700 text-sm rounded px-2">Start</button>
     </div>
   </div>

 </div>

 <div class="flex flex-col text-md mb-2 text-gray-500 dark:text-gray-400">
  <span class="flex items-center font-semibold text-gray-700 dark:text-white">
   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
   </svg>
    Offerwalls
  </span>
  Earn points by completing offers, browse the offerwalls, find an offer you like, read the description and start the offer.
 </div>

 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-2">
  
  <div v-for="i in 5" v-if="loading" class="animate-pulse bg-white dark:bg-c-d-blue rounded px-2 w-full mx-auto">
   <div class="animate-puls flex space-x-4">
    <div class="flex-1 space-y-4 py-1">
      <div class="h-2 bg-gray-200 dark:bg-c-black rounded"></div>
      <div class="space-y-2">
        <div class="grid grid-cols-3 gap-4">
          <div class="h-2 bg-gray-200 dark:bg-c-black rounded col-span-2"></div>
          <div class="h-2 bg-gray-200 dark:bg-c-black rounded col-span-1"></div>
        </div>
        <div class="h-2 bg-gray-200 dark:bg-c-black rounded"></div>
      </div>
    </div>
   </div>
  </div>

  <button v-for="wall in walls" v-else  @click="openOfferwall(wall.id)" class="relative py-7 flex flex-col items-center justify-center bg-gray-200 dark:bg-c-black border border-gray-300 dark:border-gray-700 overflow-hidden rounded focus:outline-none" :disabled="wall.unlock > overall" :style="{'background': wall.color}">
    <div class="absolute inset-0 w-full flex items-center justify-center" :class="{'filter blur-sm': wall.unlock > overall}">
      <div v-if="wall.boost > 0" class="flex items-center absolute top-0 right-0 px-1 bg-red-600 text-gray-900 dark:text-white font-semibold rounded-tr rounded-bl border-b border-l border-gray-300 dark:border-gray-700" style="font-size:12px;">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
        </svg>
        +{{ wall.boost }}%
      </div>
      <img :src="wall.wall_image" class="w-28 h-auto"/>
    </div>
    <div v-if="wall.unlock > parseFloat(overall)" class="relative mt-auto mb- text-center text-white">
      <p class="flex" style="font-size:12px;">Earn {{wall.unlock - points}} <img :src="'https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png'" class="w-4 h-4 mx-1"> to Unlock</p>
    </div>
  </button>

 </div>
</div>

 <div x-data="{showModal: false}">
    <div v-show="showModal" class="fixed inset-0 z-50 mx-auto lg:pl-20 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="close()" v-show="showModal" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-opacity-25" aria-hidden="true"
            ></div>

            <div x-cloak v-show="showModal" x-transition
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full lg:w-4/6 px-2 p-1 my-mt-44 md:mt-36 lg:mt-32 overflow-hidden text-left transition-all transform bg-white dark:bg-c-d-blue rounded">

                <div class="flex items-center justify-between space-x-4">
                   <div class="flex items-center ml-2">
                    <h1 class="flex font-medium text-gray-700 dark:text-white">{{ name }}</h1>
                    <a :href="url.replace('[USER]',user_id)" target="_blank">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                     </svg>
                    </a>
                   </div>
                    <button @click="close()" class="text-gray-600 focus:outline-none hover:text-gray-700">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                </div>
                <div class="mt-2">
                   <iframe :src="url.replace('[USER]',user_id)" frameborder="0" width="100%" height="600px"></iframe>
                </div>
            </div>
        </div>
    </div>
   </div>

</template>


<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 300ms ease-out;
}
</style>

<script>
import { throwStatement } from '@babel/types';
import { ref } from 'vue';

export default {
   setup() {
    let isOpen = ref(false);
    return { isOpen };
  },
   name: "Earn",
   data() {
      return {
       walls: [],
       points:null,
       user_id:null,
       showModal: false,
       modelOpen:false,
       show:false,
       url: '',
       name: '',
       overall:null,
       Open:false,
       loading:true
 }
},
   created() {
      
   },
   computed: {
    isModalVisible() {
      return this.Open;
    }
  },
  mounted() {
    this.getwalls();
  },
   methods:{
    
    async getwalls() {
      try {
        const response = await axios.get('/api/data/walls');
        this.walls = response.data;
        this.loading = false;
      } catch (error) {
        console.log(error);
      }
    },
    openOfferwall(id){
     this.url = this.walls.find(offerwall => offerwall.id === id).iframe
     this.name = this.walls.find(offerwall => offerwall.id === id).name
     this.showModal = true
    },
    close(){
      this.url = '',
      this.name = '',
      this.showModal = false
    },
    onToggle() {
      this.Open = !this.Open;
    }
   },      
   beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/login";
        }
        next();
    }
}
</script>