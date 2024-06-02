<template>
    <div class="flex items-center p-4 bg-white shadow rounded-lg">
        <div class="flex-1">
            <h5 class="font-bold text-gray-700 mb-2" v-text="user.name"></h5>
            <p class="text-gray-600" v-text="user.email"></p>
        </div>
        <button
            class="bg-blue-600 text-white rounded-lg px-4 py-2 ml-4 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            @click="editUser">
            Edit
        </button>
    </div>
</template>

<script setup>
    const props = defineProps({
        user: {
            type: Object,
            required: true
        }
    });

    const emits = defineEmits(['edit']);

    const editUser = () => {
        emits('edit', props.user);
    };
</script>