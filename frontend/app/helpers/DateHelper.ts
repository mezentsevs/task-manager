export const toDateInputFormat = (value: string | null | undefined): string => {
    if (!value) {
        return '';
    }

    return value.substring(0, 10);
};
