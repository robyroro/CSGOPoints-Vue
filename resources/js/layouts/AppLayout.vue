<template>
 
 <div x-data="{isChatopen: false, isSidebarOpen: false , open:false }">
  <div class="flex h-screen overflow-hidden bg-white dark:bg-c-d-blue">
    <!-- Loading screen -->
    <!--<div
      x-ref="loading"
      class="fixed inset-0 z-50 flex items-center justify-center text-white bg-black bg-opacity-50"
      style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
    >
      Loading.....
    </div> -->

    <!-- Sidebar backdrop -->
    <div
      x-show.in.out.opacity="isSidebarOpen"
      class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
      style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
    ></div>

    <!-- Sidebar -->
    <aside
      x-transition:enter="transition transform duration-300"
      x-transition:enter-start="-translate-x-full opacity-30  ease-in"
      x-transition:enter-end="translate-x-0 opacity-100 ease-out"
      x-transition:leave="transition transform duration-300"
      x-transition:leave-start="translate-x-0 opacity-100 ease-out"
      x-transition:leave-end="-translate-x-full opacity-0 ease-in"
      class="fixed inset-y-0 z-20 flex flex-col flex-shrink-0 w-64 bg-white dark:bg-c-d-blue max-h-screen overflow-hidden transition-all transform lg:z-auto lg:static lg:shadow-none"
      :class="{'-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}"
    >
      <!-- sidebar header -->
      <div class="flex items-center justify-between flex-shrink-0 p-2" :class="{'lg:justify-center': !isSidebarOpen}">
        <span class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
          K<span :class="{'lg:hidden': !isSidebarOpen}">-WD</span>
        </span>
        <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
          <svg
            class="w-6 h-6 text-gray-700 dark:text-gray-300"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- Sidebar links -->
      <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
        <ul class="pt-2 space-y-2 overflow-hidden" v-if="isLoggedIn">
          <li>
            <router-link v-if="user.is_admin === 1" to="/admin/dashboard" target="_blank" class="flex items-center p-2 space-x-2 text-sm mx-2 dark:text-white bg-white dark:bg-red-400 rounded" :class="{'justify-center': !isSidebarOpen}" active-class="border-r-2 ml-2 border-gray-600 dark:bg-gray-700 bg-gray-200 dark:bg-active">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4 text-red-500 dark:text-red-700">
                  <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Admin</span>
            </router-link>
          </li>
          <li>
            <router-link to="/dashboard" class="flex items-center p-2 space-x-2 text-sm" :class="{'justify-center': !isSidebarOpen}" active-class="mx-2 dark:bg-act bg-green-200 text-green-500 dark:text-act rounded">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
            </router-link>
          </li>
          <li>
            <router-link to="/dashboard" class="flex items-center p-2 space-x-2 text-sm" :class="{'justify-center': !isSidebarOpen}" active-class="border-r-2 ml-2 border-green-600 dark:border-green-700 dark:bg-act bg-green-200 text-green-500 dark:text-act rounded-l">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
            </router-link>
          </li>

          <li>
            <router-link to="/earn" class="flex items-center p-2 space-x-2 text-sm" :class="{'justify-center': !isSidebarOpen}" active-class="border-r-2 ml-2 border-gray-600 dark:bg-gray-700 bg-gray-200 dark:bg-active">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Earn</span>
            </router-link>
          </li>
          <li>
            <router-link to="/giftcards" class="flex items-center p-2 space-x-2 text-sm" :class="{'justify-center': !isSidebarOpen}" active-class="border-r-2 ml-2 border-gray-600 dark:bg-gray-700 bg-gray-200 dark:bg-active">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Gift Cards</span>
            </router-link>
          </li>
          <li>
            <router-link to="/skins" class="flex items-center p-2 space-x-2 text-sm" :class="{'justify-center': !isSidebarOpen}" active-class="border-r-2 ml-2 border-gray-600 dark:bg-gray-700 bg-gray-200 dark:bg-active">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Skins</span>
            </router-link>
          </li>
          <li>
            <router-link to="/inventory" class="flex items-center p-2 space-x-2 text-sm" :class="{'justify-center': !isSidebarOpen}" active-class="border-r-2 ml-2 border-gray-600 dark:bg-gray-700 bg-gray-200 dark:bg-active">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Inventory</span>
            </router-link>
          </li>
          <!-- Sidebar Links... -->
        </ul>
        <ul class="pt-2 space-y-2 overflow-hidden" v-else>
          <li>
            <router-link to="/login" class="flex items-center p-2 space-x-2 text-sm" :class="{'justify-center': !isSidebarOpen}" active-class="border-r-2 ml-2 border-gray-600 dark:bg-gray-700 bg-gray-200 dark:bg-active">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-gray-700 dark:text-white">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Login</span>
            </router-link>
          </li>
          <li>
            <router-link to="/register" class="flex items-center p-2 space-x-2 text-sm" :class="{'justify-center': !isSidebarOpen}" active-class="border-r-2 ml-2 border-gray-600 dark:border-gray-700 bg-gray-200 dark:bg-active">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-gray-700 dark:text-white">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
              </span>
              <span :class="{ 'lg:hidden': !isSidebarOpen }">Register</span>
            </router-link>
          </li>
        </ul>
      </nav>
      <!-- Sidebar footer -->
      <div class="flex-shrink-0 p-2 max-h-14">
        <button
          class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 border rounded-md focus:outline-none focus:ring"
        >
          <span>
            <svg
              class="w-6 h-6"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
              />
            </svg>
          </span>
          <a :class="{'lg:hidden': !isSidebarOpen}" v-on:click="logout"> Logout </a>
        </button>
      </div>
    </aside>

    <div class="flex flex-col flex-1 h-full overflow-hidden">
      <!-- Navbar -->
      <header class="flex-shrink-0">
        <div class="flex items-center justify-between h-14 pr-1">
          <!-- Navbar left -->
          <div class="flex items-center space-x-3 mr-1">
            <!-- Toggle sidebar button -->
            <button @click="toggleSidbarMenu()" class="px-2 rounded focus:outline-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 dark:text-gray-300" :class="{'transform transition-transform -rotate-180': isSidebarOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
              </svg>
            </button>
          </div>


  <div class="w-screen inset-y-0 z-10 flex overflow-hidden transition-all transform  rounded lg:z-auto lg:static lg:shadow-none" :class="{'-translate-y-full lg:translate-x-0 lg:w-0': !open}">
  <div class="hidden bg-white dark:bg-c-d-blue px-2 mr-1 text-sm text-gray-700 dark:text-white md:flex items-center">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  {{ sumpoints }}
  </div>

  <div class="flex flex-1 items-center space-x-1 py-1 overflow-x-hidden mr-3">
    <recentbar :logs="logs" v-on:roomChanged="setRoom($event)"/>
  </div>

  <div class="flex items-center ml-2 bg-white dark:bg-c-d-blue w-max px-2 text-sm text-gray-700 darK:text-white ml-auto md:flex items-center">
    <select class="relative z-10 block rounded bg-gray-200 p-1 dark:bg-c-d-blue border-gray-300 dark:border-gray-700 focus:outline-none">
     <option v-for="room in logsRooms" :key="room.id" class="block px-4 py-2 text-sm capitalize text-gray-700 dark:text-white hover:bg-blue-500 hover:text-white">
      {{ room.name }}
     </option>
    </select>
  </div>
