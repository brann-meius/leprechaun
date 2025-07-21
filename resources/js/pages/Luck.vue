<template>
    <div class="min-h-screen bg-gray-100 font-sans text-gray-900">
        <AppHeader/>

        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="bg-white rounded-2xl shadow p-8 text-center">
                    <h2 class="text-4xl font-extrabold sm:text-5xl lg:text-6xl">Try Your Luck</h2>
                    <div class="mt-8">
                        <button
                            @click="play"
                            :disabled="loading"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-xl font-semibold px-8 py-4 rounded-lg transition-transform transform hover:scale-105">
                            I'm Feeling Lucky
                        </button>
                    </div>

                    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                        <div class="bg-gray-100 rounded-xl p-6">
                            <p class="text-lg font-medium text-gray-500">Your Number</p>
                            <p class="mt-2 text-6xl font-bold text-gray-500">{{ number }}</p>
                        </div>
                        <div class="text-gray-500 rounded-xl p-6"
                             :class="`bg-${color}-100`">
                            <p
                                class="text-lg font-medium"
                                :class="`text-${color}-500`"
                            >Result</p>
                            <p
                                class="mt-2 text-6xl font-bold"
                                :class="`text-${color}-500`"
                            >{{ result }}</p>
                            <p v-if="amount" class="mt-1 text-lg text-green-600">{{ amount }}</p>
                            <p v-else-if="amount === 0" class="mt-1 text-lg text-red-600">:(</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup lang="ts">
import AppHeader from "@/layouts/AppHeader.vue";
import axios from 'axios'
import {computed, ref} from "vue";
import {usePage} from '@inertiajs/vue3'

const number = ref('...')
const result = ref('...')
const amount = ref()
const page = usePage<{ user: string }>()

const user = computed(() => page.props.user)
const loading = ref(false)

const color = computed(() => {
    switch (result.value) {
        case 'Win':
            return 'green'
        case 'Lose':
            return 'red'
        default:
            return 'gray'
    }
})

async function play() {
    if (loading.value) return
    loading.value = true

    try {
        const {data} = await axios.post(`/api/users/${user.value.id}/outcomes`)
        number.value = data.number
        result.value = data.result
        amount.value = data.amount
    } catch (e) {
        console.error('Error:', e)
    } finally {
        loading.value = false
    }
}
</script>
