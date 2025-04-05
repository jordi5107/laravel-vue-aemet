<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import Multiselect from 'vue-multiselect'
import axios from 'axios';
import { method } from 'lodash';
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
// Commented out to avoid automatic search when selecting a township
// watch(selectedTownship, (newValue) => {
//     if (newValue) {
//         searchWeather();
//     }
// }, { deep: true });

function searchWeather() {
    console.log('Selected township:', selectedTownship.value);

    // Make API request to get township forecast
    axios.get(`/api/township-forecast/${selectedTownship.value.code}`)
    .then(response => {
        forecastData.value = response.data.forecast;
        console.log('Forecast data:', response.data);
    })
    .catch(error => {
        console.error('Error fetching township forecast:', error);
    });
}

</script>

<template>
    <!-- Login/Register navigation (currently disabled)
    <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Register</Link
                >
            </template>
        </div>
    -->
    <div class="flex flex-col items-center justify-center min-h-screen bg-red-100 dark:bg-gray-900 py-8">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md w-full max-w-md mb-8">
            <h2 class="text-xl text-center font-semibold mb-4 text-gray-800 dark:text-white">Consulta el temps per municipi</h2>
            
            <multiselect 
                v-model="selectedTownship" 
                :options="townships"
                track-by="id"
                label="name"
                placeholder="Selecciona un municipi"
                class="w-full"
                @change="searchWeather"
            >
            </multiselect>
            
        </div>

        <ForecastSection
            v-if="forecastData"
            :forecast-data="forecastData"
            :township="selectedTownship.name"
        />
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>