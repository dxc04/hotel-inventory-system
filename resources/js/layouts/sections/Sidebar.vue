<template>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                <i class="fas fa-hotel"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ appName }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <router-link class="nav-link" to='/home'>          
                    <i class="fas fa-2x fa-th-large"></i>
                    <span>Dashboard</span>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link class="nav-link" to='/check-rooms'>
                    <i class="fas fa-fw fa-door-open"></i>
                    <span>Check Rooms</span>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link class="nav-link" to='/rooms'>
                    <i class="fas fa-2x fa-fw fa-building"></i>
                    <span>Rooms</span>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link class="nav-link" to='/notes'>
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Notes</span></a>
                </router-link>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
</template>

<script>
    export default {
        name: 'Sidebar',
    }
</script>
