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
    @stack('headScript')
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
   {{$slot}}
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
