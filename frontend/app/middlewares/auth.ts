import { retrieveToken } from '~/helpers/TokenHelper';

export default defineNuxtRouteMiddleware(() => {
    const token = retrieveToken();

    if (!token) {
        return navigateTo('/login');
    }
});