</div>  


          <!-- Navbar right -->
          <div class="relative flex items-center ml-2">
            <div class="items-center hidden space-x-3 md:flex">
              <!-- Notification Button -->
              <div class="relative" x-data="{ isOpen: false }">
                <!-- red dot -->
                <div class="absolute right-0 p-1 bg-red-400 rounded-full animate-ping"></div>
                <div class="absolute right-0 p-1 bg-red-400 border rounded-full"></div>
                <button @click="isOpen = !isOpen" class="bg-gray-200 dark:bg-c-black rounded-full focus:outline-none p-2 mr-2">
                  <svg class="w-6 h-6 text-gray-700 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                  </svg>
                </button>
                <!-- Dropdown card -->
                <div @click.away="isOpen = false" v-show.transition.opacity="isOpen" class="absolute right-0 w-48 max-w-md mt-3 transform bg-gray-200 dark:bg-c-d-blue rounded -translate-x-3/4 min-w-max">
                  <div class="p-1 font-medium border-b">
                    <span class="text-gray-700 dark:text-white">Notification</span>
                  </div>
                  <ul class="flex flex-col p-2 my-2 space-y-1">
                    <li>
                      <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Link</a>
                    </li>
                    <li>
                      <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Another Link</a>
                    </li>
                  </ul>
                  <div class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                    <a href="#">See All</a>
                  </div>
                </div>
              </div>

            </div>

            <!-- avatar button -->
            <div class="relative flex items-center" x-data="{ isOpen: false, profile: false}">

              <div class="inline-flex mr-2 bg-gray-200 dark:bg-c-black text-gray-700 dark:text-white p-2 rounded" x-data="{toggleDark:false}">
                <label for="toggle" class="inline-flex relative items-center cursor-pointer">
                <input type="checkbox" id="toggle" class="sr-only peer" v-model="isDark"  x-on:click="toggleDark">
                <svg xmlns="http://www.w3.org/2000/svg" v-if="isDark" class="h-5 w-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" v-else class="h-5 w-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                </label>
              </div>

              <div class="bg-gray-200 dark:bg-c-black text-gray-700 dark:text-white px-2 py-1 mr-2 rounded">
                {{ points }}
              </div>

              <button @click="profile = !profile" class="flex items-center w-9 h-9 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none">
                <img class="w-9 h-9" src="https://avatars0.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"/>
              </button>
              <!-- green dot -->
              <div class="absolute right-0 p-1 bg-green-400 rounded-full -bottom-0 animate-ping"></div>
              <div class="absolute right-0 p-1 bg-green-400 border border-white rounded-full -bottom-0"></div>

              <!-- Dropdown card -->
              <div @click.away="profile = false" v-show.transition.opacity="profile" class="absolute top-10 right-1 w-48 max-w-md mt-3 transform bg-gray-200 dark:bg-c-d-blue rounded -translate-x-3/4 min-w-max">
                <div class="flex flex-col p-1 space-y-1 font-medium border-b">
                  <span class="text-gray-700 dark:text-white ml-1">{{ name }}</span>
                  <span class="text-sm text-gray-600 dark:text-gray-400 ml-1">{{ email }}</span>
                </div>
                <ul class="flex flex-col p-2 my-2 space-y-1">
                  <li>
                    <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Link</a>
                  </li>
                  <li>
                    <a href="#" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Another Link</a>
                  </li>
                </ul>
                <div class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                  <a href="#">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>


