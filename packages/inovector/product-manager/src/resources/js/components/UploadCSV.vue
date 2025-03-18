<template>
    <label class="inline-flex items-center px-4 py-2 mr-3 bg-white border border-gray-300 rounded-lg shadow-sm cursor-pointer hover:bg-gray-50 text-sm font-medium text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v6m0 0l-3-3m3 3l3-3m-6-9h6a2 2 0 012 2v4H6V6a2 2 0 012-2z"/>
        </svg>
        <span>Choose File</span>
        <input type="file" @change="handleCsvUpload" class="hidden" ref="fileInput">
        <div v-if="selectedFile" class="m-2 text-sm text-gray-600">
            {{ selectedFile.name }}
        </div>
        <div v-else class="m-2 text-sm text-gray-500">
            No file selected
        </div>
    </label>
    <button
        @click="submitImport"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow-md font-semibold transition"
    >
        Upload CSV
    </button>
</template>

<script setup>
    import axios from 'axios';
    import { ref } from 'vue';

    const formData = ref(null);
    const selectedFile = ref(null);
    const fileInput = ref(null);

    const handleCsvUpload = async (event) => {
        const file = event.target.files[0];
        
        if (!file || file.type !== 'text/csv'){
            alert('Please upload a valid CSV file.');
            return;
        }
        selectedFile.value = file;
        // Initialize formData and append the file
        formData.value = new FormData();
        formData.value.append('csv_file', file);

        fileInput.value.value = null;
    };
  
    const submitImport = async () => {
        if (!formData.value) {
            alert('No file selected.');
            return;
        }
        try {
            const response = await axios.post('/product-manager/import', formData.value, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            selectedFile.value = null;
            alert('CSV upload started. You’ll get a notification when done.')
        } catch (error) {
            console.error(error);
            alert('There was an error uploading the file.')
        }
    };
</script>