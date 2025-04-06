<template>
    <div v-if="forecastData.length > 0 && forecastData[0].temperatura.dato.length > 0" class="mt-8 p-6 bg-blue-50 dark:bg-gray-700 rounded-lg shadow-md">
        <h3 class="font-bold mb-4 text-xl text-gray-800 dark:text-white border-b pb-2 dark:border-gray-600">Previsión actual</h3>
        
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
            <div v-for="(item, idx) in forecastData[0].temperatura.dato" :key="idx" 
                 class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg transition-transform hover:scale-105 shadow-sm">
                <div class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ item.hora }}:00</div>
                <div class="font-bold text-2xl text-blue-700 dark:text-blue-300">{{ item.value }}°</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    <span class="flex items-center justify-center gap-1">
                        <span>{{ forecastData[0].humedadRelativa.dato[idx]?.value }}%</span>
                        <span>humedad</span>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="mt-6">
            <h5 class="font-semibold mb-3 text-lg text-gray-700 dark:text-gray-300 border-b pb-2 dark:border-gray-600">Estado del cielo</h5>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div v-for="(estadoItem, idx) in filteredEstadoCielo" :key="idx" 
                     class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg transition-transform hover:scale-105 shadow-sm">
                    <div class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ estadoItem.periodo }}h</div>
                    <img 
                        :src="`https://www.aemet.es/imagenes_gcd/_iconos_municipios/${estadoItem.value}.png`" 
                        :alt="estadoItem.descripcion"
                        class="w-12 h-12 mx-auto my-2"
                    />
                    <div class="text-xs text-gray-600 dark:text-gray-400">{{ estadoItem.descripcion }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    forecastData: {
        type: Array,
        required: true
    }
})

import { computed } from 'vue';

const filteredEstadoCielo = computed(() => {

    const currentHour = new Date().getHours();
    
    return props.forecastData[0].estadoCielo
        .filter(item => {
            if (!item.value) return false;
            
            const periodParts = item.periodo.split('-');
            if (periodParts.length !== 2) return false;
            
            const startHour = parseInt(periodParts[0]);
            const endHour = parseInt(periodParts[1]);
            
            let periodLength = endHour - startHour;
            if (periodLength < 0) {
            periodLength += 24;
            }
            
            if (periodLength !== 6) return false;
            
            return (currentHour >= startHour && currentHour <= endHour) || startHour > currentHour;
        });
       
});
</script>