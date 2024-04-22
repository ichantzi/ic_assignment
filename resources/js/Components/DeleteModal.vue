<template>
  <div v-if="show" id="delete-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6">
      <h3 class="text-xl font-semibold text-gray-900">Είστε σίγουροι ότι θέλετε να διαγράψετε το ακίνητο?</h3>
      <h5 v-if="!deleted" class=" mt-5 mb-5 text-l text-center text-gray-900">Κωδικός ακινήτου: #{{code}}</h5>
      <h5 v-else class=" mt-5 mb-5 text-l text-center text-gray-900">Το ακίνητο διαγράφηκε επιτυχώς</h5>
      <div class="mt-4 flex justify-between space-x-4">
        <button v-if="!deleted" @click="deleteProperty" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg px-4 py-2" type="button">Διαγραφή</button>
        <button @click="closeModal" class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg px-4 py-2" type="button">Ακύρωση</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, getCurrentInstance } from 'vue';

const { emit } = getCurrentInstance();
const show = ref(true);
const deleted = ref(false);

const closeModal = () => {
    emit('close');
    show.value = false;
};

const deleteProperty = () => {
    emit('delete');
    deleted.value = true;
};
defineProps({
    code: {
        type: Number,
    }
});
</script>

<style scoped>
    #delete-modal {
        z-index: 9999;
    }
</style>
