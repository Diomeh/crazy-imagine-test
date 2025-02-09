<script setup>
import { useForm } from "@inertiajs/vue3";

import SimpleButton from "../Components/SimpleButton.vue";
import SimpleInput from "../Components/SimpleInput.vue";
import SimpleTextArea from "../Components/SimpleTextArea.vue";

const form = useForm({
    name: "",
    email: "",
    age: "",
    dob: "",
    address: "",
    password: "",
    password_confirmation: "",
    role: "",
    profile_picture: null,
});

const handleFileUpload = (event) => {
    form.profile_picture = event.target.files[0];
};

const submitForm = () => {
    form.post("/signup", {
        forceFormData: true, // Ensures form data is sent correctly
    });
};
</script>

<template>
    <div class="container mx-auto p-4 max-w-md">
        <h2 class="text-xl font-bold mb-4">User Signup</h2>

        <form @submit.prevent="submitForm">
            <SimpleInput :form-binding="form" form-key="name" label="Name" type="text" />
            <SimpleInput :form-binding="form" form-key="email" label="Email" type="email" />
            <SimpleInput :form-binding="form" form-key="age" label="Age" type="number" />
            <SimpleInput :form-binding="form" form-key="dob" label="Date of Birth" type="date" />
            <SimpleTextArea :form-binding="form" form-key="address" label="Address" />
            <SimpleInput :form-binding="form" form-key="password" label="Password" type="password" />
            <SimpleInput :form-binding="form" form-key="password_confirmation" label="Confirm Password" type="password" />

            <div class="mb-3">
                <label class="block">Role:</label>
                <select v-model="form.role" class="w-full p-2 border rounded">
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                </select>
                <small v-if="form.errors.role" class="text-red-500">{{ form.errors.role }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Profile Picture:</label>
                <input type="file" @change="handleFileUpload" class="w-full p-2 border rounded"/>
                <small v-if="form.errors.profile_picture" class="text-red-500">{{ form.errors.profile_picture }}</small>
            </div>

            <SimpleButton text="Sign In" type="submit" class="w-full"/>
        </form>
    </div>
</template>
