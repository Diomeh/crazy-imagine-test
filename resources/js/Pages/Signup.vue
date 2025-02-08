<script setup>
import { useForm } from "@inertiajs/vue3";

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
            <div class="mb-3">
                <label class="block">Name:</label>
                <input type="text" v-model="form.name" class="w-full p-2 border rounded"/>
                <small v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Email:</label>
                <input type="email" v-model="form.email" class="w-full p-2 border rounded"/>
                <small v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Age:</label>
                <input type="number" v-model="form.age" class="w-full p-2 border rounded"/>
                <small v-if="form.errors.age" class="text-red-500">{{ form.errors.age }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Date of Birth:</label>
                <input type="date" v-model="form.dob" class="w-full p-2 border rounded"/>
                <small v-if="form.errors.dob" class="text-red-500">{{ form.errors.dob }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Address:</label>
                <textarea v-model="form.address" class="w-full p-2 border rounded"></textarea>
                <small v-if="form.errors.address" class="text-red-500">{{ form.errors.address }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Password:</label>
                <input type="password" v-model="form.password" class="w-full p-2 border rounded"/>
                <small v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Confirm Password:</label>
                <input type="password" v-model="form.password_confirmation" class="w-full p-2 border rounded"/>
            </div>

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

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded">Sign Up</button>
        </form>
    </div>
</template>
