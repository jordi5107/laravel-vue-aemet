<template>
    <div v-if="forecastData.length > 0 && forecastData[0].temperatura.dato.length > 0" class="mt-8 p-4 bg-blue-50 dark:bg-gray-700 rounded-lg">
        <h4 class="font-bold mb-3 text-gray-800 dark:text-white">Detalle del día</h4>
        <div class="grid grid-cols-4 gap-2">
            <div v-for="(item, idx) in forecastData[0].temperatura.dato" :key="idx" class="text-center">
                <div class="text-sm text-gray-600 dark:text-gray-400">{{ item.hora }}:00</div>
                <div class="font-bold text-blue-700 dark:text-blue-300">{{ item.value }}°</div>
                <div class="text-xs text-gray-500">
                    {{ forecastData[0].humedadRelativa.dato[idx]?.value }}% hum
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
defineProps({
    forecastData: {
        type: Array,
        required: true
    }
})
</script>