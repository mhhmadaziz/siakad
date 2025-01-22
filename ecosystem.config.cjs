module.exports = {
    apps: [
        {
            name: "siakad",
            // run laravel queue worker
            script: "php",
            args: "artisan octane:start",
        },
    ],
};
