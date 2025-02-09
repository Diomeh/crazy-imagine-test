<script setup>
import { useForm } from "@inertiajs/vue3";
import SimpleButton from "../Components/SimpleButton.vue";
import SimpleInput from "../Components/SimpleInput.vue";

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
            <SimpleInput :form-binding="form" form-key="email" label="Email" type="email"/>
            <SimpleInput :form-binding="form" form-key="password" label="Email" type="password"/>

            <SimpleButton text="Sign In" type="submit" class="w-full"/>
        </form>

        <div class="mt-4 text-center">
            <p>Don't have an account?
                <a href="/signup" class="text-blue-500 hover:underline">Sign up here</a>.
            </p>
        </div>
    </div>
</template>
