<script setup>
import { useForm } from '@inertiajs/vue3';
import SimpleButton from "../../Components/SimpleButton.vue";
import SimpleTextArea from "../../Components/SimpleTextArea.vue";
import SimpleInput from "../../Components/SimpleInput.vue";

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
                <SimpleButton v-if="id" :href="`/students/${id}/edit`" text="Edit" color="success" type="link"/>
                <SimpleButton v-if="id" @click="deleteStudent" text="Delete" color="danger"/>
                <SimpleButton @click="goBack" text="Go Back" color="muted"/>
            </div>
        </div>

        <SimpleInput :value="firstName" label="First Name" />
        <SimpleInput :value="lastName" label="Last Name" />
        <SimpleTextArea :value="address" label="Address" />
    </div>
</template>
