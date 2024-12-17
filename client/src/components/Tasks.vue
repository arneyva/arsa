<template>
    <div>
      <h1>Tasks</h1>
      <ul>
        <li v-for="task in tasks" :key="task.id">
          <strong>{{ task.title }}</strong>: {{ task.description }}
        </li>
      </ul>
  
      <h2>Add New Task</h2>
      <form @submit.prevent="addTask">
        <div>
          <label for="title">Title:</label>
          <input type="text" v-model="newTask.title" required />
        </div>
        <div>
          <label for="description">Description:</label>
          <input type="text" v-model="newTask.description" required />
        </div>
        <button type="submit">Add Task</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        tasks: [],
        newTask: {
          title: '',
          description: ''
        }
      };
    },
    created() {
      this.fetchTasks(); // Ambil tugas saat komponen dibuat
    },
    methods: {
      async fetchTasks() {
        try {
          const response = await axios.get('http://your-laravel-api-url/api/tasks', {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('token')}`
            }
          });
          this.tasks = response.data;
        } catch (error) {
          console.error('Failed to fetch tasks:', error);
        }
      },
      async addTask() {
        try {
          const response = await axios.post('http://your-laravel-api-url/api/tasks', this.newTask, {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('token')}`
            }
          });
          this.tasks.push(response.data); // Menambahkan tugas baru ke daftar
          this.newTask = { title: '', description: '' }; // Reset form
        } catch (error) {
          console.error('Failed to add task:', error);
        }
      }
    }
  };
  </script>
  