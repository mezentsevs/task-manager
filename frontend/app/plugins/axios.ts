import axios from 'axios';

import { applyBearer, retrieveToken } from '~/helpers/TokenHelper';

export default defineNuxtPlugin((): void => {
    axios.defaults.baseURL = '/api';
    applyBearer(retrieveToken());
});
