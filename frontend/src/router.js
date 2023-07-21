

//permanent vue js router boilerplate for other projects yummy
import { createRouter, createWebHistory } from 'vue-router';
import CreateBook from '@/components/CreateBook.vue';
import ReadBook from '@/components/ReadBook.vue';
import UpdateBook from '@/components/UpdateBook.vue';
import DestroyBook from '@/components/DestroyBook.vue';
import DisplayBooks from '@/components/DisplayBooks.vue';

const routes = [
    {
        path: '/',
        redirect: '/createabook'
    },
    {
        path: '/createabook',
        name: 'CreateBook',
        component: CreateBook,
    },
    {
        path: '/readabook',
        name: 'ReadBook',
        component: ReadBook,
    },
    {
        path: '/updateabook',
        name: 'UpdateBook',
        component: UpdateBook,
    },
    {
        path: '/destroyabook',
        name: 'DestroyBook',
        component: DestroyBook,
    },
    {
        path: '/displaybooks',
        name: 'DisplayBooks',
        component: DisplayBooks,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
