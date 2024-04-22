<template>
    <div class="flex font-sans bg-white overflow-hidden shadow-lg sm:rounded-lg mt-6">
        <div class="flex-none w-48 relative">
            <img v-if="property.availability_type === 1" src="/images/blank.jpeg" alt="" class="absolute inset-0 w-full h-full object-cover" loading="lazy" />
            <img v-else src="/images/spitogatos-logo.png" alt="" class="absolute inset-0 w-full h-full object-cover" loading="lazy" />
        </div>
        <form class="flex-auto p-6">
            <div class="flex flex-wrap">
                <h1 class="flex-auto text-lg font-semibold text-slate-900">
                    Κωδικός ακινήτου: #{{property.code}}
                </h1>
                <div class="text-lg font-semibold text-slate-500">
                    {{property.price}}€
                </div>
                <div class="w-full flex-none text-md font-semibold text-slate-800 mt-2">
                    {{property.location}}
                </div>
                <div class="w-full flex-none text-sm font-medium text-slate-700 mt-2">
                    {{property.availability}}
                </div>
                <div class="w-full flex-none text-sm font-medium text-slate-700 mt-2">
                    {{property.area_sq}}τ.μ.
                </div>
            </div>
            <div class="flex space-x-4 mb-6 text-sm font-medium justify-end">
                <button @click="openModal" class="flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200" type="button" aria-label="Delete">
                  <svg class="w-[20px] h-[20px] fill-[#8e8e8e]" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"></path>
                  </svg>
                </button>
            </div>
        </form>
<DeleteModal :code="property.code" v-if="showDeleteModal" @close="closeModal" @delete="deleteProperty"></DeleteModal>
    </div>
</template>

<script setup>
import axios from 'axios';
import { defineProps, ref, getCurrentInstance } from 'vue';
import DeleteModal from "@/Components/DeleteModal.vue";

const { emit } = getCurrentInstance();
const props = defineProps({
  property: Object,
});

const showDeleteModal = ref(false);

const openModal = () => {
  showDeleteModal.value = true;
};

const closeModal = () => {
  showDeleteModal.value = false;
};

const deleteProperty = async () => {
  try {
    await axios.delete(`/property/${props.property.id}`);
    emit('propertyDeleted', props.property.id);
  } catch (error) {
    console.error('Error deleting property:', error);
  }
};

</script>
