module.exports = {
    apps: [
        {
            name: "siakad",
            // run laravel queue worker
            script: "php",
            args: "artisan octane:start --port=3000 --admin-port=3001",
        },
    ],
};
