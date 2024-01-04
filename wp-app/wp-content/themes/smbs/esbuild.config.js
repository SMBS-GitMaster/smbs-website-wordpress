const esbuild = require('esbuild');
const sassPlugin = require('esbuild-sass-plugin');

// Configuración común para ambas, la construcción y el modo watch
const commonConfig = {
  entryPoints: ['./assets/scss/main.scss'],
  bundle: true,
  outfile: './assets/css/main.css',
  plugins: [sassPlugin.sassPlugin()],
  minify: process.env.NODE_ENV === 'production',
  sourcemap: process.env.NODE_ENV !== 'production',
};

// Función para manejar la reconstrucción en modo watch
const startWatchMode = () => {
  return esbuild.build({
    ...commonConfig,
    watch: {
      onRebuild(error) {
        if (error) console.error('watch build failed:', error);
        else console.log('watch build succeeded');
      },
    },
  });
};

// Determina si se incluyó la opción --watch
const isWatchMode = process.argv.includes('--watch');

// Iniciar esbuild en modo watch o construcción normal
isWatchMode ? startWatchMode() : esbuild.build(commonConfig).catch(() => process.exit(1));
