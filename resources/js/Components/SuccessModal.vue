<template>
    <div v-if="show" id="success-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <div>
                <div class="flex items-center justify-center">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Το ακίνητο αποθηκεύτηκε!
                    </h3>
                </div>
                <p class="text-base text-center leading-relaxed text-gray-500 mt-4">
                    Κλείστε το παράθυρο για να δείτε την αναμεωμένη λίστα!
                </p>
                <div class="mt-6 flex justify-center">
                    <button @click="closeModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 mr-3" type="button">Κλείσιμο</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        show: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        closeModal() {
            this.$emit('close');
        }
    }
};
</script>

<style>
#success-modal {
    z-index: 9999;
}
</style>
