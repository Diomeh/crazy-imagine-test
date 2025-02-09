<script setup>
import { Link } from '@inertiajs/vue3';

const { color } = defineProps({
    text: String,
    color: String,
    type: String,
    onclick: Function,
    href: String,
    as: String,
});

const getColorClass = () => {
    switch (color) {
        case 'muted-light':
            return 'text-black bg-gray-300 hover:bg-gray-400'
        case 'muted':
            return 'text-white bg-gray-500 hover:bg-gray-600'
        case 'warning':
            return 'text-black bg-yellow-500 hover:bg-yellow-600'
        case 'success':
            return 'text-white bg-green-500 hover:bg-green-600'
        case 'danger':
            return 'text-white bg-red-500 hover:bg-red-600'
        case 'primary-light':
            return 'text-black bg-gray-200 hover:bg-blue-500 hover:text-white'
        case 'primary':
        default:
            return 'text-white bg-blue-500 hover:bg-blue-600'
    }
}
</script>

<template>
    <Link
        v-if="type === 'link'"
        :href="href"
        :as="as"
        :class="getColorClass()"
        class="px-4 py-2 rounded transition-colors text-sm"
    >
        {{ text }}
    </Link>
    <button
        v-else
        @click="onclick"
        :type="type === 'submit' ? type : 'button'"
        :class="getColorClass()"
        class="px-4 py-2 rounded transition-colors text-sm"
    >
        {{ text }}
    </button>
</template>
