<script setup>
import {Link, useForm} from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    id: Number,
    firstName: String,
    lastName: String,
    address: String,
});

const form = useForm({
    id: props.id || 0,
    first_name: props.firstName || '',
    last_name: props.lastName || '',
    address: props.address || ''
});

const submitForm = () => {
    if (props.id) {
        form.patch(`/students/${props.id}`);
    } else {
        form.post('/students');
    }
};

const goBack = () => {
    // Ideally we would want to make use of Inertia to go back to previous page
    // Due to time constraints, we're using plain js
    history.back()
};

const deleteStudent = () => {
    form.delete(`/students/${props.id}`);
};
</script>

<template>
    <div class="container mx-auto p-4 max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">
                <span v-if="id">Edit student #{{ id }}</span>
                <span v-else>Create New Student</span>
            </h1>
            <div class="flex space-x-2">
                <button
                    v-if="id"
                    @click="deleteStudent"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                    Delete
                </button>

                <button
                    @click="goBack"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors">
                    Go Back
                </button>
            </div>
        </div>

        <!-- Form to create or edit student -->
        <form @submit.prevent="submitForm" class="space-y-4">
            <input v-model="form.id" type="hidden" name="id">

            <div class="mb-3">
                <label class="block">First Name</label>
                <input
                    type="text"
                    v-model="form.first_name"
                    class="w-full p-2 border rounded"
                    placeholder="Enter first name"
                />
                <small v-if="form.errors.first_name" class="text-red-500">{{ form.errors.first_name }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Last Name</label>
                <input
                    type="text"
                    v-model="form.last_name"
                    class="w-full p-2 border rounded"
                    placeholder="Enter last name"
                />
                <small v-if="form.errors.last_name" class="text-red-500">{{ form.errors.last_name }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Address:</label>
                <textarea v-model="form.address" class="w-full p-2 border rounded"></textarea>
                <small v-if="form.errors.address" class="text-red-500">{{ form.errors.address }}</small>
            </div>

            <div class="mt-4">
                <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded">
                    <span v-if="id">Edit student</span>
                    <span v-else>Create Student</span>
                </button>
            </div>
        </form>
    </div>
</template>
