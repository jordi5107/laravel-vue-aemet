<template>
    <div v-if="!isLoading" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md w-full max-w-4xl mx-auto">
        <h3 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">
            Predicción meteorológica {{ township }}
        </h3>
        <ForecastCurrentDay 
            v-if="forecastData.length > 0" 
            :forecastData="forecastData" 
        />
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-6">
            <div 
                v-for="(day, index) in forecastData.slice(1)" 
                :key="index" 
                class="bg-blue-50 dark:bg-gray-700 rounded-lg p-4 shadow-sm"
            >
                <WeatherDayCard :weatherDay="day" />
            </div>
        </div>
    </div>
    <div v-if="isLoading" class="flex justify-center items-center p-8">
            <div class="animate-spin rounded-full h-12 w-12 border-b-4 border-t-4 border-blue-700"></div>
            <span class="ml-3 text-gray-700 dark:text-gray-300">Cargando datos...</span>
        </div>
</template>
<script setup>
import WeatherDayCard from '@/Components/ForecastWeather/WeatherDayCard.vue';
import ForecastCurrentDay from '@/Components/ForecastWeather/ForecastCurrentDay.vue';

const props = defineProps({
    forecastData: {
        type: Array,
        required: true
    },
    township: {
        type: String,
        required: true
    },
    isLoading: {
        type: Boolean,
    }
});


</script>