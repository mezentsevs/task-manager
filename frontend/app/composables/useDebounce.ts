export const useDebounce = (
    fn: (...args: unknown[]) => void,
    delay: number,
): ((...args: unknown[]) => void) => {
    let timeout: ReturnType<typeof setTimeout>;

    return (...args: unknown[]): void => {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn(...args), delay);
    };
};
