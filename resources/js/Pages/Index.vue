<script setup>
import { ref } from 'vue';

const links = ref([
    {
        title: "Users auth & dynamic content",
        items: [
            { text: "Login", url: "/signin" },
            { text: "Registration ", url: "/signup" },
            { text: "Dashboard", url: "/dashboard" },
        ]
    },
    {
        title: "Students CRUD",
        items: [
            { text: "Paginated index", url: "/students" },
            { text: "Student creation", url: "/students/create" },
            { text: "Student details", url: "/students/1" },
            { text: "Student details modification", url: "/students/1/edit" },
        ]
    },
    {
        title: "Console",
        items: [
            { text: "<code>fetch-data</code> Artisan command", desc: "Pulls data from API endpoint to schedule for storage, offers <code>--debug</code> option for testing" },
        ]
    }
]);
</script>

<template>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-center mb-6">Crazy Imagine Software - Test Application</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="(link, index) in links" :key="index" class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">{{ link.title }}</h2>
                <ul class="space-y-2">
                    <li v-for="(item, idx) in link.items" :key="idx">
                        <a v-if="item.url" :href="item.url" class="text-blue-500 hover:underline">{{ item.text }}</a>
                        <div v-else>
                            <span v-html="item.text"></span>
                            <div class="my-4 border-t border-gray-600"></div>
                            <span v-html="item.desc"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    max-width: 900px;
}
</style>
