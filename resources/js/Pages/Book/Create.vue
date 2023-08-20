<script setup>
import Main from '@/Layouts/Main.vue';
import {useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import Checkbox from "@/Components/Checkbox.vue";

defineProps({
    sections: {
        type: Object,
    },

    authors: {
        type: Object,
    }
});

const form = useForm({
    name: '',
    year: '',
    description: '',
    cover: '',
    author_id: '',
    sections: [],
});


function selectItem(item) {
    if (!form.sections[item.id]) {
        form.sections[item.id] = item.id
    } else {
        delete form.sections[item.id]
    }
}

const submit = () => {
    form.post(route('books.store'));
};

</script>

<template>
    <Main>
        <section class="py-8 text-center">
            <div class="container mx-auto w-2/5">

                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div>
                        <InputLabel for="cover" value="Cover"/>

                        <TextInput
                            id="cover"
                            type="file"
                            class="mt-1 block w-full"
                            @input="form.cover = $event.target.files[0]"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.cover"/>
                    </div>

                    <div>
                        <InputLabel for="name" value="Name"/>

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name"/>
                    </div>

                    <div>
                        <InputLabel for="year" value="Year"/>

                        <TextInput
                            id="year"
                            type="tel"
                            min="1800"
                            max="2099"
                            maxlength="4"
                            class="mt-1 block w-full"
                            v-model="form.year"
                            required
                            autofocus
                            autocomplete="year"
                        />

                        <InputError class="mt-2" :message="form.errors.year"/>
                    </div>

                    <div>
                        <InputLabel for="description" value="Description"/>

                        <TextArea
                            id="description"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            rows="10"
                            required
                            autofocus
                            autocomplete="description"
                        />

                        <InputError class="mt-2" :message="form.errors.description"/>
                    </div>

                    <div>
                        <InputLabel for="authors" value="Authors"/>

                        <select class="w-full" size="5" v-model="form.author_id">
                            <option disabled>Choose a Author</option>
                            <option :value="author.id" v-for="author in authors">{{ author.full_name }}</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.author"/>
                    </div>

                    <div>
                        <InputLabel for="sections" value="Sections"/>

                        <div class="block mt-4" v-if="sections.length" v-for="section in sections">
                            <label class="flex items-center">
                                <Checkbox
                                    @change="selectItem(section)"
                                />
                                <span class="ml-2 text-sm text-gray-600">{{ section.name }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </section>
    </Main>
</template>