<!--Recent bar here-->


      <!-- Main content -->
      <main class="flex-1 max-h-full px-2 pt-6 overflow-hidden overflow-y-auto bg-gray-200 dark:bg-c-black">
        <router-view/>
      </main>
      <!-- Main footer -->
      <footer class="flex items-center justify-between flex-shrink-0 p-4 max-h-14">
        <div>K-WD &copy; 2020</div>
        <div class="text-sm">
          Owned by CashoutPoint
          <a
            class="text-blue-400 underline"
            href="https://github.com/Kamona-WD"
            target="_blank"
            rel="noopener noreferrer"
            ></a
          >
        </div>
        <div>
        
        </div>
      </footer>
    </div>

    <!-- Setting panel button -->
    <div class="relative">
    <button @click="openchat()" class="absolute px-2 py-1 top-24 z-30 text-sm text-gray-700 dark:text-white bg-white dark:bg-c-black border-y border-l border-gray-300 dark:border-gray-700 rounded-l focus:outline-none" style="left:-37px">
     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform duration-300 hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
      <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
      <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
     </svg>
    </button>

    <aside
      x-transition:enter="transition transform duration-300"
      x-transition:enter-start="-translate-x-full opacity-30  ease-in"
      x-transition:enter-end="translate-x-0 opacity-100 ease-out"
      x-transition:leave="transition transform duration-300"
      x-transition:leave-start="translate-x-0 opacity-100 ease-out"
      x-transition:leave-end="-translate-x-full opacity-0 ease-in"
      class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-72 max-h-screen overflow-hidden transition-all transform bg-white dark:bg-c-d-blue dark:border-red-600 lg:z-auto lg:static lg:shadow-none"
      :class="{'-translate-x-full lg:translate-x-0 lg:w-0': !isChatopen}"
    >
      <!-- sidebar header -->
      <div class="flex items-center justify-between flex-shrink-0" :class="{'lg:justify-center': !isChatopen}">
        <container/>
      </div>
    </aside>
    </div>
  </div>
 </div>
