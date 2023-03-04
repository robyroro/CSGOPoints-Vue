<template>

  <div class="bg-white dark:bg-c-d-blue p-2 rounded" style="height:90%;">
      <form @submit.prevent="searchitem" class="col-span-2">
          <div class="grid grid-cols-1 lg:grid-cols-3 space-x-2">
            <div class="col-span-2">
              <input class="border border-gray-300 dark:border-gray-700 bg-white dark:bg-c-black h-10 px-2 pr-2 rounded w-full text-sm focus:outline-none" v-model="searchTerm" @keyup="searchitem" placeholder="Search Items">
            </div>
            <div class="flex justify-between">
        
            <select v-model="sortDirection" @change="sortOffers" class="border border-gray-300 dark:border-gray-700 bg-white dark:bg-c-black text-sm rounded focus:outline-none block w-full h-10 p-2.5 dark:focus:outline-none">
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

    <div class="pagination mt-3 space-x-2">
        <button class="bg-white dark:bg-c-black rounded px-2 py-1 focus:outline-none" :disabled="currentPage === 1" @click="prevPage">Prev</button>
        <button v-for="page in totalPages" :key="page"
                :class="{ 'bg-blue-500 text-white rounded px-2 focus:outline-none' : page === currentPage }"
                @click="setPage(page)">{{ page }}</button>
        <button class="bg-white dark:bg-c-black rounded px-2 py-1 focus:outline-none" :disabled="currentPage === totalPages" @click="nextPage">Next</button>
    </div>

  </div>

  </template>
  
  
<script>
export default {
  data() {
    return {
      items: [],
      searchTerm: '',
      sortDirection: 'desc',
      loading: true,
      currentPage: 1,
      pageSize: 108 // number of items per page
    }
  },
  created() {
    this.loadItems();
  },
  methods: {
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
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.loadItems();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.loadItems();
      }
    },
    setPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
        this.loadItems();
      }
    },
    loadItems() {
      this.loading = true;
      this.$axios.get('/api/data/items', {
        params: {
          page: this.currentPage,
          size: this.pageSize
        }
      })
      .then(response => {
        this.items = response.data;
        this.loading = false;
      })
      .catch(error => {
        console.log(error);
      })
    }
  },
  computed: {
    filteredItems() {
      let items = this.items;
      if (this.searchTerm) {
        items = items.filter(item => {
          return item.name.toLowerCase().includes(this.searchTerm.toLowerCase())
        });
      }
      if (this.sortDirection === 'asc') {
        items.sort((a, b) => a.price - b.price);
      } else {
        items.sort((a, b) => b.price - a.price);
      }
      return items;
    },
    paginatedItems() {
      const start = (this.currentPage - 1) * this.pageSize;
      const end = start + this.pageSize;
      return this.filteredItems.slice(start, end);
    },
    totalPages() {
      return Math.ceil(this.filteredItems.length / this.pageSize);
    }
  }
}
  </script>
