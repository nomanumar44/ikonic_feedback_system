import { createRouter, createWebHistory } from "vue-router";

// import notfound from '../components/AccountManagment/settings/error/pagenotfound.vue'

import account_dashboard from '../components/Feedbacks/Dashboard.vue';
import UserProfile from '../components/Feedbacks/Admin/Product.vue';
import ProductList from '../components/Feedbacks/Admin/ProductList.vue';
import FeedbackForm from '../components/Feedbacks/Admin/FeedbackForm.vue';
import FeedsBacks from '../components/Feedbacks/Admin/FeedsBacks';

const routes = [
  {
    path: '/admin/dashboard',
    name: 'accounts.dashboard',
    component: account_dashboard,
  },
  {
    path: '/user/dashboard',
    name: 'user.dashboard',
    component: FeedbackForm,
  },
  {
    path: '/user-profile',
    name: 'users.profile',
    component: UserProfile,
  },
  {
    path: '/',
    name: 'products.list',
    component: ProductList,
  },
  {
    path: '/feedbacks',
    name: 'feedbacks.list',
    component: FeedsBacks,
  },
//   {
//     path: '/:pathMatch(.*)*',
//     name: 'PageNotFound',
//     component: notfound,
//   },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
