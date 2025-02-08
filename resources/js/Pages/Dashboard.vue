<script setup>
import { defineProps } from 'vue';
import axios from "axios";

const props = defineProps({
    role: String,
    name: String,
});

const handleLogout = async () => {
    // Submit a post XHR to logout user
    // As server handles everything regarding logout
    // we don't really care about the response
    try {
        await axios.post("/logout");
        window.location = '/';
    } catch (e) {
        console.log(e);
    }
}
</script>

<template>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white p-6">
            <h2 class="text-2xl font-bold mb-8">Dashboard</h2>
            <ul>
                <li class="mb-4">
                    <a href="#" class="text-white hover:text-gray-400">Home</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="text-white hover:text-gray-400">Profile</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="text-white hover:text-gray-400">Settings</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="text-white hover:text-gray-400">Notifications</a>
                </li>
            </ul>

            <!-- Divider -->
            <div class="my-4 border-t border-gray-600"></div>

            <div class="mt-6">
                <a href="#" @click.prevent="handleLogout" class="text-white hover:text-gray-400">Log out</a>
            </div>
        </div>

        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Welcome {{ props.name }}!</h1>
                <button class="bg-blue-500 text-white p-2 rounded">Profile</button>
            </div>

            <!-- Content Based on Role -->
            <div v-if="props.role === 'admin'">
                <h2 class="text-2xl font-semibold mb-6">Admin Dashboard</h2>

                <!-- Admin Specific Content -->
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-white p-6 shadow-lg rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Manage Users</h3>
                        <p>View and manage all registered users in the system.</p>
                        <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Go to Users</button>
                    </div>

                    <div class="bg-white p-6 shadow-lg rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Reports</h3>
                        <p>Access system-wide reports and analytics.</p>
                        <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">View Reports</button>
                    </div>

                    <div class="bg-white p-6 shadow-lg rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">System Settings</h3>
                        <p>Manage global settings and configurations.</p>
                        <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Configure Settings</button>
                    </div>
                </div>
            </div>

            <div v-else-if="props.role === 'manager'">
                <h2 class="text-2xl font-semibold mb-6">Manager Dashboard</h2>

                <!-- Manager Specific Content -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white p-6 shadow-lg rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Assigned Tasks</h3>
                        <p>View your team's assigned tasks and manage them.</p>
                        <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">View Tasks</button>
                    </div>

                    <div class="bg-white p-6 shadow-lg rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Team Performance</h3>
                        <p>Monitor your team's performance and progress.</p>
                        <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">View Performance</button>
                    </div>
                </div>
            </div>

            <!-- Fallback (Access Denied) -->
            <div v-else>
                <h2 class="text-2xl font-semibold mb-6">Access Denied</h2>
                <p>You do not have permission to view this dashboard.</p>
            </div>
        </div>
    </div>
</template>
