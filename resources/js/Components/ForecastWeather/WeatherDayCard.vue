<template>
    <div class="flex justify-between items-center mb-3">
        <h4 class="font-bold text-lg text-gray-800 dark:text-white">
            {{ new Date(weatherDay.fecha).toLocaleDateString('es-ES', { weekday: 'short', day: 'numeric', month: 'short' }) }}
        </h4>
        <div class="flex items-center">
            <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">
                {{ weatherDay.temperatura.maxima }}°
            </span>
            <span class="mx-1 text-gray-400">/</span>
            <span class="text-sm text-gray-600 dark:text-gray-400">
                {{ weatherDay.temperatura.minima }}°
            </span>
        </div>
    </div>

    <!-- Weather icon and description -->
    <div class="flex items-center mb-3">
        <img 
            :src="`https://www.aemet.es/imagenes_gcd/_iconos_municipios/${weatherDay.estadoCielo[0].value}.png`" 
            :alt="weatherDay.estadoCielo[0].descripcion"
            class="w-12 h-12"
        />
        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
            {{ weatherDay.estadoCielo[0].descripcion }}
        </span>
    </div>

    <!-- Additional weather info -->
    <div class="grid grid-cols-2 gap-2 text-xs">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
            </svg>
            <span>{{ weatherDay.probPrecipitacion[0].value }}%</span>
        </div>
        
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
            <span>{{ weatherDay.viento[0].direccion }} {{ weatherDay.viento[0].velocidad }} km/h</span>
        </div>
        
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span v-if="weatherDay.uvMax">UV: {{ weatherDay.uvMax }}</span>
        </div>
        
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span>{{ weatherDay.humedadRelativa.minima }}-{{ weatherDay.humedadRelativa.maxima }}%</span>
        </div>
    </div>
</template>
<script setup>
defineProps({
    weatherDay: {
        type: Object,
        required: true
    }
})
</script>