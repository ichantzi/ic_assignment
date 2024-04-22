<template>
    <form id="submitForm" @submit.prevent="handleSubmit" class="max-w-sm mx-auto">
        <div v-for="(field, index) in fields" :key="index" class="mb-5">
            <label :for="field.id" class="block mb-2 text-md font-medium text-gray-900 dark:text-black">{{ field.label }}</label>
            <input v-if="field.type === 'text'" :type="field.type" :id="field.id" v-model="field.value" :placeholder="field.placeholder" :required="field.required" class="bg-white border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <select v-else-if="field.type === 'select'" :id="field.id" v-model="field.value" :required="field.required" class="bg-white border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option disabled value="">{{ field.placeholder }}</option>
                <option v-for="(option, optionIndex) in field.options" :key="optionIndex" :value="option.value">{{ option.label }}</option>
            </select>
            <p v-if="field.invalidPrice" class="text-red-500 text-sm mt-1">Αποδεκτές τιμές: 50€-5.000.000€</p>
            <p v-if="field.invalidAreaSq" class="text-red-500 text-sm mt-1">Αποδεκτές τιμές: 20τ.μ.-1000τ.μ.</p>
        </div>
        <button type="submit" style="width: 100%" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-md px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Προσθήκη Ακινήτου</button>
    </form>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup(props, { emit }) {
        const fields = ref([
            { id: 'location', label: 'Περιοχή', type: 'select', placeholder: 'Επιλέξτε την περιοχή', required: true, value: '', options: [] },
            { id: 'price', label: 'Τιμή', type: 'text', placeholder: 'Εισάγετε την τιμή', required: true, value: '' },
            { id: 'availability_type', label: 'Διαθεσιμότητα', type: 'select', placeholder: 'Επιλέξτε την διαθεσιμότητα', required: true, value: '', options: [{ label: 'Ενοικίαση', value: 1 }, { label: 'Πώληση', value: 2 }] },
            { id: 'area_sq', label: 'Τετραγωνικά', type: 'text', placeholder: 'Εισάγετε τα τετραγωνικά', required: true, value: '' },
        ]);

        onMounted(async () => {
            try {
                const response = await axios.get('/location');
                fields.value[0].options = response.data.locations.map(location => ({ label: location.title, value: location.id }));
            } catch (error) {
                console.error('Error fetching locations:', error);
            }
        });

        const handleSubmit = async () => {
            try {
                const isInvalid = validateFormFields();

                if (!isInvalid) {
                    const formData = fields.value.reduce((acc, field) => {
                        acc[field.id] = field.value;
                        return acc;
                    }, {});
                    const response = await axios.post('/property', formData);
                    emit('formSubmittedSuccessfully', true);
                    emit('newPropertyAdded', response.data.properties);
                    document.getElementById("submitForm").reset();

                }
            } catch (error) {
                console.error('Error submitting form:', error);
            }
        };

        const validateFormFields = () => {
            let invalid = false;
            fields.value.forEach(field => {
                if (field.type === 'text') {
                    const value = parseInt(field.value);
                    if (field.id === 'price' && (isNaN(value) || value < 50 || value > 5000000)) {
                        field.invalidPrice = true;
                        invalid = true;
                    } else if (field.id === 'area_sq' && (isNaN(value) || value < 20 || value > 1000)) {
                        field.invalidAreaSq = true;
                        invalid = true;
                    } else {
                        field.invalidPrice = false;
                        field.invalidAreaSq = false;
                    }
                }
            });
            return invalid;
        };

        return {
            fields,
            handleSubmit,
        };
    },
};
</script>
