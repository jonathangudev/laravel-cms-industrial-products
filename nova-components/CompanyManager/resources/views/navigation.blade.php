<router-link tag="h3" :to="{name: 'companies'}" class="cursor-pointer flex items-center font-normal dim text-white mb-6 text-base no-underline">
    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="var(--sidebar-icon)" d="M19 10v6a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2c0-1.1.9-2 2-2v-6a2 2 0 0 1-2-2V7a1 1 0 0 1 .55-.9l8-4a1 1 0 0 1 .9 0l8 4A1 1 0 0 1 21 7v1a2 2 0 0 1-2 2zm-6 0h-2v6h2v-6zm4 0h-2v6h2v-6zm-8 0H7v6h2v-6zM5 7.62V8h14v-.38l-7-3.5-7 3.5zM5 18v2h14v-2H5z"/></svg>
    <span class="sidebar-label">
        Companies
    </span>
</router-link>
<ul class="list-reset mb-8">
    <li class="leading-wide mb-4 text-sm">
        <router-link :to="{name: 'index', params: {resourceName: 'companies'}}" class="text-white ml-8 no-underline dim">
            Manage
        </router-link>
    </li>
</ul>
