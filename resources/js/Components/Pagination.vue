<script setup>
import {computed} from 'vue';
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    links: {
        type: Object
    },
    search: {
        type: String
    }
})

</script>

<template>
    <div class="flex justify-center">
        <div v-if="links.length > 3">
            <div class="flex flex-wrap-mb-1 text-center">
                <template v-for="(link, p) in links" :key="p">
                    <div v-if="link.url === null"
                         class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                         v-html="link.label"/>
                    <Link v-else
                          class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                          :class="{ 'bg-blue-700 text-white': link.active }"
                          :href="search ? link.url + '&search=' + search : link.url">{{ link.label }}
                    </Link>
                </template>
            </div>
        </div>
    </div>
</template>
