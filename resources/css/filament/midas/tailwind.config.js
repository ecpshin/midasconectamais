import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Midas/**/*.php',
        './resources/views/filament/midas/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
