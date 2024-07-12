<template>
  <div class="flex flex-wrap justify-center gap-2">
    <div class="bg-gray-600 text-white w-1/3 h-24 flex justify-center items-center rounded-lg">Total User : <span>{{ userCount }}</span></div>
    <div class="bg-green-600 text-white w-1/3 h-24 flex justify-center items-center rounded-lg">Total Product : <span>{{ productCount }}</span></div>
</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

const productCount = ref(0);
const userCount = ref(0);

onMounted(async () => {
  axios.get('/api/home-data') 
    .then(function (response) {
      userCount.value = response.data.user_count;
      productCount.value = response.data.product_count;
    })
    .catch(function (error) {
      Swal.fire({
        title: 'Error!',
        text: error.response.data.message ?? message,
        icon: 'error',
        confirmButtonText: 'Ok'
      });
  });
});
</script>