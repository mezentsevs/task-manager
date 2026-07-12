import { defineStore } from 'pinia';
import axios from 'axios';

import { purgeToken } from '~/helpers/TokenHelper';
import type { AuthStateToken, AuthStateUser } from '~/types/AuthTypes';

interface AuthState {
    user: (AuthStateUser & { roles?: string[] }) | null;
    token: AuthStateToken;
}

export const useAuthStore = defineStore('auth', {
    state: (): AuthState => ({
        user: null,
        token: null,
    }),
    actions: {
        async fetchMe(): Promise<void> {
            const response = await axios.get<{ user: AuthStateUser & { roles?: string[] } }>('/me');
            if (response.data?.user) {
                this.user = response.data.user;
            }
        },
        async login(email: string, password: string): Promise<void> {
            const response = await axios.post<{
                token: AuthStateToken;
                user: AuthStateUser & { roles?: string[] };
            }>('/login', { email, password });
            if (response.data?.token && response.data?.user) {
                this.token = response.data.token;
                this.user = response.data.user;
            }
        },
        async register(
            name: string,
            email: string,
            password: string,
            passwordConfirmation: string,
        ): Promise<void> {
            const response = await axios.post<{
                token: AuthStateToken;
                user: AuthStateUser & { roles?: string[] };
            }>('/register', {
                name,
                email,
                password,
                password_confirmation: passwordConfirmation,
            });
            if (response.data?.token && response.data?.user) {
                this.token = response.data.token;
                this.user = response.data.user;
            }
        },
        async logout(): Promise<void> {
            try {
                await axios.post('/logout');
            } catch {
                // ignore error, consider session already closed
            } finally {
                this.token = null;
                this.user = null;
                purgeToken();
            }
        },
    },
});
