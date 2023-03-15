<template>
 <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2 mb-3">
    <div class="flex items-center justify-between text-gray-800 bg-gray-100 shadow p-2 rounded">
     <div class="flex items-center text-sm font-normal">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
       <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
      </svg>
      Users
     </div>
     <span>{{usercount.length}}</span>
    </div>

    <div class="flex items-center justify-between text-gray-800 bg-gray-100 shadow p-2 rounded">
     <div class="flex items-center text-sm font-normal">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
       <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
      </svg>
      Withdraw Requests
     </div>
     <span>{{wd.length}}</span>
    </div>

    <div class="flex items-center justify-between text-gray-800 bg-gray-100 shadow p-2 rounded">
     <div class="flex items-center text-sm font-normal">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
       <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
      </svg>
      Items
     </div>
     <span>2121</span>
    </div>

    <div class="flex items-center justify-between text-gray-800 bg-gray-100 shadow p-2 rounded">
     <div class="flex items-center text-sm font-normal">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
       <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
      </svg>
      Users
     </div>
     <span>123</span>
    </div>


 </div>
<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-2 mt-5">
<div class="col-span-2">
<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounded overflow-hidden">
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
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-9 h-9">
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
                    <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{user.email}}</p>
                    </td>
                    <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                        <p class="flex items-center text-gray-900 whitespace-no-wrap">
                            <img src="https://res.cloudinary.com/emil-dev/image/upload/v1668866108/1863974_vdvmor.png" class="w-5 h-5 mr-1">
                            {{Math.trunc(user.points)}}
                        </p>
                    </td>
                    <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                        <span
                            class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative">Activo</span>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
<div>
<div class="bg-gray-100 shadow rounded">
 <div class="text-gray-600 text-sm px-1 py-2 border-b border-gray-300">
    Recent Activity
 </div>
  <div v-for="log in logs" class="bg-white px-2 py-1 border-t border-gray-300">
    <p class="flex flex-col">
     <span class="font-semibold" style="font-size:13px;">{{log.user.name}}</span>
     <span class="font-normal" style="font-size:12px;">Completed {{log.cname}} worth {{log.points}} from {{log.wall}}</span>
    </p>
  </div>
</div>
</div>
</div>
</template>

<script>
import axios from 'axios';
import moment from 'moment'
export default {
  data() {
    return {
    users: [],
    logs: [],
    usercount: 0,
    wd:0,
    loading: true
    }
},
  created(){
    axios.get('/api/admin/data')
      .then(res => {
        this.users = res.data.user;
        this.logs = res.data.logs;
        this.usercount = res.data.user;
        this.wd = res.data.wd;
        this.loading = false;
      })
      .catch(error => {
        console.log(error);
      });
  },
  methods:{
    format_date(value){
     if (value) {
      return moment(String(value)).format('YYYY-MM-DD')
     }
    },
  },
};
</script>