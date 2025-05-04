<template>
    <div class="container">
        <h2>Tasks</h2>
        <form @submit.prevent="addTask">
            <input v-model="newTask.title" placeholder="Title" required />
            <textarea v-model="newTask.body" placeholder="Body" required></textarea>
            <button type="submit">Add Task</button>
        </form>
        <ul>
            <li v-for="task in tasks" :key="task.id">
                <input type="checkbox" v-model="task.completed" @change="updateTask(task)" />
                <span :class="{ completed: task.completed }">{{ task.title }}</span>
                <button @click="editTask(task)">Edit</button>
                <button @click="deleteTask(task)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            tasks: [],
            newTask: { title: '', body: '' },
            editingTask: null,
        };
    },
    async created() {
        await this.fetchTasks();
    },
    methods: {
        async fetchTasks() {
            const response = await axios.get('/tasks');
            this.tasks = response.data;
        },
        async addTask() {
            await axios.post('/tasks', this.newTask);
            this.newTask = { title: '', body: '' };
            await this.fetchTasks();
        },
        async updateTask(task) {
            await axios.put(`/tasks/${task.id}`, task);
            await this.fetchTasks();
        },
        async deleteTask(task) {
            await axios.delete(`/tasks/${task.id}`);
            await this.fetchTasks();
        },
        editTask(task) {
            this.newTask = { ...task };
            this.deleteTask(task);
        },
    },
};
</script>

<style>
.completed {
    text-decoration: line-through;
}
</style>