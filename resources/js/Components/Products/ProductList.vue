<template>
  <div class="w-full">
    <div class="mb-2 float-right">
      <button @click="isAddModalOpen=true" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Add New</button>
    </div>
    <table class="w-full">
      <thead>
        <tr>
          <th>ProductId</th>
          <th>Name</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <ProductItem v-for="product in products" :key="product.id" :product="product" @edit="openEditModal"
          @delete="deleteProduct" class="text-center border-b border-solid border-gray-300" />
      </tbody>
    </table>
    <AddProductModal v-if="isAddModalOpen" @close="isAddModalOpen=false" @add="addProduct"/>
    <EditProductModal v-if="isEditModalOpen" :product="selectedProduct" @close="isEditModalOpen = false" @save="updateProduct" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import ProductItem from './ProductItem.vue';
import EditProductModal from './EditProductModal.vue';
import AddProductModal from './AddProductModal.vue';
import Swal from 'sweetalert2';

const fetchProducts = async () => {
  try {
    const response = await axios.get('/api/products');
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

const products = ref([]);
const isAddModalOpen = ref(false);
const isEditModalOpen = ref(false);
const selectedProduct = ref(null);

onMounted(async () => {
  fetchProducts();
});

const openEditModal = (product) => {
  selectedProduct.value = { ...product };
  isEditModalOpen.value = true;
};

const addProduct = async (product) => {
  await axios.post('/api/products', product).then(function (response) {
    isAddModalOpen.value = false;
    if (response.data.success) {
      Swal.fire({
        title: "Success",
        text: response.data.message,
        icon: "success"
      });
      fetchProducts();
    } else {
      Swal.fire({
        title: "Error",
        text: response.data.message,
        icon: "error"
      });
    }
  }).catch(function (error) {
    isAddModalOpen.value = false;
    Swal.fire({
      title: "Error",
      text: error.response.data.message,
      icon: "error"
    });
  });
};

const updateProduct = async (updatedProduct) => {
  await axios.put(`/api/products/${updatedProduct.product_id}`, updatedProduct).then(function (response) {
    isEditModalOpen.value = false;
    if (response.data.success) {
      Swal.fire({
        title: "Success",
        text: response.data.message,
        icon: "success"
      });

      const index = products.value.findIndex(p => p.product_id === updatedProduct.product_id);
      products.value[index] = updatedProduct;
    } else {
      Swal.fire({
        title: "Error",
        text: response.data.message,
        icon: "error"
      });
    }
  }).catch(function (error) {
    isEditModalOpen.value = false;
      Swal.fire({
        title: "Error",
        text: error.response.data.message,
        icon: "error"
      });
  });
};

const deleteProduct = async (productId) => {
  if (!window.confirm('Are you sure to delete this?')) {
    return
  }
  axios.delete(`/api/products/${productId}`)
    .then(function (response) {
      Swal.fire({
        title: "Success",
        text: response.data.message,
        icon: "success"
      });
      fetchProducts();
    })
    .catch(function (error) {
        Swal.fire({
          title: "Error",
          text: error.response.data.error,
          icon: "error"
        });
    });
};
</script>
