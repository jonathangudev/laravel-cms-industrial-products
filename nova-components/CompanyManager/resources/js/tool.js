Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'companies',
            path: '/companies',
            component: require('./components/Tool'),
        },
    ]);
});
