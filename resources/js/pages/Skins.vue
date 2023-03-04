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
     <div class="flex items-center justify-between mt-auto">
       <span class="text-sm mr-3">{{item.price}}</span>
       <button @click="buyitem(item.item_id, item.name, item.price)" class="bg-green-500 dark:bg-green-700 text-sm rounded px-2 mt-2">Order</button>
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

  </template>

<script>
import axios from 'axios';
import { ref, computed, watch } from 'vue';

export default {
  setup() {
    const currentPage = ref(1);
    const pageSize = 36;
    const items = ref([]);
    const totalPages = ref(10);
    const searchTerm = ref('');
    const sortOption = ref('');
    const loading = ref('true');

    axios.get('/api/data/items')
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
      onClickHandler,
      totalItems,
      searchTerm,
      paginatedItems,
      filteredTotalItems,
      setSortOption,
      filteredByPrice,
      sortOption,
      loading
    };
  },
  methods:{
    buyitem(item_id,item_name,item_price) {
      this.$axios.post('/api/data/order/item', {
        item_id:item_id,
        price:item_price
      })
      .then(response => {
        if(response.data.success === true)
        {
          this.$toast.success(`Item has been successfully Purchased. Check your Steam Trade Offers.`,{
          position: "bottom-right",
          duration: false
        });
        }else{
          this.$toast.error(`${response.data.msg}.`,{
          position: "bottom-right",
          duration: false
        });
        }
      })
      .catch(error => {
        console.log(error);
      })
    },
  }
};
</script>

<style>
.example-six .pagination-container {
  column-gap: 10px;
  display: flex;
  align-items: center;
  overflow-y:auto;
}
.example-six .paginate-buttons {
  height: 35px;
  width: 35px;
  cursor: pointer;
  border-radius: 4px;
  background-color: transparent;
  border: none;
  color: black;
  outline: none;
}

.example-six .back-button,
.example-six .next-button {
  background-color: black;
  color: white;
  border-radius: 8px;
  height: 45px;
  width: 45px;
  padding-left: 15px;
  outline: none;
}
.example-six .active-page {
  background-color: #e5e5e5;
}
.example-six .active-page:hover {
  background-color: #e5e5e5;
}

.example-six .back-button svg {
  transform: rotate(180deg) translateY(-2px);
  
}
.example-six .next-button svg {
  transform: translateY(2px);
}

.example-six .back-button:hover,
.example-six .next-button:hover {
  background-color: rgb(45, 45, 45);
}

.example-six .back-button:active,
.example-six .next-button:active {
  background-color: rgb(85, 85, 85);
}
</style>