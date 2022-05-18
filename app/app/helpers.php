<?php
if (!function_exists('checkAccess')) {
    function checkAccess($access)
    {
        if (!\Illuminate\Support\Facades\Auth::user()->hasPermissionTo($access))
            return abort(403);
    }
}

if (!function_exists('checkAnyAccessToTemplate')) {
    function checkAnyAccessToTemplate($permissions): bool
    {
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if (\Illuminate\Support\Facades\Auth::user()->hasPermissionTo($permission)) {
                    return true;
                }
            }
        } else {
            if (\Illuminate\Support\Facades\Auth::user()->hasPermissionTo($permissions)) {
                return true;
            }
        }
        return false;
    }
}
