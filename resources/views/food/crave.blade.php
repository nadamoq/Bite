{{--
    Crave Kitchen — Ultra-Mouthwatering Food Platform
    Stack: Tailwind CSS · Alpine.js · GSAP · Blade (Laravel-ready)
    Optimized for: Desktop / Laptop (1080p–2K)
--}}
<!DOCTYPE html>
<html
    lang="ar"
    dir="rtl"
    x-data="craveApp({{ Js::from($showcaseDishes) }}, {{ Js::from($featuredDish) }})"
    x-init="init()"
    :dir="locale === 'ar' ? 'rtl' : 'ltr'"
    :lang="locale"
    class="scroll-smooth"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Crave Kitchen — طعم يذوب في الفم. Order hot, delivered fast.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crave Kitchen | طعم يذوب في الفم</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        charcoal: {
                            950: '#0a0a0b',
                            900: '#121214',
                            800: '#1a1a1e',
                            700: '#252529',
                        },
                        amber: {
                            glow: '#f59e0b',
                            fire: '#ea580c',
                            warm: '#fbbf24',
                        },
                        crimson: {
                            cta: '#dc2626',
                            hot: '#ef4444',
                        },
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"DM Sans"', 'system-ui', 'sans-serif'],
                        arabic: ['"Tajawal"', '"DM Sans"', 'sans-serif'],
                    },
                    backgroundImage: {
                        'wood-grain': "url('https://images.unsplash.com/photo-1615874959470-d9b4c4d7e8c8?w=1920&q=80')",
                        'hero-burger': "url('https://images.unsplash.com/photo-1568901346715-366b9e2d4f4d?w=1920&q=90')",
                        'hero-pizza': "url('https://images.unsplash.com/photo-1513104890138-7c749659a591?w=1920&q=90')",
                        'spice-overlay': "linear-gradient(135deg, rgba(10,10,11,0.92) 0%, rgba(26,26,30,0.85) 50%, rgba(10,10,11,0.95) 100%)",
                    },
                    boxShadow: {
                        'glow-amber': '0 0 40px rgba(245, 158, 11, 0.35)',
                        'glow-red': '0 0 30px rgba(220, 38, 38, 0.4)',
                        'card-float': '0 25px 50px -12px rgba(0, 0, 0, 0.65)',
                        'food-depth': '0 20px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(245,158,11,0.08)',
                    },
                    animation: {
                        'steam-rise': 'steamRise 3s ease-in-out infinite',
                        'cheese-drip': 'cheeseDrip 2.5s ease-in-out infinite',
                        'sizzle-pulse': 'sizzlePulse 1.8s ease-in-out infinite',
                        'ripple': 'ripple 0.6s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                        'glow-pulse': 'glowPulse 2s ease-in-out infinite',
                    },
                },
            },
        };
    </script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        /* ── Keyframe Sensory Animations ── */
        @keyframes steamRise {
            0%, 100% { opacity: 0; transform: translateY(0) scale(1); }
            50% { opacity: 0.6; transform: translateY(-20px) scale(1.2); }
        }
        @keyframes cheeseDrip {
            0%, 100% { transform: scaleY(1) translateY(0); }
            50% { transform: scaleY(1.08) translateY(4px); }
        }
        @keyframes sizzlePulse {
            0%, 100% { filter: brightness(1) saturate(1); }
            50% { filter: brightness(1.15) saturate(1.2); }
        }
        @keyframes ripple {
            0% { transform: scale(0); opacity: 0.6; }
            100% { transform: scale(4); opacity: 0; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.3); }
            50% { box-shadow: 0 0 40px rgba(245, 158, 11, 0.6); }
        }
        @keyframes flyToCart {
            0% { transform: scale(1) translate(0, 0); opacity: 1; }
            100% { transform: scale(0.2) translate(var(--fly-x, 200px), var(--fly-y, -300px)); opacity: 0; }
        }
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        /* ── FIRE / FLAME ANIMATIONS ── */
        @keyframes flameFlicker {
            0%, 100% { transform: scale(1) rotate(-1deg); filter: drop-shadow(0 0 15px rgba(234,88,12,0.8)); }
            25% { transform: scale(1.08) rotate(2deg) translateY(-2px); filter: drop-shadow(0 0 25px rgba(245,158,11,0.9)); }
            50% { transform: scale(0.95) rotate(-2deg) translateY(1px); filter: drop-shadow(0 0 12px rgba(220,38,38,0.8)); }
            75% { transform: scale(1.05) rotate(1deg) translateY(-1px); filter: drop-shadow(0 0 22px rgba(251,191,36,0.9)); }
        }

        @keyframes sparkFly {
            0% { transform: translate(0, 0) scale(1); opacity: 1; }
            100% { transform: translate(var(--spark-x, 15px), -40px) scale(0); opacity: 0; }
        }

        .fire-container {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .flame-core {
            animation: flameFlicker 1.2s ease-in-out infinite alternate;
            transform-origin: bottom center;
        }

        .spark {
            position: absolute;
            bottom: 20%;
            width: 4px;
            height: 4px;
            background-color: #fbbf24;
            border-radius: 50%;
            box-shadow: 0 0 6px #f59e0b, 0 0 10px #ea580c;
            animation: sparkFly 1.5s linear infinite;
        }

        /* Liquid ripple button */
        .btn-ripple {
            position: relative;
            overflow: hidden;
        }
        .btn-ripple .ripple-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.35);
            animation: ripple 0.6s ease-out forwards;
            pointer-events: none;
        }

        /* Food card hover micro-interactions */
        .food-card:hover .food-image {
            transform: scale(1.08);
        }
        .food-card:hover .steam-particle {
            animation: steamRise 2s ease-in-out infinite;
        }
        .food-card:hover .cheese-layer {
            animation: cheeseDrip 2s ease-in-out infinite;
        }
        .food-card:hover .sizzle-effect {
            animation: sizzlePulse 1.5s ease-in-out infinite;
        }

        /* Parallax layers */
        .parallax-layer {
            will-change: transform;
        }

        /* Wood texture section */
        .wood-section {
            background-image:
                url('https://images.unsplash.com/photo-1615874959470-d9b4c4d7e8c8?w=1920&q=80'),
                radial-gradient(ellipse at 20% 80%, rgba(139, 69, 19, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(245, 158, 11, 0.08) 0%, transparent 40%);
            background-size: cover, 100% 100%, 100% 100%;
            background-blend-mode: overlay, normal, normal;
        }

        /* Spice scatter decorative elements */
        .spice-dot {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        /* Shimmer text on hero */
        .shimmer-text {
            background: linear-gradient(90deg, #fbbf24 0%, #fff 40%, #f59e0b 60%, #fbbf24 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s linear infinite;
        }

        /* Fly-to-cart ghost */
        .fly-ghost {
            position: fixed;
            z-index: 9999;
            pointer-events: none;
            animation: flyToCart 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #121214; }
        ::-webkit-scrollbar-thumb { background: #f59e0b; border-radius: 4px; }

        /* RTL-aware spacing helpers */
        html[dir="rtl"] .flip-rtl { transform: scaleX(-1); }
    </style>

    @stack('styles')
</head>

<body class="bg-charcoal-950 text-white font-sans antialiased overflow-x-hidden"
      :class="locale === 'ar' ? 'font-arabic' : ''">

    {{-- ═══════════════════════════════════════════════════════════════
         NAVIGATION
    ═══════════════════════════════════════════════════════════════ --}}
    <header class="fixed top-0 inset-x-0 z-50 backdrop-blur-xl bg-charcoal-950/80 border-b border-amber-glow/10">
        <nav class="max-w-7xl mx-auto px-6 lg:px-10 h-20 flex items-center justify-between">
            {{-- Logo --}}
            <a href="#" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-glow to-crimson-cta flex items-center justify-center shadow-glow-amber group-hover:scale-105 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                </div>
                <span class="font-display text-2xl font-black tracking-tight">
                    <span class="text-amber-warm">Crave</span><span class="text-white/90">Kitchen</span>
                </span>
            </a>

            {{-- Desktop Nav Links --}}
            <ul class="hidden lg:flex items-center gap-10 text-sm font-medium text-white/70">
                <li><a href="#menu" class="hover:text-amber-warm transition-colors" x-text="t('nav.menu')"></a></li>
                <li><a href="#showcase" class="hover:text-amber-warm transition-colors" x-text="t('nav.specials')"></a></li>
                <li><a href="#about" class="hover:text-amber-warm transition-colors" x-text="t('nav.story')"></a></li>
            </ul>

            {{-- Actions --}}
            <div class="flex items-center gap-4">
                {{-- Locale Toggle --}}
                <button @click="toggleLocale()"
                        class="px-3 py-1.5 rounded-lg border border-white/10 text-xs font-semibold uppercase tracking-wider hover:border-amber-glow/50 hover:text-amber-warm transition-all"
                        x-text="locale === 'ar' ? 'EN' : 'عربي'">
                </button>

                {{-- Cart Button --}}
                <button @click="cartOpen = true"
                        class="relative btn-ripple px-5 py-2.5 rounded-xl bg-charcoal-800 border border-amber-glow/20 hover:border-amber-glow/50 hover:shadow-glow-amber transition-all flex items-center gap-2"
                        @mousedown="createRipple($event)">
                    <svg class="w-5 h-5 text-amber-warm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="text-sm font-semibold" x-text="t('nav.cart')"></span>
                    <span x-show="cartCount > 0"
                          x-text="cartCount"
                          class="absolute -top-2 -end-2 w-5 h-5 rounded-full bg-crimson-cta text-[10px] font-bold flex items-center justify-center shadow-glow-red animate-glow-pulse">
                    </span>
                </button>
            </div>
        </nav>
    </header>

    <main>

        {{-- ═══════════════════════════════════════════════════════════════
             1. HERO SECTION (WITH FIRE EFFECT ADDED)
        ═══════════════════════════════════════════════════════════════ --}}
        <section id="hero" class="relative min-h-screen flex items-center overflow-hidden">
            {{-- Background Media --}}
            <div class="absolute inset-0 parallax-layer" data-parallax="0.3">
                <div class="absolute inset-0 bg-hero-burger bg-cover bg-center scale-110"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-charcoal-950/70 to-charcoal-950/40"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-charcoal-950/90 via-transparent to-charcoal-950/60"></div>
            </div>

            {{-- Steam Particles --}}
            <div class="absolute top-1/3 start-1/2 -translate-x-1/2 pointer-events-none">
                <template x-for="i in 5" :key="i">
                    <div class="steam-particle absolute w-16 h-16 rounded-full bg-white/5 blur-xl"
                         :style="`left: ${(i-3)*40}px; animation-delay: ${i*0.4}s`"></div>
                </template>
            </div>

            {{-- Hero Content --}}
            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 pt-32 pb-20 w-full">
                <div class="max-w-3xl">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-amber-glow/10 border border-amber-glow/30 text-amber-warm text-xs font-bold uppercase tracking-[0.2em] mb-6 hero-badge opacity-0">
                        <span x-text="t('hero.badge')"></span>
                    </span>

                    {{-- Title with Animated Fire FX --}}
                    <h1 class="font-display text-5xl md:text-6xl xl:text-7xl font-black leading-[1.05] mb-4 hero-title opacity-0">
                        <span class="inline-flex items-center gap-3 text-white">
                            <span x-text="t('hero.title1')"></span>
                            
                            {{-- 🔥 Animated Fire Flame Container --}}
                            <div class="fire-container relative inline-block align-middle w-12 h-12 md:w-16 md:h-16">
                                {{-- Fire Sparks --}}
                                <span class="spark" style="left: 20%; --spark-x: -12px; animation-delay: 0.1s;"></span>
                                <span class="spark" style="left: 50%; --spark-x: 10px; animation-delay: 0.4s;"></span>
                                <span class="spark" style="left: 70%; --spark-x: -8px; animation-delay: 0.8s;"></span>

                                {{-- Animated Flame SVG --}}
                                <svg class="flame-core w-full h-full" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="flameGrad" x1="12" y1="22" x2="12" y2="2" gradientUnits="userSpaceOnUse">
                                            <stop offset="0%" stop-color="#dc2626"/>
                                            <stop offset="45%" stop-color="#ea580c"/>
                                            <stop offset="80%" stop-color="#f59e0b"/>
                                            <stop offset="100%" stop-color="#fbbf24"/>
                                        </linearGradient>
                                    </defs>
                                    <path d="M12 23C16.1421 23 19.5 19.6421 19.5 15.5C19.5 11.5 16 8 13.5 3.5C13.2 8 10 9.5 8.5 12C7.5 10.5 7 9 7.5 7.5C5 10 4.5 13 4.5 15.5C4.5 19.6421 7.85786 23 12 23Z" fill="url(#flameGrad)"/>
                                    <path d="M12 20.5C14.2091 20.5 16 18.7091 16 16.5C16 14.5 14 12.5 12.5 9.5C12.3 12.5 10.5 13.5 9.5 15C9 14 8.5 13 9 12C7.5 13.5 7 15 7 16.5C7 18.7091 8.79086 20.5 12 20.5Z" fill="#fbbf24" opacity="0.8"/>
                                </svg>
                            </div>
                        </span>
                        <span class="block shimmer-text mt-2" x-text="t('hero.title2')"></span>
                    </h1>

                    <p class="text-lg md:text-xl text-white/60 max-w-xl mb-10 leading-relaxed hero-subtitle opacity-0"
                       x-text="t('hero.subtitle')">
                    </p>

                    <div class="flex flex-wrap items-center gap-5 hero-cta opacity-0">
                        <button @click="scrollToMenu()"
                                class="btn-ripple group relative px-8 py-4 rounded-2xl bg-gradient-to-r from-crimson-cta to-amber-fire text-white font-bold text-lg shadow-glow-red hover:shadow-glow-amber hover:scale-[1.03] transition-all duration-300"
                                @mousedown="createRipple($event)">
                            <span class="relative z-10 flex items-center gap-3">
                                <span x-text="t('hero.cta')"></span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform flip-rtl" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </button>
                        <div class="flex items-center gap-3 text-white/50 text-sm">
                            <div class="flex -space-x-2 rtl:space-x-reverse">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop" class="w-9 h-9 rounded-full border-2 border-charcoal-950" alt="">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=40&h=40&fit=crop" class="w-9 h-9 rounded-full border-2 border-charcoal-950" alt="">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop" class="w-9 h-9 rounded-full border-2 border-charcoal-950" alt="">
                            </div>
                            <span x-text="t('hero.social')"></span>
                        </div>
                    </div>
                </div>

                {{-- Floating Hero Food Card --}}
                <div class="hidden xl:block absolute bottom-20 end-10 w-80 hero-float-card opacity-0">
                    <div class="relative rounded-3xl overflow-hidden shadow-food-depth border border-amber-glow/20 animate-float">
                        <img src="https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=600&q=90"
                             alt="Signature Burger" class="w-full h-52 object-cover sizzle-effect">
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 inset-x-0 p-5">
                            <span class="text-amber-warm text-xs font-bold uppercase tracking-wider" x-text="t('hero.featured')"></span>
                            <h3 class="font-display text-xl font-bold mt-1" x-text="t('hero.featuredName')"></h3>
                            <p class="text-amber-warm font-bold text-lg mt-1">$14.99</p>
                        </div>
                        {{-- Cheese drip overlay --}}
                        <div class="cheese-layer absolute bottom-16 start-1/2 -translate-x-1/2 w-24 h-3 bg-amber-warm/60 rounded-full blur-sm"></div>
                    </div>
                </div>
            </div>

            {{-- Scroll Indicator --}}
            <div class="absolute bottom-8 inset-x-0 flex justify-center animate-bounce">
                <div class="w-6 h-10 rounded-full border-2 border-white/20 flex justify-center pt-2">
                    <div class="w-1 h-2 bg-amber-warm rounded-full"></div>
                </div>
            </div>
        </section>


        {{-- ═══════════════════════════════════════════════════════════════
             2. SENSORY SHOWCASE — Rustic Spice & Texture Zone
        ═══════════════════════════════════════════════════════════════ --}}
        <section id="showcase" class="relative py-28 wood-section overflow-hidden">
            {{-- Spice scatter decoration --}}
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="spice-dot w-2 h-2 bg-amber-fire/40 top-[15%] start-[10%]"></div>
                <div class="spice-dot w-1.5 h-1.5 bg-red-500/30 top-[40%] start-[85%]"></div>
                <div class="spice-dot w-3 h-3 bg-amber-warm/25 top-[70%] start-[20%]"></div>
                <div class="spice-dot w-1 h-1 bg-white/20 top-[25%] start-[60%]"></div>
                <div class="spice-dot w-2.5 h-2.5 bg-orange-600/30 top-[80%] start-[75%]"></div>
            </div>

            <div class="absolute inset-0 bg-spice-overlay"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
                <div class="text-center mb-16 showcase-header">
                    <span class="text-amber-warm text-xs font-bold uppercase tracking-[0.25em]" x-text="t('showcase.label')"></span>
                    <h2 class="font-display text-4xl md:text-5xl font-black mt-3 mb-4" x-text="t('showcase.title')"></h2>
                    <p class="text-white/50 max-w-2xl mx-auto text-lg" x-text="t('showcase.subtitle')"></p>
                </div>

                {{-- Dynamic Premium Split Showcase Layout --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                    {{-- Spotlight Hero Bestseller (Prominent Left/Top Column) --}}
                    <div class="lg:col-span-5" x-show="featuredDish">
                        <div class="text-start mb-6">
                            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-gradient-to-r from-crimson-cta/30 to-amber-fire/20 border border-amber-glow/20 text-amber-warm text-xs font-black uppercase tracking-wider animate-pulse">
                                <span>🏆</span> <span x-text="locale === 'ar' ? 'البطل الأكبر مبيعاً' : 'Overall #1 Bestseller'"></span>
                            </span>
                        </div>
                        <article class="group relative rounded-3xl overflow-hidden shadow-card-float border border-amber-glow/30 hover:border-amber-glow/60 transition-all duration-500 hover:-translate-y-2 cursor-pointer"
                                 @click="openCustomizer(featuredDish)">
                            <div class="aspect-[4/5] overflow-hidden">
                                <img :src="featuredDish ? featuredDish.image : ''" :alt="featuredDish ? featuredDish.name[locale] : ''"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 sizzle-effect">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-charcoal-950/40 to-transparent"></div>
                            
                            {{-- Steam on hover --}}
                            <div class="absolute top-1/3 start-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="steam-particle w-16 h-16 rounded-full bg-white/10 blur-xl animate-steam-rise"></div>
                            </div>

                            <div class="absolute bottom-0 inset-x-0 p-8">
                                <h3 class="font-display text-3xl font-black mb-2 text-amber-warm" x-text="featuredDish ? featuredDish.name[locale] : ''"></h3>
                                <p class="text-white/70 text-base mb-4 line-clamp-3" x-text="featuredDish ? featuredDish.desc[locale] : ''"></p>
                                <div class="flex items-center justify-between">
                                    <span class="text-white font-black text-2xl" x-text="'$' + (featuredDish ? featuredDish.price.toFixed(2) : '0.00')"></span>
                                    <button class="btn-ripple w-12 h-12 rounded-full bg-amber-glow text-charcoal-950 flex items-center justify-center hover:bg-amber-warm transition-colors shadow-glow-amber"
                                            @click.stop="quickAdd(featuredDish, $event)">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>

                    {{-- Category Diverse Recommendations Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 lg:col-span-7" :class="featuredDish ? 'lg:col-span-7' : 'lg:col-span-12 grid-cols-1 md:grid-cols-3'">
                        <template x-for="(dish, index) in showcaseDishes" :key="dish.id">
                            <article class="showcase-card group relative rounded-3xl overflow-hidden shadow-card-float border border-white/5 hover:border-amber-glow/30 transition-all duration-500 hover:-translate-y-2 cursor-pointer"
                                     @click="openCustomizer(dish)">
                                <div class="aspect-square overflow-hidden">
                                    <img :src="dish.image" :alt="dish.name[locale]"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 sizzle-effect">
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-charcoal-950/20 to-transparent"></div>

                                {{-- Badge --}}
                                <span class="absolute top-4 start-4 px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-wider"
                                      :class="dish.badgeClass"
                                      x-text="dish.badge[locale]"></span>

                                <div class="absolute bottom-0 inset-x-0 p-5">
                                    <h3 class="font-display text-xl font-bold mb-1" x-text="dish.name[locale]"></h3>
                                    <p class="text-white/50 text-xs mb-3 line-clamp-2" x-text="dish.desc[locale]"></p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-amber-warm font-bold text-base" x-text="'$' + dish.price.toFixed(2)"></span>
                                        <button class="btn-ripple w-8 h-8 rounded-full bg-crimson-cta/90 flex items-center justify-center hover:bg-crimson-cta transition-colors shadow-glow-red"
                                                @click.stop="quickAdd(dish, $event)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </article>
                        </template>
                    </div>
                </div>
            </div>
        </section>


        {{-- ═══════════════════════════════════════════════════════════════
             3. INTERACTIVE MENU & CATEGORY RAIL
        ═══════════════════════════════════════════════════════════════ --}}
        <section id="menu" class="py-28 bg-charcoal-900 relative">
            <div class="max-w-7xl mx-auto px-6 lg:px-10">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12 menu-header">
                    <div>
                        <span class="text-amber-warm text-xs font-bold uppercase tracking-[0.25em]" x-text="t('menu.label')"></span>
                        <h2 class="font-display text-4xl md:text-5xl font-black mt-3" x-text="t('menu.title')"></h2>
                    </div>

                    {{-- Search Input & Category Rail --}}
                    <div class="flex flex-col sm:flex-row gap-4 items-center w-full lg:w-auto">
                        <div class="relative w-full sm:w-64">
                            <input type="text"
                                   x-model="searchQuery"
                                   @input.debounce.300ms="fetchMenuItems()"
                                   :placeholder="locale === 'ar' ? 'بحث عن أطباق...' : 'Search dishes...'"
                                   class="w-full px-4 py-2.5 pe-10 rounded-xl bg-charcoal-800 border border-white/10 text-sm focus:outline-none focus:border-amber-glow/40 placeholder:text-white/30 text-white">
                            
                            {{-- Clear Button --}}
                            <button x-show="searchQuery.length > 0"
                                    @click="searchQuery = ''; fetchMenuItems()"
                                    class="absolute top-1/2 -translate-y-1/2 text-white/50 hover:text-white"
                                    :class="locale === 'ar' ? 'left-10' : 'right-10'"
                                    type="button">
                                ✕
                            </button>

                            <span class="absolute top-1/2 -translate-y-1/2 text-white/30" :class="locale === 'ar' ? 'left-4' : 'right-4'">
                                🔍
                            </span>
                        </div>

                        <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide max-w-full">
                            <template x-for="cat in categories" :key="cat.id">
                                <button @click="selectCategory(cat.id)"
                                        class="flex-shrink-0 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 border"
                                        :class="activeCategory === cat.id
                                            ? 'bg-amber-glow/15 border-amber-glow/40 text-amber-warm shadow-glow-amber'
                                            : 'bg-charcoal-800 border-white/5 text-white/50 hover:border-amber-glow/20 hover:text-white/80'"
                                        x-text="cat.label[locale]">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Menu Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <template x-for="item in filteredMenu" :key="item.id">
                        <article class="food-card group relative rounded-2xl bg-charcoal-800/60 border border-white/5 overflow-hidden hover:border-amber-glow/25 hover:shadow-food-depth transition-all duration-500 cursor-pointer"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 @click="openCustomizer(item)">
                            {{-- Image --}}
                            <div class="relative aspect-square overflow-hidden">
                                <img :src="item.image" :alt="item.name[locale]"
                                     class="food-image w-full h-full object-cover transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-900/80 via-transparent to-transparent"></div>

                                {{-- Interactive Badges --}}
                                <div class="absolute top-3 start-3 flex flex-wrap gap-1.5">
                                    <template x-for="badge in item.badges" :key="badge">
                                        <span class="px-2 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wide backdrop-blur-md"
                                              :class="badgeStyles[badge]?.class || 'bg-white/10 text-white/70'"
                                              x-text="badgeStyles[badge]?.[locale] || badge"></span>
                                    </template>
                                </div>

                                {{-- Quick Add --}}
                                <button @click.stop="quickAdd(item, $event)"
                                        class="absolute bottom-3 end-3 btn-ripple w-11 h-11 rounded-xl bg-crimson-cta flex items-center justify-center opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-glow-red hover:scale-110"
                                        @mousedown="createRipple($event)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>

                                {{-- Cheese melt overlay --}}
                                <div class="cheese-layer absolute bottom-0 inset-x-0 h-8 bg-gradient-to-t from-amber-warm/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>

                            {{-- Info --}}
                            <div class="p-5">
                                <h3 class="font-semibold text-lg mb-1 group-hover:text-amber-warm transition-colors" x-text="item.name[locale]"></h3>
                                <p class="text-white/40 text-sm line-clamp-2 mb-3" x-text="item.desc[locale]"></p>
                                <div class="flex items-center justify-between">
                                    <span class="text-amber-warm font-bold text-lg" x-text="'$' + item.price.toFixed(2)"></span>
                                    <div class="flex items-center gap-1 text-amber-warm/80">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-xs font-medium" x-text="item.rating"></span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </template>
                </div>
            </div>
        </section>


        {{-- ═══════════════════════════════════════════════════════════════
             ABOUT / CTA STRIP
        ═══════════════════════════════════════════════════════════════ --}}
        <section id="about" class="py-20 bg-gradient-to-r from-charcoal-950 via-charcoal-800 to-charcoal-950 border-y border-amber-glow/10">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="font-display text-3xl md:text-4xl font-black mb-4" x-text="t('about.title')"></h2>
                <p class="text-white/50 text-lg mb-8" x-text="t('about.subtitle')"></p>
                <button @click="cartOpen = true"
                        class="btn-ripple px-10 py-4 rounded-2xl bg-gradient-to-r from-amber-glow to-amber-fire text-charcoal-950 font-bold text-lg hover:scale-105 transition-transform shadow-glow-amber"
                        @mousedown="createRipple($event)"
                        x-text="t('about.cta')">
                </button>
            </div>
        </section>

    </main>


    {{-- ═══════════════════════════════════════════════════════════════
         4. MICRO-CUSTOMIZER MODAL
    ═══════════════════════════════════════════════════════════════ --}}
    <div x-show="modalOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4"
         @keydown.escape.window="modalOpen = false">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-charcoal-950/85 backdrop-blur-sm" @click="modalOpen = false"></div>

        {{-- Modal Panel --}}
        <div x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300 delay-75"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-3xl bg-charcoal-800 border border-amber-glow/20 shadow-food-depth">

            <template x-if="selectedItem">
                <div class="grid md:grid-cols-2">
                    {{-- HD Image Zoom Area --}}
                    <div class="relative aspect-square md:aspect-auto md:min-h-[480px] overflow-hidden">
                        <img :src="selectedItem.image" :alt="selectedItem.name[locale]"
                             class="w-full h-full object-cover sizzle-effect transition-transform duration-500"
                             :class="customizerZoom ? 'scale-125' : 'scale-100'"
                             @mouseenter="customizerZoom = true"
                             @mouseleave="customizerZoom = false">
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-800/60 to-transparent md:bg-none"></div>
                        <button @click="modalOpen = false"
                                class="absolute top-4 end-4 w-10 h-10 rounded-full bg-charcoal-950/70 backdrop-blur flex items-center justify-center hover:bg-charcoal-950 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Customizer Controls --}}
                    <div class="p-6 lg:p-8 flex flex-col">
                        <span class="text-amber-warm text-xs font-bold uppercase tracking-wider" x-text="t('modal.customize')"></span>
                        <h3 class="font-display text-3xl font-black mt-2 mb-2" x-text="selectedItem.name[locale]"></h3>
                        <p class="text-white/50 text-sm mb-6" x-text="selectedItem.desc[locale]"></p>

                        {{-- Add-ons Grouped by Category --}}
                        <div class="space-y-6 mb-6 flex-1">
                            <template x-for="addonCategory in selectedItem?.addon_categories || []" :key="addonCategory.id">
                                <div class="space-y-3">
                                    {{-- Category Header --}}
                                    <h4 class="text-sm font-semibold text-amber-warm/80 uppercase tracking-wide" x-text="addonCategory.name[locale]"></h4>
                                    
                                    {{-- Addons in this category --}}
                                    <div class="space-y-2">
                                        <template x-for="addon in addonCategory.addons" :key="addon.id">
                                            <label class="flex items-center justify-between p-4 rounded-xl bg-charcoal-900/60 border border-white/5 hover:border-amber-glow/20 cursor-pointer transition-all"
                                                   :class="selectedAddons.includes(addon.id) ? 'border-amber-glow/40 bg-amber-glow/5' : ''">
                                                <div class="flex items-center gap-4">
                                                    <img :src="addon.image" :alt="addon.name[locale]" class="w-14 h-14 rounded-lg object-cover">
                                                    <div>
                                                        <span class="font-semibold text-sm" x-text="addon.name[locale]"></span>
                                                        <span class="block text-amber-warm/70 text-xs mt-0.5" x-text="'+' + '$' + addon.price.toFixed(2)"></span>
                                                    </div>
                                                </div>
                                                <input type="checkbox"
                                                       :value="addon.id"
                                                       @change="toggleAddon(addon.id)"
                                                       :checked="selectedAddons.includes(addon.id)"
                                                       class="w-5 h-5 rounded accent-amber-glow">
                                            </label>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>

                            {{-- Cheese Pull Toggle --}}
                            <div class="flex items-center justify-between p-4 rounded-xl bg-charcoal-900/60 border border-white/5">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🧀</span>
                                    <div>
                                        <span class="font-semibold text-sm" x-text="t('modal.cheesePull')"></span>
                                        <span class="block text-white/40 text-xs" x-text="t('modal.cheesePullDesc')"></span>
                                    </div>
                                </div>
                                <button @click="cheesePull = !cheesePull"
                                        class="relative w-12 h-7 rounded-full transition-colors"
                                        :class="cheesePull ? 'bg-amber-glow' : 'bg-charcoal-700'">
                                    <span class="absolute top-0.5 w-6 h-6 rounded-full bg-white shadow transition-all"
                                          :class="cheesePull ? 'start-5' : 'start-0.5'"></span>
                                </button>
                            </div>
                        </div>

                        {{-- Quantity & Price --}}
                        <div class="border-t border-white/5 pt-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <button @click="modalQty = Math.max(1, modalQty - 1)"
                                            class="w-10 h-10 rounded-xl bg-charcoal-900 border border-white/10 flex items-center justify-center hover:border-amber-glow/30 transition-colors">−</button>
                                    <span class="text-xl font-bold w-8 text-center" x-text="modalQty"></span>
                                    <button @click="modalQty++"
                                            class="w-10 h-10 rounded-xl bg-charcoal-900 border border-white/10 flex items-center justify-center hover:border-amber-glow/30 transition-colors">+</button>
                                </div>
                                <div class="text-end">
                                    <span class="text-white/40 text-xs" x-text="t('modal.total')"></span>
                                    <p class="text-amber-warm font-black text-2xl" x-text="'$' + modalTotal.toFixed(2)"></p>
                                </div>
                            </div>
                            <button @click="addCustomizedToCart()"
                                    class="btn-ripple w-full py-4 rounded-2xl bg-gradient-to-r from-crimson-cta to-amber-fire font-bold text-lg shadow-glow-red hover:shadow-glow-amber transition-all hover:scale-[1.02]"
                                    @mousedown="createRipple($event)"
                                    x-text="t('modal.addToCart')">
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>


    {{-- ═══════════════════════════════════════════════════════════════
         5. STICKY CART DRAWER
    ═══════════════════════════════════════════════════════════════ --}}
    <div x-show="cartOpen"
         x-cloak
         class="fixed inset-0 z-[110]"
         @keydown.escape.window="cartOpen = false">

        <div x-show="cartOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-charcoal-950/70 backdrop-blur-sm"
             @click="cartOpen = false"></div>

        <div x-show="cartOpen"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="translate-x-full rtl:-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full rtl:-translate-x-full"
             class="absolute top-0 end-0 h-full w-full max-w-md bg-charcoal-900 border-s border-amber-glow/10 shadow-2xl flex flex-col">

            {{-- Drawer Header --}}
            <div class="flex items-center justify-between p-6 border-b border-white/5">
                <div>
                    <h3 class="font-display text-2xl font-bold" x-text="t('cart.title')"></h3>
                    <p class="text-white/40 text-sm" x-text="cart.length + ' ' + t('cart.items')"></p>
                </div>
                <button @click="cartOpen = false" class="w-10 h-10 rounded-xl bg-charcoal-800 flex items-center justify-center hover:bg-charcoal-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Cart Items --}}
            <div class="flex-1 overflow-y-auto p-6 space-y-4">
                <template x-if="cart.length === 0">
                    <div class="text-center py-16">
                        <div class="text-6xl mb-4">🍽️</div>
                        <p class="text-white/40" x-text="t('cart.empty')"></p>
                    </div>
                </template>

                <template x-for="(item, idx) in cart" :key="idx">
                    <div class="flex gap-4 p-3 rounded-xl bg-charcoal-800/60 border border-white/5">
                        <img :src="item.image" :alt="item.name" class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-sm truncate" x-text="item.name"></h4>
                            <p x-show="item.addons" class="text-white/30 text-xs mt-0.5 truncate" x-text="item.addons"></p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-amber-warm font-bold" x-text="'$' + item.total.toFixed(2)"></span>
                                <div class="flex items-center gap-2">
                                    <button @click="updateCartQty(idx, -1)" class="w-7 h-7 rounded-lg bg-charcoal-900 text-sm hover:bg-charcoal-700">−</button>
                                    <span class="text-sm w-4 text-center" x-text="item.qty"></span>
                                    <button @click="updateCartQty(idx, 1)" class="w-7 h-7 rounded-lg bg-charcoal-900 text-sm hover:bg-charcoal-700">+</button>
                                </div>
                            </div>
                        </div>
                        <button @click="removeFromCart(idx)" class="text-white/20 hover:text-crimson-hot transition-colors self-start">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </template>
            </div>

            {{-- Promo & Checkout --}}
            <div class="p-6 border-t border-white/5 space-y-4">
                {{-- Error Message --}}
                <div x-show="orderError" 
                     class="p-4 rounded-xl bg-crimson-cta/20 border border-crimson-hot/50 text-crimson-hot text-sm"
                     x-text="orderError"
                     x-transition>
                </div>

                {{-- Success Message --}}
                <div x-show="orderSuccess" 
                     class="p-4 rounded-xl bg-green-500/20 border border-green-500/50 text-green-300 text-sm"
                     x-text="locale === 'ar' ? `✓ تم استلام طلبك برقم ${orderId}` : `✓ Order #${orderId} received`"
                     x-transition>
                </div>

                <div class="flex gap-2">
                    <input type="text"
                           x-model="promoCode"
                           :placeholder="t('cart.promoPlaceholder')"
                           class="flex-1 px-4 py-3 rounded-xl bg-charcoal-800 border border-white/10 text-sm focus:outline-none focus:border-amber-glow/40 placeholder:text-white/25">
                    <button @click="applyPromo()"
                            class="px-5 py-3 rounded-xl bg-charcoal-800 border border-amber-glow/20 text-amber-warm text-sm font-semibold hover:bg-amber-glow/10 transition-colors"
                            x-text="t('cart.apply')">
                    </button>
                </div>
                <p x-show="promoApplied" class="text-green-400 text-xs" x-text="t('cart.promoSuccess')"></p>

                <div class="space-y-2 text-sm">
                    <div class="flex justify-between text-white/50">
                        <span x-text="t('cart.subtotal')"></span>
                        <span x-text="'$' + cartSubtotal.toFixed(2)"></span>
                    </div>
                    <div x-show="promoApplied" class="flex justify-between text-green-400">
                        <span x-text="t('cart.discount')"></span>
                        <span x-text="'-$' + (cartSubtotal * 0.1).toFixed(2)"></span>
                    </div>
                    <div class="flex justify-between text-white/50">
                        <span x-text="t('cart.delivery')"></span>
                        <span x-text="t('cart.free')"></span>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-2 border-t border-white/5">
                        <span x-text="t('cart.total')"></span>
                        <span class="text-amber-warm" x-text="'$' + cartTotal.toFixed(2)"></span>
                    </div>
                </div>

                <button @click="checkout()"
                        :disabled="cart.length === 0 || isLoading"
                        class="btn-ripple w-full py-4 rounded-2xl bg-gradient-to-r from-crimson-cta to-amber-fire font-bold text-lg shadow-glow-red hover:shadow-glow-amber transition-all disabled:opacity-40 disabled:cursor-not-allowed hover:scale-[1.02]"
                        @mousedown="!isLoading && createRipple($event)"
                        x-text="isLoading ? (locale === 'ar' ? 'جاري المعالجة...' : 'Processing...') : t('cart.checkout')">
                </button>
            </div>
        </div>
    </div>


    {{-- Fly-to-cart ghost element container --}}
    <div id="fly-container"></div>


    {{-- ═══════════════════════════════════════════════════════════════
         ALPINE.JS APP LOGIC
    ═══════════════════════════════════════════════════════════════ --}}
    <script>
        function craveApp(initialShowcase = [], initialFeatured = null) {
            return {
                locale: 'ar',
                cartOpen: false,
                modalOpen: false,
                selectedItem: null,
                selectedAddons: [],
                cheesePull: false,
                modalQty: 1,
                customizerZoom: false,
                activeCategory: 'all',
                searchQuery: '',
                promoCode: '',
                promoApplied: false,
                cart: [],
                isLoading: false,
                orderError: null,
                orderSuccess: false,
                orderId: null,
                routes: {
                    getMenu: "{{ route('menuitem.index') }}",
                    getAddon:"{{route('addon.index')}}",
                    storeOrder: "{{ route('order.store') }}"
                },

                translations: {
                    ar: {
                        'nav.menu': 'القائمة', 'nav.specials': 'الأطباق المميزة', 'nav.story': 'قصتنا', 'nav.cart': 'السلة',
                        'hero.badge': '🔥 الأكثر طلباً هذا الأسبوع',
                        'hero.title1': 'جوعان؟', 'hero.title2': 'طعم يذوب في الفم',
                        'hero.subtitle': 'برجر مشوي على الفحم، بيتزا بجبنة تذوب، وتوصيل ساخن لبابك خلال 30 دقيقة.',
                        'hero.cta': 'اطلب الآن — دافئ وساخن', 'hero.social': '+2,400 عميل سعيد',
                        'hero.featured': 'طبق الشيف', 'hero.featuredName': 'برجر الوحش المزدوج',
                        'showcase.label': 'لمسة الشيف', 'showcase.title': 'أطباق تأسر الحواس',
                        'showcase.subtitle': 'كل طبق محضّر بحب، متبل بإتقان، ومقدّم وهو يدخن من السخونة.',
                        'menu.label': 'استكشف', 'menu.title': 'قائمة الطعام',
                        'about.title': 'جاهز للانطلاق؟', 'about.subtitle': 'اطلب الآن واستمتع بتوصيل مجاني على طلبك الأول.',
                        'about.cta': 'ابدأ طلبك',
                        'modal.customize': 'خصّص طبقك', 'modal.cheesePull': 'سحب الجبنة الإضافي',
                        'modal.cheesePullDesc': 'طبقة جبنة موزارella مضاعفة', 'modal.total': 'الإجمالي',
                        'modal.addToCart': 'أضف للسلة —',
                        'cart.title': 'سلتك', 'cart.items': 'عناصر', 'cart.empty': 'سلتك فارغة — اكتشف قائمتنا!',
                        'cart.promoPlaceholder': 'كود الخصم', 'cart.apply': 'تطبيق', 'cart.promoSuccess': '✓ تم تطبيق خصم 10%',
                        'cart.subtotal': 'المجموع الفرعي', 'cart.discount': 'خصم', 'cart.delivery': 'التوصيل', 'cart.free': 'مجاني',
                        'cart.total': 'الإجمالي', 'cart.checkout': 'إتمام الطلب',
                    },
                    en: {
                        'nav.menu': 'Menu', 'nav.specials': 'Specials', 'nav.story': 'Our Story', 'nav.cart': 'Cart',
                        'hero.badge': '🔥 Most Ordered This Week',
                        'hero.title1': 'Craving Greatness?', 'hero.title2': 'Taste That Melts',
                        'hero.subtitle': 'Char-grilled burgers, stretchy cheese pizza, and piping hot delivery to your door in 30 minutes.',
                        'hero.cta': 'Order Now — Delivered Hot', 'hero.social': '+2,400 happy customers',
                        'hero.featured': "Chef's Pick", 'hero.featuredName': 'Double Beast Burger',
                        'showcase.label': "Chef's Touch", 'showcase.title': 'Dishes That Captivate',
                        'showcase.subtitle': 'Every plate crafted with passion, seasoned to perfection, served steaming hot.',
                        'menu.label': 'Explore', 'menu.title': 'Our Menu',
                        'about.title': 'Ready to Feast?', 'about.subtitle': 'Order now and enjoy free delivery on your first order.',
                        'about.cta': 'Start Your Order',
                        'modal.customize': 'Customize Your Dish', 'modal.cheesePull': 'Extra Cheese Pull',
                        'modal.cheesePullDesc': 'Double mozzarella layer', 'modal.total': 'Total',
                        'modal.addToCart': 'Add to Cart —',
                        'cart.title': 'Your Cart', 'cart.items': 'items', 'cart.empty': 'Your cart is empty — explore our menu!',
                        'cart.promoPlaceholder': 'Promo code', 'cart.apply': 'Apply', 'cart.promoSuccess': '✓ 10% discount applied',
                        'cart.subtotal': 'Subtotal', 'cart.discount': 'Discount', 'cart.delivery': 'Delivery', 'cart.free': 'Free',
                        'cart.total': 'Total', 'cart.checkout': 'Complete Order',
                    },
                },

                categories: [
                    { id: 'all', label: { ar: 'الكل', en: 'All' } },
                    { id: 'burgers', label: { ar: 'برجر', en: 'Burgers' } },
                    { id: 'pizza', label: { ar: 'بيتزا', en: 'Pizza' } },
                    { id: 'grills', label: { ar: 'مشويات', en: 'Grills' } },
                    { id: 'sides', label: { ar: 'إضافات', en: 'Sides' } },
                ],

                badgeStyles: {
                    'extra-cheese': { ar: 'جبنة إضافية', en: 'Extra Cheese', class: 'bg-amber-glow/20 text-amber-warm' },
                    'crispy-hot': { ar: 'مقرمش وساخن', en: 'Crispy & Hot', class: 'bg-crimson-cta/20 text-crimson-hot' },
                    'chef-special': { ar: 'طبق الشيف', en: "Chef's Special", class: 'bg-purple-500/20 text-purple-300' },
                    'bestseller': { ar: 'الأكثر مبيعاً', en: 'Bestseller', class: 'bg-green-500/20 text-green-300' },
                },

                featuredDish: initialFeatured,

                showcaseDishes: initialShowcase.length ? initialShowcase : [
                    {
                        id: 1, price: 16.99,
                        image: 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&q=90',
                        name: { ar: 'بيتزا مارغريتا فاخرة', en: 'Premium Margherita' },
                        desc: { ar: 'جبنة موزارella طازجة مع ريحان معطر وصلصة طماطم منزلية', en: 'Fresh mozzarella, aromatic basil, house tomato sauce' },
                        badge: { ar: 'طبق الشيف', en: "Chef's Special" },
                        badgeClass: 'bg-purple-500/30 text-purple-200 backdrop-blur-md',
                    },
                    {
                        id: 2, price: 18.99,
                        image: 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=600&q=90',
                        name: { ar: 'برجر لحم Angus مزدوج', en: 'Double Angus Burger' },
                        desc: { ar: 'لحم Angus مشوي، جبنة cheddar ذائبة، صلصة خاصة', en: 'Grilled Angus beef, melted cheddar, secret sauce' },
                        badge: { ar: 'الأكثر مبيعاً', en: 'Bestseller' },
                        badgeClass: 'bg-crimson-cta/30 text-crimson-hot backdrop-blur-md',
                    },
                    {
                        id: 3, price: 22.99,
                        image: 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600&q=90',
                        name: { ar: 'ريش غنم مشوية', en: 'Grilled Lamb Ribs' },
                        desc: { ar: 'ريش غنم متبلة 24 ساعة، مشوية على الفحم مع صلصة التتبيل', en: '24hr marinated lamb ribs, charcoal grilled with glaze' },
                        badge: { ar: 'مقرمش وساخن', en: 'Crispy & Hot' },
                        badgeClass: 'bg-amber-glow/30 text-amber-warm backdrop-blur-md',
                    },
                ],
                allMenuItems: [],  // Master immutable copy of all menu items
                menuItems: [],     // Will be computed/filtered list

                get filteredMenu() {
                    let items = this.allMenuItems || [];
                    
                    if (this.activeCategory !== 'all') {
                        items = items.filter(i => i.category === this.activeCategory);
                    }
                    
                    if (this.searchQuery && this.searchQuery.trim() !== '') {
                        const query = this.searchQuery.toLowerCase().trim();
                        items = items.filter(i => {
                            const nameAr = i.name?.ar ? i.name.ar.toLowerCase() : '';
                            const nameEn = i.name?.en ? i.name.en.toLowerCase() : '';
                            const descAr = i.desc?.ar ? i.desc.ar.toLowerCase() : '';
                            const descEn = i.desc?.en ? i.desc.en.toLowerCase() : '';
                            return nameAr.includes(query) || nameEn.includes(query) || descAr.includes(query) || descEn.includes(query);
                        });
                    }
                    
                    return items;
                },

                get cartCount() {
                    return this.cart.reduce((sum, i) => sum + i.qty, 0);
                },

                get cartSubtotal() {
                    return this.cart.reduce((sum, i) => sum + i.total, 0);
                },

                get cartTotal() {
                    const sub = this.cartSubtotal;
                    return this.promoApplied ? sub * 0.9 : sub;
                },

                get modalTotal() {
                    if (!this.selectedItem) return 0;
                    let total = this.selectedItem.price;
                    
                    if (this.selectedItem.addon_categories) {
                        this.selectedItem.addon_categories.forEach(category => {
                            category.addons.forEach(addon => {
                                if (this.selectedAddons.includes(addon.id)) {
                                    total += addon.price;
                                }
                            });
                        });
                    }
                    
                    if (this.cheesePull) total += 2.50;
                    return total * this.modalQty;
                },

                t(key) { return this.translations[this.locale][key] || key; },

                toggleLocale() {
                    this.locale = this.locale === 'ar' ? 'en' : 'ar';
                    document.documentElement.dir = this.locale === 'ar' ? 'rtl' : 'ltr';
                    document.documentElement.lang = this.locale;
                },

                scrollToMenu() {
                    document.getElementById('menu')?.scrollIntoView({ behavior: 'smooth' });
                },

                openCustomizer(item) {
                    this.selectedItem = item;
                    this.selectedAddons = [];
                    this.cheesePull = false;
                    this.modalQty = 1;
                    this.customizerZoom = false;
                    this.modalOpen = true;
                },

                toggleAddon(id) {
                    const idx = this.selectedAddons.indexOf(id);
                    if (idx > -1) this.selectedAddons.splice(idx, 1);
                    else this.selectedAddons.push(id);
                },

                quickAdd(item, event) {
                    this.flyToCart(event, item.image);
                    const name = item.name[this.locale];
                    const existingItem = this.cart.find(c => c.menuitem_id === item.id && c.addons === '');
                    if (existingItem) {
                        existingItem.qty += 1;
                        existingItem.total += item.price;
                    } else {
                        this.cart.push({
                            menuitem_id: item.id,
                            name,
                            image: item.image,
                            qty: 1,
                            total: item.price,
                            addons: '',
                        });
                    }
                },

                addCustomizedToCart() {
                    const name = this.selectedItem.name[this.locale];
                    const addonNames = [];
                    
                    // Extract addon names from addon_categories structure
                    if (this.selectedItem.addon_categories) {
                        this.selectedItem.addon_categories.forEach(category => {
                            category.addons.forEach(addon => {
                                if (this.selectedAddons.includes(addon.id)) {
                                    addonNames.push(addon.name[this.locale]);
                                }
                            });
                        });
                    }
                    
                    if (this.cheesePull) addonNames.push(this.t('modal.cheesePull'));
                    const extras = addonNames.join(', ');

                    const existingItem = this.cart.find(c => c.menuitem_id === this.selectedItem.id && c.addons === extras);
                    if (existingItem) {
                        existingItem.qty += this.modalQty;
                        existingItem.total += this.modalTotal;
                    } else {
                        this.cart.push({
                            menuitem_id: this.selectedItem.id,
                            name,
                            image: this.selectedItem.image,
                            qty: this.modalQty,
                            total: this.modalTotal,
                            addons: extras,
                        });
                    }
                    this.modalOpen = false;
                    this.cartOpen = true;
                },

                updateCartQty(idx, delta) {
                    const item = this.cart[idx];
                    item.qty = Math.max(0, item.qty + delta);
                    if (item.qty === 0) { this.cart.splice(idx, 1); return; }
                    item.total = (item.total / (item.qty - delta)) * item.qty;
                },

                removeFromCart(idx) { this.cart.splice(idx, 1); },

                selectCategory(categoryId) {
                    const categoryExists = this.categories.some(c => c.id === categoryId);
                    if (!categoryExists) {
                        console.warn(`Category not found: ${categoryId}. Defaulting to 'all'.`);
                        categoryId = 'all';
                    }
                    this.activeCategory = categoryId;
                    this.fetchMenuItems();
                },

                applyPromo() {
                    if (this.promoCode.toLowerCase() === 'crave10') this.promoApplied = true;
                },

                buildOrderItems() {
                    return this.cart.map(item => ({
                        menuitem_id: item.menuitem_id || 1, // Use the actual menuitem_id if available
                        quantity: item.qty,
                        unit_price: item.total / item.qty, // Calculate unit price from total
                        special_instructions: item.addons || null,
                    }));
                },

                async checkout() {
                    if (this.cart.length === 0) {
                        this.orderError = this.locale === 'ar' ? 'السلة فارغة' : 'Cart is empty';
                        return;
                    }

                    this.isLoading = true;
                    this.orderError = null;
                    this.orderSuccess = false;

                    try {
                        const orderData = {
                            items: this.buildOrderItems()
                        };

                        const response = await axios.post(this.routes.storeOrder, orderData, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        if (response.status === 201 && response.data.message === 'success') {
                            this.orderSuccess = true;
                            this.orderId = response.data.data.order_number;
                            
                            // Show success message
                            const successMsg = this.locale === 'ar' 
                                ? `🎉 تم إرسال طلبك! رقم الطلب: ${this.orderId}. سيتم التوصيل خلال 30 دقيقة.`
                                : `🎉 Order placed! Order #${this.orderId}. Delivery in 30 minutes.`;
                            alert(successMsg);

                            // Clear cart and close modal
                            this.cart = [];
                            this.cartOpen = false;
                            this.promoApplied = false;
                            this.promoCode = '';
                            
                            // Auto-dismiss success message after 3 seconds
                            setTimeout(() => {
                                this.orderSuccess = false;
                            }, 3000);
                        }
                    } catch (error) {
                        console.error('Order submission error:', error);
                        
                        if (error.response?.data?.message) {
                            this.orderError = error.response.data.message;
                        } else if (error.response?.status === 422) {
                            // Validation errors
                            const errors = error.response.data.errors;
                            this.orderError = Object.values(errors).flat().join(', ');
                        } else {
                            this.orderError = this.locale === 'ar' 
                                ? 'حدث خطأ أثناء معالجة الطلب. يرجى المحاولة مرة أخرى.'
                                : 'Error processing order. Please try again.';
                        }

                        alert(`❌ ${this.orderError}`);
                    } finally {
                        this.isLoading = false;
                    }
                },

                createRipple(event) {
                    const btn = event.currentTarget;
                    const circle = document.createElement('span');
                    const rect = btn.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    circle.classList.add('ripple-circle');
                    circle.style.width = circle.style.height = size + 'px';
                    circle.style.left = (event.clientX - rect.left - size / 2) + 'px';
                    circle.style.top = (event.clientY - rect.top - size / 2) + 'px';
                    btn.appendChild(circle);
                    setTimeout(() => circle.remove(), 600);
                },

                flyToCart(event, imageSrc) {
                    const ghost = document.createElement('img');
                    ghost.src = imageSrc;
                    ghost.className = 'fly-ghost w-16 h-16 rounded-xl object-cover shadow-glow-amber';
                    const rect = event.target.closest('button, article')?.getBoundingClientRect() || event.target.getBoundingClientRect();
                    ghost.style.left = rect.left + 'px';
                    ghost.style.top = rect.top + 'px';
                    const cartBtn = document.querySelector('[x-text*="cart"], [x-text*="السلة"]')?.closest('button');
                    if (cartBtn) {
                        const cartRect = cartBtn.getBoundingClientRect();
                        ghost.style.setProperty('--fly-x', (cartRect.left - rect.left) + 'px');
                        ghost.style.setProperty('--fly-y', (cartRect.top - rect.top) + 'px');
                    }
                    document.getElementById('fly-container').appendChild(ghost);
                    setTimeout(() => ghost.remove(), 700);
                },

                async init() {
                    await this.fetchMenuItems();

                    this.$watch('searchQuery', (value) => {
                        if (value === '') {
                            this.fetchMenuItems();
                        }
                    });
                    
                    this.$nextTick(() => {
                        if (typeof gsap === 'undefined') return;
                        gsap.registerPlugin(ScrollTrigger);

                        // Hero entrance
                        gsap.timeline()
                            .to('.hero-badge', { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' })
                            .to('.hero-title', { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' }, '-=0.3')
                            .to('.hero-subtitle', { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' }, '-=0.4')
                            .to('.hero-cta', { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' }, '-=0.3')
                            .to('.hero-float-card', { opacity: 1, x: 0, duration: 0.8, ease: 'power3.out' }, '-=0.5');

                        gsap.set(['.hero-badge', '.hero-title', '.hero-subtitle', '.hero-cta'], { y: 30 });
                        gsap.set('.hero-float-card', { x: 60 });

                        // Hero parallax
                        gsap.to('[data-parallax="0.3"]', {
                            yPercent: 20, ease: 'none',
                            scrollTrigger: { trigger: '#hero', start: 'top top', end: 'bottom top', scrub: true },
                        });

                        // Showcase cards stagger
                        gsap.from('.showcase-card', {
                            scrollTrigger: { trigger: '#showcase', start: 'top 75%' },
                            y: 80, opacity: 0, duration: 0.8, stagger: 0.15, ease: 'power3.out',
                        });

                        // Menu items stagger
                        ScrollTrigger.batch('.menu-item', {
                            onEnter: batch => gsap.to(batch, { opacity: 1, y: 0, duration: 0.6, stagger: 0.08, ease: 'power2.out' }),
                            start: 'top 85%',
                        });
                        gsap.set('.menu-item', { y: 40 });

                        // Showcase parallax depth
                        document.querySelectorAll('[data-parallax-depth]').forEach(el => {
                            const depth = parseFloat(el.dataset.parallaxDepth);
                            gsap.to(el, {
                                y: -30 * depth * 10, ease: 'none',
                                scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true },
                            });
                        });
                    });
                },

                async fetchMenuItems() {
                    this.isLoading = true;
                    try {
                        const params = new URLSearchParams();
                        if (this.searchQuery && this.searchQuery.trim() !== '') {
                            params.append('search', this.searchQuery.trim());
                        }
                        if (this.activeCategory && this.activeCategory !== 'all') {
                            params.append('category_id', this.activeCategory);
                        }

                        const url = `${this.routes.getMenu}?${params.toString()}`;
                        const response = await fetch(url);
                        
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: Failed to fetch menu data`);
                        }
                        
                        const data = await response.json();

                        // Validate response has required data
                        if (!data.items || !Array.isArray(data.items)) {
                            throw new Error('Invalid menu data format: missing items array');
                        }

                        // Store the complete copy
                        this.allMenuItems = Object.freeze([...data.items]);
                        this.menuItems = this.allMenuItems;

                        // Merge categories if not yet fully loaded
                        if (data.categories && Array.isArray(data.categories) && this.categories.length <= 5) {
                            this.categories = [
                                { id: 'all', label: { ar: 'الكل', en: 'All' } },
                                ...data.categories.map(c => ({
                                    id: c.slug || c.id, 
                                    label: { ar: c.title, en: c.title }
                                }))
                            ];
                        }
                        
                    } catch (error) {
                        console.error('❌ Error fetching menu data:', error);
                        this.allMenuItems = Object.freeze([]);
                        this.menuItems = [];
                    } finally {
                        this.isLoading = false;
                    }
                },
            };
        }
    </script>

    @stack('scripts')
</body>
</html>