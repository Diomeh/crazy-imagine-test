<script setup>

import { useForm } from "@inertiajs/vue3";

defineProps({
    label: String,
    placeholder: String,
    value: String,
    formKey: String,
    formBinding: useForm,
});
</script>

<template>
    <div class="mb-3">
        <label class="block">{{ label }}</label>

        <textarea
            v-if="formBinding"
            v-model="formBinding[formKey]"
            :placeholder="placeholder"
            class="w-full p-2 border rounded"
        ></textarea>
        <textarea
            v-else
            :placeholder="placeholder"
            class="w-full p-2 border rounded"
        >{{ value }}</textarea>

        <small v-if="formBinding.errors[formKey]" class="text-red-500">{{ formBinding.errors[formKey] }}</small>
    </div>
</template>

<style scoped>
</style>
