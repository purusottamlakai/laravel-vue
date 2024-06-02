<template>
     <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-4 rounded-lg shadow-lg w-1/3">
        <h2 class="text-lg font-bold mb-4">Edit User</h2>
        <form @submit.prevent="saveUser">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input v-model="localUser.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required/>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input v-model="localUser.password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
          </div>
          <div class="flex justify-end">
            <button type="button" @click="$emit('close')" class="mr-2 px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
          </div>
        </form>
      </div>
    </div>
</template>

<script setup>
    import { ref, watch } from 'vue';

    const props = defineProps({
        user: {
            type: Object,
            required: true
        }
    });

    const emits = defineEmits(['close', 'update']);

    const localUser = ref({ ...props.user });

    watch(props.user, (newUser) => {
        localUser.value = { ...newUser };
    });

    const saveUser = () => {
        emits('update', localUser.value)
    }
</script>