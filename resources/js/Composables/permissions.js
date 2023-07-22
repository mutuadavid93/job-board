import { usePage } from "@inertiajs/vue3";

export default function usePermission() {
    const $user = usePage().props.auth.user;
    const hasRole = (name) => usePage().props.auth.user.roles.includes(name);
    const hasPermission = (name) => {
        if ($user) {
            return $user.permissions.some(
                (permission) => permission.name === name
            );
        }
        return $user; // it's null
    };

    const hasRoles = ($roles) => {
        usePage().props.auth.user.roles.some((name) => $roles.includes(name));
    };

    return { hasRole, hasPermission, hasRoles };
}
