<script setup>
import { useForm } from '@inertiajs/vue3';

import SimpleButton from "../../Components/SimpleButton.vue";
import SimpleInput from "../../Components/SimpleInput.vue";
import SimpleTextArea from "../../Components/SimpleTextArea.vue";

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
                <SimpleButton v-if="id" @click="deleteStudent" text="Delete" color="danger" />
                <SimpleButton @click="goBack" text="Go Back" color="muted"/>
            </div>
        </div>

        <form @submit.prevent="submitForm" class="space-y-4">
            <input v-model="form.id" type="hidden" name="id">
            <SimpleInput :form-binding="form" form-key="first_name" label="First Name" placeholder="Enter first name"/>
            <SimpleInput :form-binding="form" form-key="last_name" label="Last Name" placeholder="Enter last name"/>
            <SimpleTextArea :form-binding="form" form-key="address" label="Address"></SimpleTextArea>

            <div class="mt-4">
                <SimpleButton :text="(id ? 'Edit' : 'Create') + ' student'" type="submit" color="primary"/>
            </div>
        </form>
    </div>
</template>
W
