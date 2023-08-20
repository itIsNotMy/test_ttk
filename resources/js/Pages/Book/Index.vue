<script setup>
import Main from '@/Layouts/Main.vue';
import {Link, useForm} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    books: {
        type: Object,
    },
    user: {
        type: Object,
    },
    search: {
        type: String,
    }
});

const form = useForm( {
    search: props.search,
});

const submit = () => {
    form.get(route('books.index', form.search));
};

const href = window.location.origin

</script>

<template>
    <Main>
        <section class="bg-white py-8">
            <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
                <nav id="store" class="w-full z-30 top-0 px-6 py-1">

                    <form @submit.prevent="submit">
                        <label for="default-search"
                               class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <TextInput
                                type="search"
                                id="default-search"
                                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search Mockups, Logos..."
                                v-model="form.search"
                                autofocus
                                autocomplete="name"
                            />
                            <button
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Search
                            </button>
                        </div>
                    </form>
                </nav>
                <div class="w-full z-30 top-0 px-6 py-1">
                    <Link :href="route('books.create')">&#9998; Register a book</Link>
                </div>
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col" v-for="book in books.data">
                    <div>
                        <Link :href="route('books.show', book.id)">
                            <img :src="href + '/' + book.cover" />
                        </Link>
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">{{ book.name }}</p>
                            <p class="">{{ book.year }}</p>
                        </div>
                        <Link v-if="user?.id === book.user_id" :href="route('books.edit', book.id)">
                            &#128269; Show
                        </Link>
                    </div>
                </div>
            </div>
        </section>
        <pagination class="mt-6" :links="books.links" :search="form.search"/>
    </Main>
</template>
