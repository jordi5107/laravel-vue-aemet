<template>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md w-full max-w-4xl mx-auto">
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
        
       

        <!-- Loading spinner
        <div v-if="isLoading" class="flex justify-center items-center p-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-700"></div>
        </div>
        
        <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
            {{ error }}
        </div>
         -->
    </div>
</template>
<script setup>
import WeatherDayCard from '@/Components/ForecastWeather/WeatherDayCard.vue';
import ForecastCurrentDay from '@/Components/ForecastWeather/ForecastCurrentDay.vue';
defineProps({
    forecastData: {
        type: Array,
        required: true
    },
    township: {
        type: String,
        required: true
    }
})
</script>