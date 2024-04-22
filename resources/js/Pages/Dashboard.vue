<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PropertyAddForm from "@/Components/PropertyAddForm.vue";
import SuccessModal from "@/Components/SuccessModal.vue";
import PropertyListItem from "@/Components/PropertyListItem.vue";

const { props } = usePage();

const properties = ref([]);

onMounted(() => {
    console.log('Fetched properties:', props.properties);
    properties.value = props.properties;
});

const showSuccessModal = ref(false);

const handleFormSubmittedSuccessfully = (value) => {
    showSuccessModal.value = value;
};

const handleNewPropertyAdded = (updatedProperties) => {
    properties.value = updatedProperties;
};

const handlePropertyDeleted = (deletedPropertyId) => {
    properties.value = properties.value.filter(property => property.id !== deletedPropertyId);
};

</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="p-6 flex-none w-140 text-xl text-center font-bold text-slate-900">
                        Σύστημα διαχείρισης αγγελιών. Καλώς ήρθες {{ $page.props.auth.user.name }}
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row justify-between">
                    <div class="sm:w-2/5">
                        <div class="p-6 flex-none w-140 text-xl text-center font-bold text-slate-900">
                            Προσθέστε ένα νέο ακίνητο
                        </div>
                        <PropertyAddForm @formSubmittedSuccessfully="handleFormSubmittedSuccessfully" @newPropertyAdded="handleNewPropertyAdded"></PropertyAddForm>
                        <SuccessModal :show="showSuccessModal" @close="showSuccessModal = false"></SuccessModal>
                    </div>
                    <div class="sm:w-3/5 mt-5 sm:mt-0">
                        <template class="flex-col" v-for="property in properties" :key="property.id">
                            <PropertyListItem :property="property" @propertyDeleted="handlePropertyDeleted"></PropertyListItem>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
