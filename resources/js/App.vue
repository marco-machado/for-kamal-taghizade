<script setup>
import axios from 'axios';
import { ref } from 'vue';

let items = ref([]);
let name = ref('');
let description = ref('');
let file = ref(null);
let type = ref(1);
let selected = ref({});

const getItems = () => axios.get('/api/items').then(({data}) => {
    items.value = data.data;
});

const viewItem = (id) => axios.get(`/api/items/${id}`).then(({data}) => {
    selected.value = data;
});

</script>

<template>
    <div class="flex flex-col h-screen p-6">
        <div id="list">
            <h2>List
                <button @click="getItems">Fetch</button>
            </h2>

            <ul v-if="items">
                <li v-for="item in items" :key="item.id">
                    {{ item.name }}
                    <button @click="viewItem(item.id)">View</button>
                </li>
            </ul>

            <ul v-if="selected" class="pt-6">
                <li>{{ selected.name }}</li>
                <li>{{ selected.description }}</li>
                <li><a :href="selected.temporary_url" target="_blank">{{ selected.temporary_url }}</a></li>
                <li>{{ selected.type }}</li>
            </ul>
        </div>

        <div id="create" class="pt-6 flex flex-col">
            <h2>Create</h2>

            <form @submit.prevent="createItem">
                <div class="flex flex-col max-w-xl">
                    <input v-model="name" placeholder="Name" type="text"/>
                    <input v-model="description" placeholder="Description" type="text"/>
                    <input placeholder="File" type="file"/>
                    <input v-model="type" placeholder="Type" type="number"/>
                    <button type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</template>