</template>
    
<script>
import container from '../chat/container';
import recentbar from '../elements/RecentBar';
import { useDark, useToggle } from '@vueuse/core';
import gsap from 'gsap';
import Echo from 'laravel-echo';

export default {
  components: {
    container,
    recentbar
  },
  setup() {
  const isDark = useDark()
  const toggleDark = useToggle(false)  
  return { isDark, toggleDark }
},
data() {
    return {
      logs: [],
      logsRooms: [],
      currentRoom: [],
      user: [],
      isChatopen: false,
      isLoggedIn: false,
      sidebarOpen: false,
      isSidebarOpen: false,
      open: true,
      isOpen: false,
      profile: false,
      name: null,
      email: null,
      avatar: null,
      sumpoints: null,
      points: null,
      hpoints: null,
      tweened: 0,
      alltweened: 0,
      htweened: 0,
    }
},
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
            this.name = window.Laravel.user.name
            this.email = window.Laravel.user.email
            this.avatar = window.Laravel.user.avatar
            this.points = window.Laravel.user.points
            this.hpoints = window.Laravel.user.hold_points
            this.user = window.Laravel.user
            this.sumpoints = window.Laravel.all
        }
        this.getRooms();
    },
    watch: {
    currentRoom(val,oldVal){
          if(oldVal.id){
              this.disconnect(oldVal);
          }
          this.connect();
    }
  },
    methods: {
      updatePoints(points) {
    gsap.to(this, {
      duration: 3,
      tweened: points,
      onUpdate: () => {
        this.points = this.tweened.toFixed(0);
      }
    });
  },

  updateall(sum) {
    gsap.to(this, {
      duration: 3,
      alltweened: sum,
      onUpdate: () => {
        this.sumpoints = this.alltweened.toFixed(0);
      }
    });
  },
      connect(){
          if(this.currentRoom.id){
              let vm = this;
              window.Echo.private('logs.'+this.currentRoom.id)
              .listen('.feed.new' , e => {
               const newlog = e.logs;
              
              if(newlog.points > 0){
                const sumpoints = parseInt(this.sumpoints) + parseFloat(newlog.points);
                this.updateall(sumpoints);

               if(newlog.userid === this.user.id){
                const newPoints = parseFloat(this.points) + parseFloat(newlog.points);
                this.updatePoints(newPoints);
               } 
              }

              if(newlog.points < 0){
                const sumpoints = parseInt(this.sumpoints) - parseFloat(newlog.points);
                this.updateall(sumpoints);
                
               if(newlog.userid === this.user.id){
                const newPoints = parseFloat(this.points) - parseFloat(newlog.points);
                this.updatePoints(newPoints);
               } 
              }
              
                vm.getrecentfeeds();  
              });
          }
      },
      getrecentfeeds(){
        axios.get('/api/data/recentfeeds')
         .then(response => {
           this.logs = response.data.logs;
         })
         .catch(error =>{
          console.log(error);
         })
      },
      getRooms(){
        axios.get('/api/logs/rooms')
        .then(reponse => {
          this.logsRooms = reponse.data;
          this.setRoom(this.logsRooms[0]);
        })
        .catch(error=>{
          console.log(error);
        })
      },
      disconnect(room){
                window.Echo.leave('logs.'+room.id);
        },
      setRoom(room){
        		this.currentRoom = room;
        },
      toggleSidbarMenu(){
        this.isSidebarOpen = !this.isSidebarOpen
      },
      openchat(){
       this.isChatopen = !this.isChatopen
      },
      recentbar(){
       this.open = !this.open
      },
      logout(e) {
          e.preventDefault()
          this.$axios.get('/sanctum/csrf-cookie').then(response => {
              this.$axios.post('/api/logout')
              .then(response => {
                  if(response.data.success) {
                      window.location.href = "/"
                  } else {
                      console.log(response);
                  }
              })
              .catch(function (error) {
                  console.error(error);
              });
          })
      }
    },
    mounted() {
    gsap.to(this, { duration: 3, tweened: this.points, onUpdate: () => { this.points = this.tweened.toFixed(0); }});
   
    gsap.to(this, { duration: 3, alltweened: this.sumpoints, onUpdate: () => { this.sumpoints = this.alltweened.toFixed(0); }});

    this.getrecentfeeds()
  },
}
</script>
