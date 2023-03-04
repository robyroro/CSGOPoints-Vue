<template>
<div class="container mx-auto">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 text-gray-700 dark:text-white bg-white dark:bg-c-d-blue border border-gray-300 dark:border-gray-700 overflow-hidden rounded-lg mx-auto">   
        <form>

        <div v-if="error !== null" class="w-full sm:max-w-md mx-auto text-center p-3 mb-2 border border-gray-300 dark:border-gray-700 text-sm text-red-700 bg-red-100 rounded dark:bg-c-black dark:text-red-400" role="alert">
         <span>{{error}}</span>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-white" for="name"><span>Name</span></label>
          <input class="bg-white dark:bg-c-black text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 dark:bg-gray-700 rounded shadow-sm mt-1 px-1 py-1 block w-full" id="name" type="text" v-model="name" required autofocus autocomplete="off"  placeholder="Enter your name">
        </div>

        <div class="mt-3">
          <label class="block text-sm font-medium text-gray-700 dark:text-white" for="email"><span>Email</span></label>
          <input class="bg-white dark:bg-c-black text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 dark:bg-gray-700 rounded shadow-sm mt-1 px-1 py-1 block w-full" id="email" type="email" v-model="email" required autofocus autocomplete="off" placeholder="Enter your email">
        </div>
    
        <div class="mt-3">
          <label class="block text-sm font-medium text-gray-700 dark:text-white" for="password"><span>Password</span></label>
          <input class="bg-white dark:bg-c-black text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 dark:bg-gray-700 rounded shadow-sm mt-1 px-1 py-1 block w-full" id="password" type="password" v-model="password" required autocomplete="off" placeholder="Enter your password">
        </div>
    
         <div class="flex items-center justify-end mt-3">
          <router-link to="/login" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 rounded font-semibold text-xs text-gray-700 dark:text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 mx-3">Login</router-link>
          <button type="submit" @click="handleSubmit" class="bg-gray-200 dark:bg-c-black inline-flex items-center px-4 py-2 border border-transparent rounded font-semibold text-xs text-gray-700 dark:text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-3">
            Register
          </button>
        </div>
        </form>
     </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                name: "",
                email: "",
                password: "",
                error: null
            }
        },

        methods: {
            handleSubmit(e) {
                e.preventDefault()
                if(this.password.length > 0) {
                    this.$axios.get('/sanctum/csrf-cookie').then(response => {
                        this.$axios.post('api/register', {
                            name: this.name,
                            email: this.email,
                            password: this.password
                        })
                        .then(response => {
                            if (response.data.success) {
                                 window.location.href = "/login"
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                    })
                }
            }
        },

        beforeRouteEnter(to, from, next) {
            if (window.Laravel.isLoggedin) {
                return next('dashboard');
            }
            next();
        }
    }
</script>
