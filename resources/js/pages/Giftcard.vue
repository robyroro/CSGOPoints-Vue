<template>

<input type="text" placeholder="Search items" v-model="searchTerm">

<select v-model="sortOption" @change="setSortOption($event.target.value)">
  <option value="">-</option>
  <option value="asc">Low to high</option>
  <option value="desc">High to low</option>
</select>

 <div class="flex flex-wrap p-2 bg-white dark:bg-c-d-blue gap-2 rounded">

  <div class="flex flex-col items-center w-full sm:w-auto bg-gray-200 dark:bg-c-d-blue text-gray-700 dark:text-white text-sm border border-gray-300 dark:border-gray-700 p-2 rounded">
   <img src="https://res.cloudinary.com/emil-dev/image/upload/v1676104215/39BLVcx_kvs2ec.jpg" class="w-32"/>
   <span class="px-1 my-3">$10 STEAM Wallet Card</span>
    <div class="flex items-center justify-between mt-auto">
     <button class="px-2 py-1 bg-white dark:bg-c-black rounded">Order</button>
     <span class="flex items-center">
        <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-4 h-4 ml-2 mr-1">
         <span class="text-xs">12121</span>
     </span>
    </div>
  </div>

  <div class="flex flex-col items-center w-full sm:w-auto bg-gray-200 dark:bg-c-d-blue text-gray-700 dark:text-white text-sm border border-gray-300 dark:border-gray-700 p-2 rounded">
   <img src="https://res.cloudinary.com/emil-dev/image/upload/v1676104215/RwALVw6_lppjk2.jpg" class="w-32"/>
   <span class="px-1 my-3">$5 XBOX Gift Card</span>
    <div class="flex items-center justify-between mt-auto">
     <button class="px-2 py-1 bg-white dark:bg-c-black rounded">Order</button>
     <span class="flex items-center">
        <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-4 h-4 ml-2 mr-1">
         <span class="text-xs">12121</span>
     </span>
    </div>
  </div>


  <div v-for="item in paginatedItems" :key="item.id" class="flex flex-col items-center w-full sm:w-auto bg-gray-200 dark:bg-c-d-blue text-gray-700 dark:text-white text-sm border border-gray-300 dark:border-gray-700 p-2 rounded">
   <img :src="item.image" class="w-32"/>
   <span class="px-1 my-3">{{ item.name }}</span>
    <div class="flex items-center justify-between mt-auto">
     <button class="px-2 py-1 bg-white dark:bg-c-black rounded">Order</button>
     <span class="flex items-center">
        <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-4 h-4 ml-2 mr-1">
         <span class="text-xs">{{item.price}}</span>
     </span>
    </div>
  </div>
 </div>

 <div class="example-six">
    <vue-awesome-paginate
    :total-items="totalItems"
    :items-per-page="this.pageSize"
    :max-pages-shown="10"
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

  
</template>



<script>
import axios from 'axios';
import { ref, computed, watch } from 'vue';

export default {
  setup() {
    const currentPage = ref(1);
    const pageSize = 20;
    const items = ref([]);
    const totalPages = ref(10);
    const searchTerm = ref('');
    const sortOption = ref('');

    axios.get('/api/data/items')
      .then(res => {
        items.value = res.data;
        totalPages.value = Math.ceil(items.value.length / pageSize);
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
      sortOption
    };
  },
};
</script>

<style>
.example-six .pagination-container {
  column-gap: 10px;
  display: flex;
  align-items: center;
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

