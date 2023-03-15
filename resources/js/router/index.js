import {createWebHistory, createRouter} from "vue-router";

import AppLayout from '../layouts/AppLayout.vue';
import AdminLayout from '../layouts/AdminLayout.vue';

//Admin
import dashboard from '../admin/dashboard';
import users from '../admin/users';


//User
import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import Earn from '../pages/Earn';
import Skins from '../pages/Skins';
import Giftcard from '../pages/Giftcard';
import Inventory from '../pages/Inventory';
import Posts from '../components/Posts';
import EditPost from '../components/EditPost';
import AddPost from '../components/AddPost';

import container from '../chat/container';

export const routes = [
    
    {
        path: '/',
        component: AppLayout,
        children: [
  
          {
              name: 'home',
              path: '',
              component: Home
          },
          {
              name: 'register',
              path: 'register',
              component: Register
          },
          {
              name: 'login',
              path: 'login',
              component: Login
          },
          {
            name: 'dashboard',
            path: '/dashboard',
            component: Dashboard
          },
          {
            name: 'earn',
            path: 'earn',
            component: Earn
          },
          {
            name: 'skins',
            path: 'skins',
            component: Skins
          },
          {
            name: 'giftcard',
            path: 'giftcards',
            component: Giftcard
          },
          {
            name: 'inventory',
            path: 'inventory',
            component: Inventory
          },
          {
            name: 'chat',
            path: 'chat',
            component: container
          },
          {
              name: 'posts',
              path: 'posts',
              component: Posts
          },
          {
              name: 'addpost',
              path: 'posts/add',
              component: AddPost
          },
          {
              name: 'editpost',
              path: 'posts/edit/:id',
              component: EditPost
          },
        ],
      },
      {
        path: '/admin',
        component: AdminLayout,
        children: [
          {
            name: 'dash',
            path: 'dashboard',
            component: dashboard
          },
          {
            name: 'users',
            path: 'users',
            component: users
          },
        ],
      },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
