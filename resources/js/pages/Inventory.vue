<template>
  <div class="bg-white dark:bg-c-d-blue p-2 rounded" style="height:90%;">
      <form @submit.prevent="searchitem" class="col-span-2">
          <div class="grid grid-cols-1 lg:grid-cols-3 space-x-2">
            <div class="col-span-2">
              <input v-model="searchTerm" @keyup="searchitem" class="border border-gray-300 dark:border-gray-700 bg-white dark:bg-c-black h-10 px-2 pr-2 rounded w-full text-sm focus:outline-none" placeholder="Search Items">
            </div>
            <div class="flex justify-between">
            <select v-model="sortOption" @change="setSortOption($event.target.value)" class="border border-gray-300 dark:border-gray-700 bg-white dark:bg-c-black text-sm rounded focus:outline-none block w-full h-10 p-2.5 dark:focus:outline-none">
              <option value="desc" selected>Highest Price</option>
              <option value="asc">Lowest Price</option>
            </select>
  
            </div>
          </div>
        </form>
    <div class="bg-gray-200 dark:bg-c-black overflow-y-scroll p-2" style="height:80%;">
  <div class="grid grid-cols-2 md:grid-cols-6 lg:grid-cols-9 gap-2 mb-2">
  
  <div v-for="i in 36" v-if="loading" class="animate-pulse bg-white dark:bg-c-d-blue text-gray-700 dark:text-white rounded p-2 text-center">
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
  
   <div v-else v-for="item in paginatedItems" :key="item.id" class="bg-white dark:bg-c-d-blue text-gray-700 dark:text-white rounded p-2 text-center">
     <img :src="item.image" class="w-16 h-auto mb-1 rounded mx-auto"/>
     <span class="text-sm font-semibold">{{item.name}}</span>
     <div class="flex items-center justify-center mt-auto">
       <button @click="withdraw(item.item_id, item.price)" class="bg-green-500 dark:bg-green-700 text-sm rounded px-2 mt-2 focus:outline-none">Withdraw</button>
     </div>
   </div>
  
  </div>
    </div>

      <div class="example-six mt-3 space-x-2">
      <vue-awesome-paginate
      :total-items="totalItems"
      :items-per-page="this.pageSize"
      :max-pages-shown="5"
      v-model="currentPage"
      :on-click="onClickHandler">

      <template #prev-button>
        <span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="white"
            width="12"
            height="12"
            viewBox="0 0 24 24"
          >
            <path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z" />
          </svg>
        </span>
      </template>

      <template #next-button>
        <span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="white"
            width="12"
            height="12"
            viewBox="0 0 24 24"
          >
            <path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z" />
          </svg>
        </span>
      </template>
      </vue-awesome-paginate>
      </div>
    </div>

    <div x-data="{showModal: false}">
    <div v-show="showModal" class="fixed inset-0 z-50 mx-auto lg:pl-20 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak v-show="showModal" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-200 transition-opacity bg-opacity-25" aria-hidden="true">
            </div>

            <div x-cloak v-show="showModal" x-transition
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full lg:w-3/6 px-2 p-1 my-mt-44 sm:mt-36 lg:mt-64 overflow-hidden text-left transition-all transform bg-white dark:bg-c-d-blue rounded">

          <div class="flex items-center justify-between space-x-4">
            <div class="flex items-center ml-2">
              <h1 class="flex font-medium text-gray-700 dark:text-white">Swap</h1>
            </div>
              <button @click="showModal = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
          </div>
        <div class="mt-2 bg-gray-200 dark:bg-c-black p-3 h-3/5 overflow-x-auto">
          <div v-if="swapitems" v-for="item in swapitems" class="bg-white dark:bg-c-d-blue px-2 py-2 mb-1 rounded">
            <div class="sm:flex sm:items-center sm:justify-between sm:space-x-5">
              <div class="flex items-center flex-1 min-w-0">
                <img :src="item.image" class="w-10 h-auto rounded"/>
                <div class="mt-0 mr-0 mb-0 ml-4 flex-1 min-w-0">
                  <p class="text-md font-bold text-gray-700 dark:text-white truncate">{{item.name}}</p>
                  <p class="text-gray-800 text-sm">{{item.price}}</p>
                </div>
              </div>
              <div class="mt-4 mr-0 mb-0 ml-0 pt-0 pr-0 pb-0 pl-14 flex items-center sm:space-x-6 sm:pl-0 sm:mt-0">
                <button @click="swapitem(item.item_id)" class="bg-gray-800 pt-2 pr-6 pb-2 pl-6 text-md font-medium text-gray-100 transition-all duration-200 hover:bg-gray-700 rounded">Swap</button>
              </div>
            </div>
          </div>

       </div>
      </div>
     </div>
    </div>
   </div>

