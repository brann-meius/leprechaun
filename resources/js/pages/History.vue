<template>
    <div class="relative flex min-h-screen flex-col bg-gray-50 overflow-x-hidden font-sans text-gray-900">
        <AppHeader/>

        <main class="flex flex-1 justify-center py-16 px-4">
            <div class="w-full max-w-2xl">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-extrabold tracking-tighter text-gray-900 sm:text-5xl">History</h2>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">Number</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Result</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="outcome in outcomes">
                                <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                                    {{ outcome.number }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm font-medium"
                                    :class="outcome.result === 'Win'
                                        ? 'text-green-600'
                                        : 'text-red-500'">
                                    {{ outcome.result }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold"
                                    :class="outcome.result === 'Win'
                                        ? 'text-green-600'
                                        : 'text-gray-500'">
                                    {{ outcome.amount }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup lang="ts">
import AppHeader from "@/layouts/AppHeader.vue";
import {usePage} from '@inertiajs/vue3'
import {computed} from "vue";
import {Outcome} from "@/types/index.js";

const page = usePage<{ user: string }>()
const outcomes = computed<Outcome[]>(() => page.props.outcomes)
</script>

<style scoped>
</style>
