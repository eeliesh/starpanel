<?php

use App\Models\Admin;

// check if logged in
function isLoggedIn()
{
    return auth()->check();
}

// check if admin
function isAdmin()
{
    if (!isLoggedIn())
        return false;

    $user = Admin::where('user_id', auth()->id())->first();
    return $user ? true : false;
}

// get admin permissions
function getAdminPermissions()
{
    if (!isAdmin())
        return false;
    
    $permissions = [
        'can_add_admin' => false,
        'can_kick' => false,
        'can_ban' => false,
        'can_banip' => false,
        'can_unban' => false,
    ];
    
    $access = Admin::select('access')->where('user_id', auth()->id())->first()['access'];

    switch ($access) {
        case str_contains($access, 'w'): $permissions['can_add_admin'] = true;
        case str_contains($access, 'x'): $permissions['can_kick'] = true;
        case str_contains($access, 's'): $permissions['can_ban'] = true;
        case str_contains($access, 't'): $permissions['can_banip'] = true;
        case str_contains($access, 't'): $permissions['can_unban'] = true;
    }

    return $permissions;
}

// check is admin can add admins
function canAddAdmins()
{
    if (!isLoggedIn() || !isAdmin())
        return false;

    return getAdminPermissions()['can_add_admin'];
}

// check if admin can kick players
function canKick()
{
    if (!isLoggedIn() || !isAdmin())
        return false;

    return getAdminPermissions()['can_kick'];
}

// check if admin can ban players
function canBan()
{
    if (!isLoggedIn() || !isAdmin())
        return false;

    return getAdminPermissions()['can_ban'];
}

// check if admin can ban players by ip
function canBanIp()
{
    if (!isLoggedIn() || !isAdmin())
        return false;

    return getAdminPermissions()['can_banip'];
}

// check if admin can unban players
function canUnban()
{
    if (!isLoggedIn() || !isAdmin())
        return false;

    return getAdminPermissions()['can_unban'];
}

// storage function
function storage($url)
{
    return url('storage/' . $url);
}

// second to hours and minutes
function customTime($seconds)
{
    return gmdate('H', $seconds) . 'h ' . gmdate('i', $seconds) . 'm';
}