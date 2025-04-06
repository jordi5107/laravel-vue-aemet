<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-red-100 dark:bg-gray-900 py-8">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md w-full max-w-md mb-8">
            <h2 class="text-xl text-center font-semibold mb-4 text-gray-800 dark:text-white">Consulta el tiempo por municipio</h2>
            
            <multiselect 
                v-model="selectedTownship" 
                :options="townships"
                track-by="id"
                label="name"
                placeholder="Selecciona un municipio"
                class="w-full"
                @update:modelValue="searchWeather"
            >
            </multiselect>
            
        </div>

        <ForecastSection
            v-if="forecastData"
            :forecast-data="forecastData"
            :township="selectedTownship.name"
            :is-loading="isLoading"
        />
    </div>
</template>
<script setup>
import { ref, onMounted, watch } from 'vue';
import Multiselect from 'vue-multiselect'
import axios from 'axios';
import ForecastSection from '@/Components/ForecastWeather/ForecastSection.vue';

defineProps({
    townships: Array,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const forecastData = ref(null);
const isLoading = ref(false);
const error = ref(null);

const selectedTownship = ref(null);

function searchWeather() {
    if (!selectedTownship.value) return;
    
    isLoading.value = true;
    error.value = null;
    
    axios.get(`/api/township-forecast/${selectedTownship.value.code}`)
        .then(response => {
            forecastData.value = response.data.forecast;
        })
        .catch(error => {
            console.error('Error fetching township forecast:', error);
            error.value = 'Error al obtener los datos del tiempo';
        })
        .finally(() => {
            isLoading.value = false;
        });
}

</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>