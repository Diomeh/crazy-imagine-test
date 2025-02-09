<script setup>
import { defineProps } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';

const deleteForm = useForm({
    id: 0,
});

const { paginator } = defineProps({
    paginator: Object,
});

// This is an ugly hack
const deleteStudent = (id) => {
    if (!id) return;

    deleteForm.id = id;
    deleteForm.delete(`/students/${id}`);
};
</script>

<template>
    <div class="container mx-auto p-4 max-w-4xl">
        <!-- Delete form -->
        <form>
            <input v-model="deleteForm.id" type="hidden" name="id">
        </form>

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Student List</h1>
            <Link
                href="/students/create"
                class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors"
                as="button"
            >
                Create New Student
            </Link>
        </div>

        <!-- Table to display students -->
        <table class="min-w-full table-auto border-collapse mb-4">
            <thead>
            <tr>
                <th class="border-b px-4 py-2 text-left">ID</th>
                <th class="border-b px-4 py-2 text-left">First Name</th>
                <th class="border-b px-4 py-2 text-left">Last Name</th>
                <th class="border-b px-4 py-2 text-left">Address</th>
                <th class="border-b px-4 py-2 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in paginator.data" :key="student.id">
                <td class="border-b px-4 py-2">{{ student.id }}</td>
                <td class="border-b px-4 py-2">{{ student.first_name }}</td>
                <td class="border-b px-4 py-2">{{ student.last_name }}</td>
                <td class="border-b px-4 py-2">{{ student.address }}</td>
                <td class="border-b px-4 py-2 text-center">
                    <Link
                        :href="`/students/${student.id}`"
                        class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors mr-2"
                    >
                        View
                    </Link>
                    <Link
                        :href="`/students/${student.id}/edit`"
                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors mr-2"
                    >
                        Edit
                    </Link>
                    <button
                        @click="() => { deleteStudent(student.id) }"
                        class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition-colors mr-2"
                    >
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Pagination controls -->
        <div class="flex justify-center mt-4">
            <span>
                <Link
                    v-if="paginator.prev_page_url"
                    :href="paginator.prev_page_url"
                    class="bg-gray-300 text-black py-2 px-4 rounded hover:bg-gray-400 transition-colors mr-2"
                >
                    &laquo; Previous
                </Link>
            </span>

            <span v-for="(page, index) in paginator.links" :key="index">
                <Link
                    v-if="page.url && index > 0 && index < (paginator.links.length - 1)"
                    :href="page.url"
                    :class="[
                        'py-2 px-4 rounded transition-colors mr-2',
                        page.active ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black hover:bg-blue-500 hover:text-white'
                    ]"
                >
                    {{ page.label }}
                </Link>
            </span>

            <span>
                <Link
                    v-if="paginator.next_page_url"
                    :href="paginator.next_page_url"
                    class="bg-gray-300 text-black py-2 px-4 rounded hover:bg-gray-400 transition-colors ml-2"
                >
                    Next &raquo;
                </Link>
            </span>
        </div>
    </div>
</template>
