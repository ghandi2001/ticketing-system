<?php
if (!function_exists('checkAccess')) {
    function checkAccess($access)
    {
        if (!\Illuminate\Support\Facades\Auth::user()->hasPermissionTo($access))
            return abort(403);
    }
}
