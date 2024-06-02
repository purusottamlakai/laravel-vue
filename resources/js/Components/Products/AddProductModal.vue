<template>
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-4 rounded-lg shadow-lg w-1/3">
        <h2 class="text-lg font-bold mb-4">Add Product</h2>
        <form @submit.prevent="saveProduct">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input v-model="newProduct.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required/>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea v-model="newProduct.description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Price</label>
            <input v-model="newProduct.price" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required/>
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
    import { ref } from 'vue';
    
    const newProduct = ref({});
    const emits = defineEmits(['close', 'add']);
  
    const saveProduct = () => {
      emits('add', newProduct.value);
    };
  </script>
  

  