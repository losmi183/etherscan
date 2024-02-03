<template>
    <v-layout>
        <component :is="$route.meta.layout || 'div'">
            <router-view />
        </component>
        <!-- SNACKBAR START -->
        <v-snackbar app v-model="store.alert.show" :color="store.alert.type" variant="tonal" :timeout="5000">
            <v-alert
                :type="store.alert.type"
                prominent
                border
                >
            {{ store.alert.message }}
            </v-alert>
        </v-snackbar>
    </v-layout>
</template>
<script setup>
    import { RouterView } from "vue-router";
    
    const store = useAppStore()
</script>

