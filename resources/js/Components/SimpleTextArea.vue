<script setup>

import { useForm } from "@inertiajs/vue3";

const { formBinding, formKey } = defineProps({
    label: String,
    placeholder: String,
    value: String,
    disabled: Boolean,
    formKey: String,
    formBinding: useForm,
});

const getFormErr = () => {
    return formBinding && formBinding.errors && formBinding.errors[formKey]
        ? formBinding.errors[formKey]
        : null
};
</script>

<template>
    <div class="mb-3">
        <label class="block">{{ label }}</label>

        <textarea
            v-if="formBinding"
            v-model="formBinding[formKey]"
            :placeholder="placeholder"
            :disabled="disabled"
            class="w-full p-2 border rounded"
        ></textarea>
        <textarea
            v-else
            :placeholder="placeholder"
            :disabled="disabled"
            class="w-full p-2 border rounded"
        >{{ value }}</textarea>

        <small v-if="getFormErr()" class="text-red-500">{{ getFormErr() }}</small>
    </div>
</template>

<style scoped>
</style>
