<template>
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <Link v-if="!route().current('home')"
                      :href="route('home', user)"
                      class="bg-blue-600 text-white font-bold py-3 px-8 rounded-md shadow-lg hover:bg-blue-700 transition-colors text-base"
                >
                    Spin Again
                </Link>
            </div>
            <nav class="hidden md:flex items-center gap-6">
                <Link :href="route('tokens.store', user)"
                      method="post"
                      :disabled="isDisabled"
                      @click="handleClick"
                      class="text-sm font-medium600"
                      :class="!isDisabled ? 'hover:text-blue-600' : ''"
                >
                    Generate New Link
                </Link>
                <Link :href="route('tokens.destroy', user)"
                      method="delete"
                      class="text-sm font-medium hover:text-blue-600">
                    Deactivate Link
                </Link>
                <Link :href="route('outcomes.index', user)"
                      class="bg-gray-200 hover:bg-gray-300 text-sm font-medium py-2 px-4 rounded-md">
                    History
                </Link>
            </nav>
        </div>
    </header>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {route} from 'ziggy-js'
import {computed, ref} from "vue"
import {usePage} from '@inertiajs/vue3'

const page = usePage<{ user: string }>()

const user = computed(() => page.props.user)
const isDisabled = ref(false)

function handleClick(event: MouseEvent) {
    if (isDisabled.value) {
        event.preventDefault()
        return
    }
    isDisabled.value = true
    setTimeout(() => {
        isDisabled.value = false
    }, 500)
}
</script>
