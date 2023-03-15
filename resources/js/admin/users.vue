<template>
<div>
 <h2 class="text-2xl font-semibold leading-tight">Users</h2>
</div>
<form class="my-2 flex sm:flex-row flex-col" @submit.prevent="searchuser">
    <div class="flex flex-row mb-1 sm:mb-0">
        <div class="relative">
            <select class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option>5</option>
                <option>10</option>
                <option>20</option>
            </select>
        </div>
        <div class="relative">
            <select v-model="sortOption" @change="setSortOption($event.target.value)" class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                <option value="desc">Newest</option>
                <option value="asc">Oldest</option>
            </select>
        </div>
    </div>
    <div class="block relative">
        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                <path
                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                </path>
            </svg>
        </span>
        <input v-model="searchTerm" @keyup="searchuser" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" placeholder="Search User"/>
    </div>
  </form>
<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounde overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        User
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Email
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Points
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Hold Points
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Joined At
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in paginatedItems">
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10">
                            <img v-if="user.avatar" src="user.avatar" class="w-full h-full rounded-full"/>
                            <img v-else="!user.avatar" :src="'https://ui-avatars.com/api/?bold=true&background=adadad&color=fff&uppercase=true&name=' + user.name" class="w-full h-full rounded-full"/>
                            </div>
                            <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{user.name}}
                            </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{user.email}}</p>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <p class="flex items-center text-gray-900 whitespace-no-wrap">
                            <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-5 h-5 mr-1">
                            {{Math.trunc(user.points)}}
                        </p>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <p class="flex items-center text-gray-900 whitespace-no-wrap">
                            <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-5 h-5 mr-1">
                            {{Math.trunc(user.hold_points)}}
                        </p>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{format_date(user.created_at)}}</p>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                        <button class="relative inline-block bg-blue-600 text-white px-3 py-1 rounded font-normal leading-tight">
                          <span>View</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="px-5 pb-2 bg-white border-t flex flex-col xs:flex-row xs:justify-between          ">
            <div class="example-six mt-3 space-x-2">
            <vue-awesome-paginate
            :total-items="totalItems"
            :items-per-page="this.pageSize"
            :max-pages-shown="5"
            v-model="currentPage"
            :on-click="onClickHandler">

            <template #prev-button>
                <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" width="12" height="12" viewBox="0 0 24 24">
                <path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z" />
                </svg>
                </span>
            </template>

            <template #next-button>
                <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" width="12" height="12" viewBox="0 0 24 24">
                <path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z" />
                </svg>
                </span>
            </template>
            </vue-awesome-paginate>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import moment from 'moment'
import { ref, computed, watch } from 'vue';

export default {
  setup() {
    const currentPage = ref(1);
    const pageSize = 10;
    const users = ref([]);
    const totalPages = ref(10);
    const searchTerm = ref('');
    const sortOption = ref('');
    const loading = ref('true');

    axios.get('/api/admin/data')
      .then(res => {
        users.value = res.data.users;
        totalPages.value = Math.ceil(users.value.length / pageSize);
        loading.value = false;
      })
      .catch(error => {
        console.log(error);
      });

    const filteredItems = computed(() => {
      let filtered = users.value.filter(item => item.name.toLowerCase().includes(searchTerm.value.toLowerCase()));

      if (sortOption.value === 'asc') {
        filtered = filtered.sort((a, b) => a.created_at - b.reated_at);
      } else if (sortOption.value === 'desc') {
        filtered = filtered.sort((a, b) => b.reated_at - a.reated_at);
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
        filtered = filtered.sort((a, b) => a.created_at - b.created_at);
      } else if (sortOption.value === 'desc') {
        filtered = filtered.sort((a, b) => b.created_at - a.created_at);
      }

      return filtered;
    });

    return {
      currentPage,
      totalPages,
      pageSize,
      users,
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
    format_date(value){
     if (value) {
      return moment(String(value)).format('MMM DD, YYYY HH:mm A')
     }
    },
  }
};
</script>