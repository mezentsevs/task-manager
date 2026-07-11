export interface User {
    id: number;
    name: string;
    email: string;
    created_at: string;
    updated_at: string;
}

export type AuthStateToken = string | null;
export type AuthStateUser = User | null;

export interface AuthLoginForm {
    email: string;
    password: string;
}

export interface AuthRegisterForm {
    name: string;
    email: string;
    password: string;
    passwordConfirmation: string;
}
