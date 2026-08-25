<!DOCTYPE html>

<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title','Italian Resturant')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-lowest": "#ffffff",
                        "outline": "#867461",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "inverse-surface": "#2d3133",
                        "on-secondary-container": "#662000",
                        "tertiary-fixed-dim": "#c8c6c9",
                        "primary-container": "#f59e0b",
                        "surface-bright": "#f7f9fb",
                        "primary": "#855300",
                        "secondary-fixed-dim": "#ffb599",
                        "on-tertiary-fixed-variant": "#474649",
                        "inverse-primary": "#ffb95f",
                        "outline-variant": "#d8c3ad",
                        "tertiary-fixed": "#e4e1e5",
                        "on-surface-variant": "#534434",
                        "secondary-fixed": "#ffdbce",
                        "primary-fixed": "#ffddb8",
                        "on-primary-container": "#613b00",
                        "surface-variant": "#e0e3e5",
                        "on-surface": "#191c1e",
                        "inverse-on-surface": "#eff1f3",
                        "surface-dim": "#d8dadc",
                        "surface-container": "#eceef0",
                        "on-primary-fixed": "#2a1700",
                        "error": "#ba1a1a",
                        "background": "#f7f9fb",
                        "on-secondary-fixed-variant": "#802a00",
                        "on-secondary": "#ffffff",
                        "secondary": "#a73a00",
                        "surface-container-highest": "#e0e3e5",
                        "surface-container-low": "#f2f4f6",
                        "tertiary-container": "#b2b0b3",
                        "outline-warm": "#867461",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#444346",
                        "primary-fixed-dim": "#ffb95f",
                        "on-tertiary-fixed": "#1b1b1e",
                        "surface-tint": "#855300",
                        "secondary-container": "#ff7941",
                        "tertiary": "#5f5e61",
                        "surface": "#f7f9fb",
                        "on-error-container": "#93000a",
                        "on-background": "#191c1e",
                        "on-secondary-fixed": "#370e00",
                        "on-primary-fixed-variant": "#653e00",
                        "surface-container-high": "#e6e8ea",
                        "on-tertiary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "section-gap": "100px",
                        "margin-desktop": "auto",
                        "max-width": "1280px",
                        "unit-base": "8px",
                        "element-gap": "24px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "label-lg": [
                            "IBM Plex Sans"
                        ],
                        "headline-xl": [
                            "IBM Plex Sans"
                        ],
                        "display-lg": [
                            "IBM Plex Sans"
                        ],
                        "display-hero": [
                            "IBM Plex Sans"
                        ],
                        "body-lg": [
                            "Inter"
                        ],
                        "body-md": [
                            "Inter"
                        ],
                        "display-lg-mobile": [
                            "IBM Plex Sans"
                        ],
                        "headline-md": [
                            "IBM Plex Sans"
                        ],
                        "label-sm": [
                            "IBM Plex Sans"
                        ]
                    },
                    "fontSize": {
                        "label-lg": [
                            "16px",
                            {
                                "lineHeight": "20px",
                                "letterSpacing": "0.02em",
                                "fontWeight": "600"
                            }
                        ],
                        "headline-xl": [
                            "40px",
                            {
                                "lineHeight": "48px",
                                "fontWeight": "600"
                            }
                        ],
                        "display-lg": [
                            "56px",
                            {
                                "lineHeight": "64px",
                                "letterSpacing": "-0.02em",
                                "fontWeight": "700"
                            }
                        ],
                        "display-hero": [
                            "80px",
                            {
                                "lineHeight": "96px",
                                "letterSpacing": "-0.03em",
                                "fontWeight": "800"
                            }
                        ],
                        "body-lg": [
                            "18px",
                            {
                                "lineHeight": "28px",
                                "fontWeight": "400"
                            }
                        ],
                        "body-md": [
                            "16px",
                            {
                                "lineHeight": "24px",
                                "fontWeight": "400"
                            }
                        ],
                        "display-lg-mobile": [
                            "32px",
                            {
                                "lineHeight": "40px",
                                "fontWeight": "700"
                            }
                        ],
                        "headline-md": [
                            "24px",
                            {
                                "lineHeight": "32px",
                                "fontWeight": "600"
                            }
                        ],
                        "label-sm": [
                            "14px",
                            {
                                "lineHeight": "16px",
                                "letterSpacing": "0.05em",
                                "fontWeight": "500"
                            }
                        ]
                    },
                    "animation": {
                        "fade-in-up": "fadeInUp 0.8s ease-out forwards"
                    },
                    "keyframes": {
                        "fadeInUp": {
                            "0%": {
                                opacity: "0",
                                transform: "translateY(20px)"
                            },
                            "100%": {
                                opacity: "1",
                                transform: "translateY(0)"
                            }
                        }
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #f7f9fb;
        }

        .animate-fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }
    </style>
    @stack('style')
    @stack()('headScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</head>

<body
    class="font-body-md text-body-md text-on-surface antialiased bg-background selection:bg-primary-container selection:text-on-primary-container min-h-screen flex flex-col">
    <!-- TopNavBar -->
    <nav class="docked full-width top-0 sticky border-b border-outline-variant/30 flat no shadows bg-white/70 dark:bg-inverse-surface/70 backdrop-blur-lg z-50 transition-all duration-300"
        id="top-nav">
        <div class="flex justify-between items-center h-20 px-8 max-w-[1280px] mx-auto w-full">
            <div class="flex items-center gap-8">
                <a class="text-headline-md font-headline-md font-bold text-primary dark:text-inverse-primary tracking-tight"
                    href="#">Modern Gastronomy</a>
            </div>
            <div class="hidden md:flex items-center gap-6">
                <a class="font-label-lg text-label-lg text-primary font-bold border-b-2 border-primary pb-1 active"
                    href="#">Menu</a>
                <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-primary transition-colors duration-200"
                    href="#">Catering</a>
                <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-primary transition-colors duration-200"
                    href="#">Rewards</a>
                <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-primary transition-colors duration-200"
                    href="#">Locations</a>
            </div>
            <div class="flex items-center gap-4">
                <button aria-label="language"
                    class="text-on-surface-variant hover:text-primary transition-colors duration-200 hover:scale-[1.02]">
                    <span class="material-symbols-outlined">language</span>
                </button>
                <button aria-label="location_on"
                    class="text-on-surface-variant hover:text-primary transition-colors duration-200 hover:scale-[1.02]">
                    <span class="material-symbols-outlined">location_on</span>
                </button>
                <button
                    class="hidden md:flex items-center gap-2 font-label-lg text-label-lg text-on-surface-variant hover:text-primary transition-colors duration-200 border border-outline-variant rounded-full px-4 py-2 hover:bg-surface-variant/20 hover:scale-[1.02]">
                    Login
                </button>
                <button
                    class="flex items-center gap-2 bg-[#f59e0b] text-white font-label-lg text-label-lg rounded-full px-6 py-2 hover:bg-[#d98b09] transition-colors duration-200 hover:scale-[1.02] shadow-sm">
                    Cart
                </button>
            </div>
        </div>
    </nav>
    <main class="flex-grow flex flex-col items-center w-full">
        <!-- Hero Section -->
        <section
            class="w-full relative h-[819px] min-h-[600px] flex items-center justify-center overflow-hidden bg-black animate-fade-in-up">
            <div class="absolute inset-0 z-0">
                <div class="w-full h-full bg-cover bg-center bg-no-repeat absolute inset-0 object-cover opacity-90"
                    data-alt="High-end, professional food photography of a gourmet wagyu beef burger with melting cheese, caramelized onions, and fresh arugula on a toasted brioche bun. Close-up, shallow depth of field, warm cinematic lighting, dark slate background. Extremely appetizing and premium quality."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDSjTvkVlkp_XLXRfa5uoc3OmN96oL7-DYUa7YojWDrAjnPAbkoAfTdfMZmZtt2UeB6Q6OfOQrHp4bJKCYiv39Zx58KTbslRlL2cDE-hoxOGlcvSo8DWeAl_fOLCPH2OTd6zn1izXJyS_uSt50yM_SUqgMINz146IZ2a3vAbhHnPHFlmg5AI9V_vGgKObIyOZamllc2dKCiaLUItSCcAZkWS4xftKglCVklX_4CfKD2LYREvhOSTnm8HQ')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/50 to-transparent"></div>
            </div>
            <div
                class="relative z-10 w-full max-w-[1280px] px-8 mx-auto flex flex-col md:flex-row items-center gap-gutter">
                <div class="max-w-2xl text-left md:text-left flex flex-col gap-6">
                    <h1 class="font-display-hero text-display-hero text-white tracking-tight font-extrabold drop-shadow-lg"
                        dir="auto">
                        Elevate Your<br />
                        <span class="text-[#f59e0b] font-extrabold">Appetite</span>
                    </h1>
                    <p class="font-body-lg text-body-lg text-gray-200 max-w-xl drop-shadow-md">
                        Experience the perfect blend of culinary heritage and modern precision. Crafted with passion,
                        delivered with speed.
                    </p>
                    <div class="flex flex-wrap gap-4 mt-4">
                        <button
                            class="bg-[#f59e0b] text-white font-label-lg text-label-lg rounded-full px-8 py-4 hover:bg-[#d98b09] hover:scale-[1.05] transition-all duration-300 shadow-lg">
                            Order Now
                        </button>
                        <button
                            class="bg-transparent text-white font-label-lg text-label-lg rounded-full px-8 py-4 border-2 border-white/60 hover:bg-white/10 hover:scale-[1.05] transition-all duration-300">
                            View Menu
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Featured Categories Bento Grid -->
        <section class="w-full max-w-[1280px] mx-auto px-8 py-24 flex flex-col gap-16 animate-fade-in-up delay-100">
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="font-headline-xl text-headline-xl text-on-surface mb-2">Explore Categories</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Discover our meticulously curated
                        selection.</p>
                </div>
                <button
                    class="text-[#f59e0b] font-label-lg text-label-lg hover:underline decoration-[#f59e0b] underline-offset-4 flex items-center gap-1 transition-all duration-200 hover:gap-2">
                    See All <span class="material-symbols-outlined"
                        style="font-variation-settings: 'FILL' 0;">arrow_forward</span>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter auto-rows-[320px]">
                <!-- Burgers (Large) -->
                <div
                    class="group relative md:col-span-2 md:row-span-2 rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-outline-variant/30 bg-surface">
                    <div class="w-full h-full bg-cover bg-center absolute inset-0 group-hover:scale-110 transition-transform duration-700"
                        data-alt="High-end, professional food photography of a gourmet wagyu beef burger with melting cheese, caramelized onions, and fresh arugula on a toasted brioche bun. Close-up, shallow depth of field, warm cinematic lighting, dark slate background. Extremely appetizing and premium quality."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDSjTvkVlkp_XLXRfa5uoc3OmN96oL7-DYUa7YojWDrAjnPAbkoAfTdfMZmZtt2UeB6Q6OfOQrHp4bJKCYiv39Zx58KTbslRlL2cDE-hoxOGlcvSo8DWeAl_fOLCPH2OTd6zn1izXJyS_uSt50yM_SUqgMINz146IZ2a3vAbhHnPHFlmg5AI9V_vGgKObIyOZamllc2dKCiaLUItSCcAZkWS4xftKglCVklX_4CfKD2LYREvhOSTnm8HQ')">
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="absolute bottom-0 left-0 p-10 flex flex-col gap-3">
                        <div
                            class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mb-2">
                            <span class="material-symbols-outlined text-[#f59e0b] text-2xl"
                                style="font-variation-settings: 'FILL' 1;">lunch_dining</span>
                        </div>
                        <h3 class="font-headline-xl text-headline-xl text-white">Burgers</h3>
                        <p class="font-body-md text-body-md text-gray-200">Our signature smashed patties.</p>
                    </div>
                </div>
                <!-- Pizza -->
                <div
                    class="group relative rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-outline-variant/30 bg-surface">
                    <div class="w-full h-full bg-cover bg-center absolute inset-0 group-hover:scale-110 transition-transform duration-700"
                        data-alt="Close-up photo of a gourmet artisan pizza with bubbling mozzarella, fresh basil, and sun-dried tomatoes being sliced, steam rising, wood-fired oven in the background. Warm, rich colors."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDzDqz82p6sBt2kFygNv479fnmFx6zF8Lh1nhV3gRZ_xlZju-f9GNm-RkFlxF8G9ceOtTNiDlWMubs2jKfipjkCerq8-YRfSBncuY24tHDO0NjUXAjMCdR_UgfNWusQs37zSGUqVm4S-HR1yebePK1mlutMbLR0ig7eeefRCTp5YRPSghWpIHa99cPzWn_5GQj9i9HEmDxouw6UZwLfyK4JFZ5krszyamlIyWaDENOHAqxNyZiow66Kwg')">
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="absolute bottom-0 left-0 p-8 flex flex-col gap-2">
                        <div
                            class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mb-1">
                            <span class="material-symbols-outlined text-[#f59e0b] text-xl"
                                style="font-variation-settings: 'FILL' 1;">local_pizza</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-white">Artisan Pizza</h3>
                    </div>
                </div>
                <!-- Sides -->
                <div
                    class="group relative rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-outline-variant/30 bg-surface">
                    <div class="w-full h-full bg-cover bg-center absolute inset-0 group-hover:scale-110 transition-transform duration-700"
                        data-alt="Gourmet truffle fries with parmesan shavings and a side of creamy garlic aioli. Elegant plating on a marble surface. Soft natural lighting."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB5pj7aU2uX3PHJi7jQlQzr5kg01SE5XebxPDqJ5nmqOomXt1hQxZamyRGKtmlQ5cCWCvxuXQR63SxLODrxkkoRokEDGCCi0_BYgbdEzgmWq_-AbymZDKOaVN6VR1JXaZOo9ld7TRIlXPrKFVIQJBt5lmpRmDHp4UC6UmlTTxATRoEgstWaEOFsLsN3q0DnhOW2ZnQ5Hy1N8DnQPoPfficYLs4qQueB-FoDiwsiEkXTuqsztYtyOBquhw')">
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="absolute bottom-0 left-0 p-8 flex flex-col gap-2">
                        <div
                            class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mb-1">
                            <span class="material-symbols-outlined text-[#f59e0b] text-xl"
                                style="font-variation-settings: 'FILL' 1;">restaurant_menu</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-white">Elevated Sides</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- Chef's Specials -->
        <section class="w-full max-w-[1280px] mx-auto px-8 pb-24 flex flex-col gap-8 animate-fade-in-up delay-200">
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="font-headline-xl text-headline-xl text-on-surface mb-2">Chef's Specials</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Exclusive seasonal offerings.</p>
                </div>
            </div>
            <div
                class="relative w-full h-[500px] rounded-3xl overflow-hidden shadow-2xl flex items-center border border-outline-variant/20 bg-black/80 group">
                <!-- WebGL Canvas for Shader Background -->
                <canvas
                    class="absolute inset-0 w-full h-full opacity-60 pointer-events-none mix-blend-screen transition-opacity duration-500 group-hover:opacity-80"
                    id="smokeCanvas"></canvas>
                <div
                    class="relative z-10 p-12 md:p-16 flex flex-col md:flex-row items-center w-full justify-between gap-12">
                    <div class="flex flex-col gap-6 max-w-xl text-white">
                        <div class="flex items-center gap-3">
                            <span
                                class="bg-[#f59e0b] text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Must
                                Try</span>
                            <span class="text-white/70 font-body-md text-sm">Limited Time</span>
                        </div>
                        <h3 class="font-display-lg text-display-lg-mobile md:text-display-lg leading-tight font-bold">
                            Signature Smoked Brisket
                        </h3>
                        <p class="font-body-lg text-body-lg text-gray-300">
                            Slow-smoked for 14 hours over hickory wood, creating a melt-in-your-mouth experience with a
                            perfect bark. Served with our house-made bourbon BBQ glaze.
                        </p>
                        <div class="flex items-center gap-6 mt-4">
                            <span class="font-headline-xl text-headline-xl font-bold text-[#f59e0b]">$32.00</span>
                            <button
                                class="bg-white text-black font-label-lg text-label-lg rounded-full px-8 py-3 hover:bg-gray-200 hover:scale-[1.05] transition-all duration-300 shadow-md">
                                Order Now
                            </button>
                        </div>
                    </div>
                    <div
                        class="hidden md:block w-64 h-64 rounded-full border-4 border-white/10 flex items-center justify-center bg-black/40 backdrop-blur-sm relative">
                        <span class="material-symbols-outlined text-8xl text-white/50"
                            style="font-variation-settings: 'FILL' 1;">outdoor_grill</span>
                        <div
                            class="absolute inset-0 rounded-full border border-[#f59e0b]/30 animate-[spin_10s_linear_infinite]">
                        </div>
                        <div
                            class="absolute inset-2 rounded-full border border-white/20 animate-[spin_15s_linear_infinite_reverse]">
                        </div>
                    </div>
                </div>
                <!-- Gradient Overlay for readability -->
                <div
                    class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent pointer-events-none">
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer
        class="w-full py-24 bg-surface-container-highest dark:bg-inverse-surface border-t border-outline-variant mt-10 animate-fade-in-up delay-300">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter max-w-[1280px] mx-auto px-8">
            <div class="col-span-1 md:col-span-2 flex flex-col gap-4">
                <span class="text-headline-md font-headline-md font-bold text-on-surface">Modern Gastronomy</span>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-sm">
                    Crafting culinary excellence with every order. Experience the amber glow of true modern gastronomy.
                </p>
                <p class="font-body-md text-body-md text-on-surface-variant mt-4">
                    © 2024 Modern Gastronomy. All rights reserved.
                </p>
            </div>
            <div class="flex flex-col gap-4">
                <h4 class="font-label-lg text-label-lg text-on-surface font-bold mb-2">Company</h4>
                <a class="font-body-md text-body-md text-on-surface-variant hover:text-[#f59e0b] transition-all duration-300"
                    href="#">Our Story</a>
                <a class="font-body-md text-body-md text-on-surface-variant hover:text-[#f59e0b] transition-all duration-300"
                    href="#">Careers</a>
                <a class="font-body-md text-body-md text-on-surface-variant hover:text-[#f59e0b] transition-all duration-300"
                    href="#">Contact Us</a>
            </div>
            <div class="flex flex-col gap-4">
                <h4 class="font-label-lg text-label-lg text-on-surface font-bold mb-2">Legal</h4>
                <a class="font-body-md text-body-md text-on-surface-variant hover:text-[#f59e0b] transition-all duration-300"
                    href="#">Locations</a>
                <a class="font-body-md text-body-md text-on-surface-variant hover:text-[#f59e0b] transition-all duration-300"
                    href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>
    <script>
        // WebGL Smoke/Heat Shader Implementation
        document.addEventListener("DOMContentLoaded", () => {
            const canvas = document.getElementById('smokeCanvas');
            if (!canvas) return;

            const scene = new THREE.Scene();
            const camera = new THREE.OrthographicCamera(-1, 1, 1, -1, 0.1, 10);
            camera.position.z = 1;

            const renderer = new THREE.WebGLRenderer({
                canvas: canvas,
                alpha: true,
                antialias: false
            });
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2)); // optimize for performance

            const vertexShader = `
            varying vec2 vUv;
            void main() {
                vUv = uv;
                gl_Position = vec4(position, 1.0);
            }
        `;

            const fragmentShader = `
            uniform float time;
            uniform vec2 resolution;
            varying vec2 vUv;

            // Simplex noise function
            vec3 mod289(vec3 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
            vec2 mod289(vec2 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
            vec3 permute(vec3 x) { return mod289(((x*34.0)+1.0)*x); }
            float snoise(vec2 v) {
                const vec4 C = vec4(0.211324865405187,  // (3.0-sqrt(3.0))/6.0
                                    0.366025403784439,  // 0.5*(sqrt(3.0)-1.0)
                                   -0.577350269189626,  // -1.0 + 2.0 * C.x
                                    0.024390243902439); // 1.0 / 41.0
                vec2 i  = floor(v + dot(v, C.yy) );
                vec2 x0 = v -   i + dot(i, C.xx);
                vec2 i1;
                i1 = (x0.x > x0.y) ? vec2(1.0, 0.0) : vec2(0.0, 1.0);
                vec4 x12 = x0.xyxy + C.xxzz;
                x12.xy -= i1;
                i = mod289(i); // Avoid truncation effects in permutation
                vec3 p = permute( permute( i.y + vec3(0.0, i1.y, 1.0 ))
                    + i.x + vec3(0.0, i1.x, 1.0 ));
                vec3 m = max(0.5 - vec3(dot(x0,x0), dot(x12.xy,x12.xy), dot(x12.zw,x12.zw)), 0.0);
                m = m*m ;
                m = m*m ;
                vec3 x = 2.0 * fract(p * C.www) - 1.0;
                vec3 h = abs(x) - 0.5;
                vec3 ox = floor(x + 0.5);
                vec3 a0 = x - ox;
                m *= 1.79284291400159 - 0.85373472095314 * ( a0*a0 + h*h );
                vec3 g;
                g.x  = a0.x  * x0.x  + h.x  * x0.y;
                g.yz = a0.yz * x12.xz + h.yz * x12.yw;
                return 130.0 * dot(m, g);
            }

            void main() {
                vec2 st = gl_FragCoord.xy/resolution.xy;
                st.x *= resolution.x/resolution.y;

                // Heat rising effect
                vec2 pos = st;
                pos.y -= time * 0.2; // Move upwards
                pos.x += snoise(pos * 2.0 + time * 0.1) * 0.1; // Wavy motion

                float noiseVal = snoise(pos * 3.0);
                float noiseVal2 = snoise(pos * 6.0 + time * 0.5);
                
                // Combine noises for smoky/heat distortion look
                float finalNoise = (noiseVal + noiseVal2 * 0.5) * 0.5 + 0.5;
                
                // Embers/heat coloring
                vec3 color1 = vec3(0.8, 0.2, 0.0); // Deep red/orange
                vec3 color2 = vec3(0.9, 0.6, 0.1); // Amber/yellow
                vec3 darkBg = vec3(0.05, 0.02, 0.01);
                
                // Gradient based on y-position (hotter at bottom)
                float heatIntensity = smoothstep(0.8, 0.0, vUv.y);
                
                vec3 finalColor = mix(darkBg, mix(color1, color2, finalNoise), finalNoise * heatIntensity * 0.8);
                
                // Add some bright spots
                float sparks = pow(max(0.0, snoise(pos * 15.0 - time)), 8.0);
                finalColor += vec3(1.0, 0.8, 0.4) * sparks * heatIntensity;

                gl_FragColor = vec4(finalColor, min(1.0, (finalNoise * heatIntensity + sparks)*0.7));
            }
        `;

            const uniforms = {
                time: {
                    value: 0
                },
                resolution: {
                    value: new THREE.Vector2()
                }
            };

            const material = new THREE.ShaderMaterial({
                vertexShader,
                fragmentShader,
                uniforms,
                transparent: true
            });

            const geometry = new THREE.PlaneGeometry(2, 2);
            const mesh = new THREE.Mesh(geometry, material);
            scene.add(mesh);

            function resize() {
                const width = canvas.clientWidth;
                const height = canvas.clientHeight;
                if (canvas.width !== width || canvas.height !== height) {
                    renderer.setSize(width, height, false);
                    uniforms.resolution.value.set(width, height);
                }
            }

            let animationFrameId;
            const clock = new THREE.Clock();

            function animate() {
                resize();
                uniforms.time.value = clock.getElapsedTime();
                renderer.render(scene, camera);
                animationFrameId = requestAnimationFrame(animate);
            }

            animate();

            // Cleanup on navigate away if needed
            window.addEventListener('beforeunload', () => {
                cancelAnimationFrame(animationFrameId);
                geometry.dispose();
                material.dispose();
                renderer.dispose();
            });
        });
    </script>
</body>

</html>
