<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
});

const submitForm = () => {
    form.post("/signin", {
        forceFormData: true, // Ensures form data is sent correctly
    });
};
</script>

<template>
    <div class="container mx-auto p-4 max-w-md">
        <h2 class="text-xl font-bold mb-4">User Sign In</h2>

        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label class="block">Email:</label>
                <input type="email" v-model="form.email" class="w-full p-2 border rounded"/>
                <small v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</small>
            </div>

            <div class="mb-3">
                <label class="block">Password:</label>
                <input type="password" v-model="form.password" class="w-full p-2 border rounded"/>
                <small v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</small>
            </div>

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded">Sign In</button>
        </form>

        <div class="mt-4 text-center">
            <p>Don't have an account?
                <a href="/signup" class="text-blue-500 hover:underline">Sign up here</a>.
            </p>
        </div>
    </div>
</template>
