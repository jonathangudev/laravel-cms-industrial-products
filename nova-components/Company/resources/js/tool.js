Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'company',
            path: '/company',
            component: require('./components/Tool'),
        },
    ])
})
