Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'contact-settings-manager',
            path: '/contact-settings-manager',
            component: require('./components/Tool'),
        },
    ])
})
