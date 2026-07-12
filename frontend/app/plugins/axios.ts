import { applyBearer, purgeToken, retrieveToken } from '~/helpers/TokenHelper';
import axios from 'axios';

export default defineNuxtPlugin(() => {
    axios.defaults.baseURL = '/api';
    applyBearer(retrieveToken());

    axios.interceptors.response.use(
        response => response,
        error => {
            if (error.response?.status === 401) {
                purgeToken();
                window.location.href = '/login';
            }
            return Promise.reject(error);
        },
    );
});
