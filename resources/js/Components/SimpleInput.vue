<script setup>
import { useForm } from "@inertiajs/vue3";

const { formBinding, formKey } = defineProps({
    type: String,
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

        <input
            v-if="formBinding"
            v-model="formBinding[formKey]"
            :type="type ? type : 'text'"
            :placeholder="placeholder"
            :disabled="disabled"
            class="w-full p-2 border rounded"
        />
        <input
            v-else
            :type="type ? type : 'text'"
            :placeholder="placeholder"
            :value="value"
            :disabled="disabled"
            class="w-full p-2 border rounded"
        />

        <small v-if="getFormErr()" class="text-red-500">{{ getFormErr() }}</small>
    </div>
</template>

<style scoped>
</style>
