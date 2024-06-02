<template>
    <tr>
        <td>{{ product.product_id }}</td>
        <td>{{ product.name }}</td>
        <td>${{ product.price }}</td>
        <td>
            <button @click="editProduct" class="rounded-lg mr-2 px-2 bg-green-700 text-green-100 hover:bg-green-800 duration-300">Edit</button>
            <button @click="deleteProduct" class="rounded-lg px-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300">Delete</button>
        </td>
    </tr>
</template>

<script setup>
const props = defineProps({
    product: {
        type: Object,
        required: true
    }
});
const emits = defineEmits(['edit', 'delete']);

const editProduct = () => {
    emits('edit', props.product);
};

const deleteProduct = () => {
    emits('delete', props.product.product_id);
};
</script>
