import { retrieveToken } from '~/helpers/TokenHelper';

export default defineNuxtRouteMiddleware(to => {
    const publicPaths = ['/login', '/register'];
    const token = retrieveToken();

    if (!token && !publicPaths.includes(to.path)) {
        return navigateTo('/login');
    }

    if (token && publicPaths.includes(to.path)) {
        return navigateTo('/');
    }
});
