<script setup>
import { defineProps } from 'vue';
import { Link, useForm } from '@inertiajs/vue3'

const deleteForm = useForm({
    id: 0,
})

defineProps({
    students: Array,
})

// This is an ugly hack
const deleteStudent = (id) => {
    if (!id) return;

    deleteForm.id = id;
    deleteForm.delete(`/students/${id}`);
};
</script>

<template>
    <div class="container mx-auto p-4 max-w-4xl">
        <!--  Delete form -->
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
            <tr v-for="student in students" :key="student.id">
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
    </div>
</template>
