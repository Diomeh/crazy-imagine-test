<script setup>

import { useForm } from "@inertiajs/vue3";

defineProps({
    type: String,
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

        <input
            v-if="formBinding"
            v-model="formBinding[formKey]"
            :type="type ? type : 'text'"
            :placeholder="placeholder"
            class="w-full p-2 border rounded"
        />
        <input
            v-else
            :type="type ? type : 'text'"
            :placeholder="placeholder"
            :value="value"
            class="w-full p-2 border rounded"
        />

        <small v-if="formBinding.errors[formKey]" class="text-red-500">{{ formBinding.errors[formKey] }}</small>
    </div>
</template>

<style scoped>
</style>
