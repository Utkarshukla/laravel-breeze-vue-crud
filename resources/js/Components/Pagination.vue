<script setup>
import { router, usePage } from '@inertiajs/vue3';

defineProps({
    data:{
        type:Object,
        required:true
    } 
});
const updatePageNo=(link)=>{
    let pageNo= link.url.split('=')[1];
    router.visit('?page='+pageNo,{
        preserveScroll:true
    })
}
</script>
<template>
    <div>
        <span> {{data.from}}</span> to 
        <span>{{data.to}}</span> in total
        <span>{{data.total}}</span>
    </div>
    <div>
        <button v-for="(link, index) in data.links" :key="index" :disabled="link.active || !link.url" @click="updatePageNo(link)" class=" p-1" :class="{'bg-slate-400:':link.active, 'bg-slate-600':!link.active}">
            <span v-html="link.label"></span>
        </button>
    </div>
</template>