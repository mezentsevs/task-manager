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
            const response = await axios.get<{ user: AuthStateUser & { roles?: string[] } }>(
                '/user',
            );
            if (response.data?.user) {
                this.user = response.data.user;
            }
        },
        async login(email: string, password: string): Promise<void> {
            try {
                const response = await axios.post<{
                    token: AuthStateToken;
                    user: AuthStateUser & { roles?: string[] };
                }>('/auth/login', { email, password });
                if (response.data?.token && response.data?.user) {
                    this.token = response.data.token;
                    this.user = response.data.user;
                }
            } catch (err) {
                if (axios.isAxiosError(err) && err.response?.data?.message) {
                    throw new Error(err.response.data.message);
                }
                throw new Error('Login failed');
            }
        },
        async register(
            name: string,
            email: string,
            password: string,
            passwordConfirmation: string,
        ): Promise<void> {
            try {
                const response = await axios.post<{
                    token: AuthStateToken;
                    user: AuthStateUser & { roles?: string[] };
                }>('/auth/register', {
                    name,
                    email,
                    password,
                    password_confirmation: passwordConfirmation,
                });
                if (response.data?.token && response.data?.user) {
                    this.token = response.data.token;
                    this.user = response.data.user;
                }
            } catch (err) {
                if (axios.isAxiosError(err) && err.response?.data?.message) {
                    throw new Error(err.response.data.message);
                }
                throw new Error('Registration failed');
            }
        },
        async logout(): Promise<void> {
            try {
                await axios.post('/auth/logout');
            } catch {
            } finally {
                this.token = null;
                this.user = null;
                purgeToken();
            }
        },
    },
});