</template>

<script>
import axios from 'axios';
import { ref, computed, watch } from 'vue';

export default {
  setup() {
    const currentPage = ref(1);
    const pageSize = 36;
    const items = ref([]);
    const swapitems = ref([]);
    const dt = ref([]);
    const totalPages = ref(10);
    const searchTerm = ref('');
    const sortOption = ref('');
    const steps = ref(['Step 1', 'Step 2', 'Step 3']);
    const currentStep = ref(1); 
    const showModal = ref(false);
    const old_id = ref(0);
    const loading = ref(true);

    axios.get('/api/get/inventory/data')
      .then(res => {
        items.value = res.data;
        totalPages.value = Math.ceil(items.value.length / pageSize);
        loading.value = false;
      })
      .catch(error => {
        console.log(error);
      });

    const filteredItems = computed(() => {
      let filtered = items.value.filter(item => item.name.toLowerCase().includes(searchTerm.value.toLowerCase()));

      if (sortOption.value === 'asc') {
        filtered = filtered.sort((a, b) => a.price - b.price);
      } else if (sortOption.value === 'desc') {
        filtered = filtered.sort((a, b) => b.price - a.price);
      }

      return filtered;
    });

    const paginatedItems = computed(() => {
      const startIndex = (currentPage.value - 1) * pageSize;
      const endIndex = startIndex + pageSize;
      return filteredItems.value.slice(startIndex, endIndex);
    });

    const onClickHandler = page => {
      currentPage.value = page;
    };

    watch(filteredItems, () => {
      totalPages.value = Math.ceil(filteredItems.value.length / pageSize);
    });

    const totalItems = computed(() => {
      return filteredItems.value.length;
    });

    const filteredTotalItems = computed(() => {
      return filteredItems.value.length;
    });

    const setSortOption = option => {
      sortOption.value = option;
    };

    const filteredByPrice = computed(() => {
      let filtered = filteredItems.value;

      if (sortOption.value === 'asc') {
        filtered = filtered.sort((a, b) => a.price - b.price);
      } else if (sortOption.value === 'desc') {
        filtered = filtered.sort((a, b) => b.price - a.price);
      }

      return filtered;
    });

    return {
      currentPage,
      totalPages,
      pageSize,
      items,
      swapitems,
      dt,
      onClickHandler,
      totalItems,
      searchTerm,
      paginatedItems,
      filteredTotalItems,
      setSortOption,
      filteredByPrice,
      sortOption,
      steps,
      currentStep,
      showModal,
      old_id,
      loading
    };
  },
  methods:{
    withdraw(id,price){
      axios.post('/api/get/withdraw',{
        item_id:id,
        price:price
      })
      .then(res => {
        if(res.data.success === true)
        {
         this.$toast.success(`Item has been successfully Purchased. Check your Steam Trade Offers.`,{
         position: "bottom-right",
         duration: 5000
        });
        }else{
         this.$toast.error(`${res.data.msg}.`,{
         position: "bottom-right",
         duration: 5000
        });
        this.swap(id,price);
        this.showModal = true;
       }
      })
    },
    swap(id,price){
      axios.post('/api/get/swap_item',{
        item_id:id,
        price:price
      })
      .then(res => {
        this.swapitems = res.data.items;
        this.old_id = id;
      })
      .catch(error => {
        console.log(error);
      })
    },
    swapitem(id){
     axios.post('/api/get/swap_buy',{
      item_id:id,
      old_id:this.old_id
     })
     .then(res => {
      if(res.data.ok === 'ok')
      {
        this.$toast.success(`Item has been successfully Swapped. Check your Steam Trade Offers.`,{
        position: "bottom-right",
        duration: 5000
       });
      }else{
        this.$toast.error(`Item not available at this time.`,{
        position: "bottom-right",
        duration: 5000
       });
      }
     })
     .catch(error => {
      console.log(error);
     })
    }
  }
};
</script>