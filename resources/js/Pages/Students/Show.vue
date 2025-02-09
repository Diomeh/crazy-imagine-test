<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    id: Number,
    firstName: String,
    lastName: String,
    address: String,
});

const deleteForm = useForm({
    id: props.id || 0,
})

const goBack = () => {
    // Ideally we would want to make use of Inertia to go back to previous page
    // Due to time constraints, we're using plain js
    history.back()
};

const deleteStudent = () => {
    if (!props.id) return;

    deleteForm.delete(`/students/${props.id}`);
};
</script>
<template>
    <div class="container mx-auto p-4 max-w-md">
        <!--  Delete form -->
        <form>
            <input v-model="deleteForm.id" type="hidden" name="id">
        </form>

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Student #{{ id }}</h1>
            <div class="flex space-x-3">
                <Link
                    v-if="id"
                    :href="`/students/${id}/edit`"
                    class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors"
                >
                    Edit
                </Link>

                <button
                    v-if="props.id"
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

        <div class="mb-3">
            <label class="block">First Name</label>
            <input
                :value="firstName"
                type="text"
                class="w-full p-2 border rounded disabled"
                disabled
            />
        </div>

        <div class="mb-3">
            <label class="block">Last Name</label>
            <input
                :value="lastName"
                type="text"
                class="w-full p-2 border rounded disabled"
                disabled
            />
        </div>

        <div class="mb-3">
            <label class="block">Address</label>
            <input
                :value="address"
                type="text"
                class="w-full p-2 border rounded disabled"
                disabled
            />
        </div>
    </div>
</template>
