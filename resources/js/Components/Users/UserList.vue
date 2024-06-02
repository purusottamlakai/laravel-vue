<template>
    <div class="flex gap-2 flex-wrap">
        <UserItem v-for="user in users" :key="user.id" :user="user" @edit="openEditModel"
            class="w-1/4 h-full bg-slate-600 text-white rounded-lg" />
    </div>
    <EditUserModal v-if="isEditModalOpen" :user="selectedUser" @close="isEditModalOpen = false" @update="updateUser" />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import UserItem from './UserItem.vue';
import EditUserModal from './EditUserModal.vue';

const users = ref([]);
const isEditModalOpen = ref(false);
const selectedUser = ref(null);
onMounted(async () => {
    try {
        fetchUsers();
    } catch (error) {
        console.error('Error fetching users: ', error);
    }
})

const fetchUsers = async () => {
    const response = await axios.get('/api/users');
    users.value = response.data;
};

const openEditModel = (user) => {
    selectedUser.value = { ...user };
    isEditModalOpen.value = true;
}

const updateUser = async (user) => {
    await axios.put(`/api/users/${user.id}`, user).then(function (response) {
        isEditModalOpen.value = false;
        if (response.data.success) {
            alert(response.data.message)
            const index = users.value.findIndex(p => p.id === user.id);
            users.value[index] = user;
        } else {
            alert(response.data.message);
        }
    }).catch(function (error) {
        isEditModalOpen.value = false;
        alert(error.response.data.message);
    });
};
</script>