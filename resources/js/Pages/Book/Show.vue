<script setup>
import Main from '@/Layouts/Main.vue';
import {Link} from '@inertiajs/vue3';

defineProps({
    book: {
        type: Object,
    },
});

const href = window.location.origin

</script>

<template>
    <Main>
        <div class="container mx-auto flex-wrap w-full py-8 px-6 mx-auto">
                <div class="grid grid-cols-2 gap-2 place-content-between">
                    <div>
                            <img :src="href + '/' + book.cover" />
                    </div>
                    <div>
                        <p class="">Author</p>
                        <p class="">{{ book.author?.full_name ?? 'Incognita'}}</p>
                        <br>
                        <p class="">Title</p>
                        <p class="">{{ book.name }}</p>
                        <br>
                        <p class="">Year</p>
                        <p class="">{{ book.year }}</p>
                        <br>
                        <p class="">Description</p>
                        <p class="">{{ book.description }}</p>
                        <br>
                        <p class="" v-if="book.sections.length">Sections</p>
                        <p class="" v-for="section in book.sections">{{ section.name }}</p>
                    </div>
                </div>
            <br>
            <Link :href="route('books.index')">&#9668; Back</Link>
        </div>
    </Main>
</template>
