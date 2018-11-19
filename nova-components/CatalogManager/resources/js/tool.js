Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'catalog',
            path: '/catalog',
            component: require('./components/Tool'),
        },
    ]);
});
