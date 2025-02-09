<script setup>
import { useForm } from '@inertiajs/vue3';
import SimpleButton from "../../Components/SimpleButton.vue";

const deleteForm = useForm({
    id: 0,
});

const { paginator } = defineProps({
    paginator: Object,
});

// This is an ugly hack
const deleteStudent = (id) => {
    if (!id) return;

    deleteForm.id = id;
    deleteForm.delete(`/students/${id}`);
};
</script>

<template>
    <!-- Delete form -->
    <form>
        <input v-model="deleteForm.id" type="hidden" name="id">
    </form>

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Student List</h1>

        <SimpleButton
            text="New student"
            type="link"
            href="/students/create"
            as="button"
        />
    </div>

    <!-- Table to display students -->
    <table class="min-w-full table-auto border-collapse mb-4">
        <thead>
        <tr>
            <th class="border-b px-4 py-2 text-left">ID</th>
            <th class="border-b px-4 py-2 text-left">First Name</th>
            <th class="border-b px-4 py-2 text-left">Last Name</th>
            <th class="border-b px-4 py-2 text-left">Address</th>
            <th class="border-b px-4 py-2 text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="student in paginator.data" :key="student.id">
            <td class="border-b px-4 py-2">{{ student.id }}</td>
            <td class="border-b px-4 py-2">{{ student.first_name }}</td>
            <td class="border-b px-4 py-2">{{ student.last_name }}</td>
            <td class="border-b px-4 py-2">{{ student.address }}</td>
            <td class="border-b px-4 py-2 text-center">
                <SimpleButton
                    :href="`/students/${student.id}`"
                    text="View"
                    type="link"
                    color="success"
                    class="mr-2"
                />
                <SimpleButton
                    :href="`/students/${student.id}/edit`"
                    text="Edit"
                    type="link"
                    color="primary"
                    class="mr-2"
                />
                <SimpleButton
                    @click="() => { deleteStudent(student.id) }"
                    :href="`/students/${student.id}`"
                    text="Delete"
                    color="danger"
                />
            </td>
        </tr>
        </tbody>
    </table>

    <!-- Pagination controls -->
    <div class="flex justify-center mt-4">
        <span>
            <SimpleButton
                v-if="paginator.prev_page_url"
                :href="paginator.prev_page_url"
                text="&laquo; Previous"
                type="link"
                color="muted-light"
                class="mr-2"
            />
        </span>

        <span v-for="(page, index) in paginator.links" :key="index">
            <SimpleButton
                v-if="page.url && index > 0 && index < (paginator.links.length - 1)"
                :href="page.url"
                :text="page.label"
                :color="page.active ? 'primary' : 'primary-light'"
                class="mx-1"
                type="link"
            />
        </span>

        <span>
            <SimpleButton
                v-if="paginator.next_page_url"
                :href="paginator.next_page_url"
                text="Next &raquo;"
                type="link"
                color="muted-light"
                class="ml-2"
            />
        </span>
    </div>
</template>
