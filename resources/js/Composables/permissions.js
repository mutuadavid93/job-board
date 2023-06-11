import { usePage } from "@inertiajs/vue3";

export default function usePermission() {
    const hasRole = (name) => usePage().props.auth.user.roles.includes(name);
    const hasPermission = (name) =>
        usePage().props.auth.user.permissions.includes(name);

    const hasRoles = ($roles) => {
        usePage().props.auth.user.roles.some((name) => $roles.includes(name));
    };

    return { hasRole, hasPermission, hasRoles };
}
