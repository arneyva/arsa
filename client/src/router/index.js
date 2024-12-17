import { createRouter, createWebHistory } from "vue-router";
import Login from "../components/Login.vue";
import Tasks from "../components/Tasks.vue";

const routes = [
  { path: "/", component: Login },
  { path: "/tasks", component: Tasks },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
