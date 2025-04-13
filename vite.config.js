import { defineConfig, loadEnv } from "vite";

export default defineConfig(({ mode }) => {
	// Load environment variables from .env
	const env = loadEnv(mode, process.cwd(), "");

	// Fallback to this if not defined in .env
	const devServerUrl = env.WP_SITE_URL;

	// Parse the URL (hostname, port, etc.)
	const url = new URL(devServerUrl);
	const host = url.hostname;
	const port = Number.parseInt(url.port || "3000", 10);

	return {
		root: "assets/js",
		build: {
			outDir: "../../dist",
			assetsDir: ".",
			emptyOutDir: true,
			copyPublicDir: false,
			manifest: true,
			rollupOptions: {
				input: ["assets/js/main.js", "assets/scss/style.scss"],
			},
		},
		// build: {
		//   outDir: '../dist',
		//   emptyOutDir: true
		// },
		server: {
			host,
			port,
			strictPort: true,
		},
	};
});
