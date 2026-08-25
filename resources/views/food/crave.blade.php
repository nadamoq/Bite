<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
    x-data="craveApp()"
    x-init="init()"
    :dir="locale === 'ar' ? 'rtl' : 'ltr'"
    :lang="locale"
    class="scroll-smooth"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Crave Kitchen — {{ __('menu_page.hero.title2') }}. Order hot, delivered fast.">
    <title>Crave Kitchen | {{ __('menu_page.hero.title2') }}</title>

    <!-- Tailwind CSS -->
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

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

        /* FIRE / FLAME ANIMATIONS */
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

        .parallax-layer {
            will-change: transform;
        }

        .wood-section {
            background-image:
                url('https://images.unsplash.com/photo-1615874959470-d9b4c4d7e8c8?w=1920&q=80'),
                radial-gradient(ellipse at 20% 80%, rgba(139, 69, 19, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(245, 158, 11, 0.08) 0%, transparent 40%);
            background-size: cover, 100% 100%, 100% 100%;
            background-blend-mode: overlay, normal, normal;
        }

        .spice-dot {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .shimmer-text {
            background: linear-gradient(90deg, #fbbf24 0%, #fff 40%, #f59e0b 60%, #fbbf24 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s linear infinite;
        }

        .fly-ghost {
            position: fixed;
            z-index: 9999;
            pointer-events: none;
            animation: flyToCart 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #121214; }
        ::-webkit-scrollbar-thumb { background: #f59e0b; border-radius: 4px; }
        html[dir="rtl"] .flip-rtl { transform: scaleX(-1); }
    </style>

    <!-- Global Server Injected State & Lang Data -->
    <script>
        window.__MENU_PAGE_TRANSLATIONS = {
            ar: @json(trans('menu_page', [], 'ar')),
            en: @json(trans('menu_page', [], 'en'))
        };
        window.__INITIAL_FEATURED_DISH = @json($featuredDish ?? null);
        window.__INITIAL_SHOWCASE_DISHES = @json($showcaseDishes ?? []);
        window.__INITIAL_LOCALE = '{{ app()->getLocale() }}';
    </script>
</head>

<body class="bg-charcoal-950 text-white font-sans antialiased overflow-x-hidden"
      :class="locale === 'ar' ? 'font-arabic' : ''">

    <!-- ═══════════════════════════════════════════════════════════════
         HEADER / NAVIGATION
    ═══════════════════════════════════════════════════════════════ -->
    <header class="fixed top-0 inset-x-0 z-50 backdrop-blur-xl bg-charcoal-950/80 border-b border-amber-glow/10">
        <nav class="max-w-7xl mx-auto px-6 lg:px-10 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-glow to-crimson-cta flex items-center justify-center shadow-glow-amber group-hover:scale-105 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                </div>
                <span class="font-display text-2xl font-black tracking-tight">
                    <span class="text-amber-warm">Crave</span><span class="text-white/90">Kitchen</span>
                </span>
            </a>

            <!-- Nav Links -->
            <ul class="hidden lg:flex items-center gap-10 text-sm font-medium text-white/70">
                <li><a href="#menu" class="hover:text-amber-warm transition-colors" x-text="t('nav.menu')"></a></li>
                <li><a href="#showcase" class="hover:text-amber-warm transition-colors" x-text="t('nav.specials')"></a></li>
                <li><a href="#about" class="hover:text-amber-warm transition-colors" x-text="t('nav.story')"></a></li>
            </ul>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <button @click="toggleLocale()"
                        class="px-3 py-1.5 rounded-lg border border-white/10 text-xs font-semibold uppercase tracking-wider hover:border-amber-glow/50 hover:text-amber-warm transition-all cursor-pointer"
                        x-text="locale === 'ar' ? 'EN' : 'عربي'">
                </button>

                <button @click="cartOpen = true"
                        class="relative btn-ripple px-5 py-2.5 rounded-xl bg-charcoal-800 border border-amber-glow/20 hover:border-amber-glow/50 hover:shadow-glow-amber transition-all flex items-center gap-2 cursor-pointer"
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
        <!-- ═══════════════════════════════════════════════════════════════
             1. HERO SECTION (WITH FIRE EFFECT)
        ═══════════════════════════════════════════════════════════════ -->
        <section id="hero" class="relative min-h-screen flex items-center overflow-hidden">
            <div class="absolute inset-0 parallax-layer" data-parallax="0.3">
                <div class="absolute inset-0 bg-hero-burger bg-cover bg-center scale-110"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-charcoal-950/70 to-charcoal-950/40"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-charcoal-950/90 via-transparent to-charcoal-950/60"></div>
            </div>

            <!-- Steam Particles -->
            <div class="absolute top-1/3 start-1/2 -translate-x-1/2 pointer-events-none">
                <template x-for="i in 5" :key="i">
                    <div class="steam-particle absolute w-16 h-16 rounded-full bg-white/5 blur-xl"
                         :style="`left: ${(i-3)*40}px; animation-delay: ${i*0.4}s`"></div>
                </template>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 pt-32 pb-20 w-full">
                <div class="max-w-3xl">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-amber-glow/10 border border-amber-glow/30 text-amber-warm text-xs font-bold uppercase tracking-[0.2em] mb-6 hero-badge opacity-0">
                        <span x-text="t('hero.badge')"></span>
                    </span>

                    <h1 class="font-display text-5xl md:text-6xl xl:text-7xl font-black leading-[1.05] mb-4 hero-title opacity-0">
                        <span class="inline-flex items-center gap-3 text-white">
                            <span x-text="t('hero.title1')"></span>
                            
                            <!-- Animated Flame -->
                            <div class="fire-container relative inline-block align-middle w-12 h-12 md:w-16 md:h-16">
                                <span class="spark" style="left: 20%; --spark-x: -12px; animation-delay: 0.1s;"></span>
                                <span class="spark" style="left: 50%; --spark-x: 10px; animation-delay: 0.4s;"></span>
                                <span class="spark" style="left: 70%; --spark-x: -8px; animation-delay: 0.8s;"></span>

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
                                class="btn-ripple group relative px-8 py-4 rounded-2xl bg-gradient-to-r from-crimson-cta to-amber-fire text-white font-bold text-lg shadow-glow-red hover:shadow-glow-amber hover:scale-[1.03] transition-all duration-300 cursor-pointer"
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

                <!-- Floating Hero Food Card -->
                <div class="hidden xl:block absolute bottom-20 end-10 w-80 hero-float-card opacity-0">
                    <div class="relative rounded-3xl overflow-hidden shadow-food-depth border border-amber-glow/20 animate-float cursor-pointer"
                         @click="featuredDish && openCustomizer(featuredDish)">
                        <img :src="featuredDish ? featuredDish.image : 'https://images.unsplash.com/photo-1568901346715-366b9e2d4f4d?w=600&q=90'"
                             alt="Signature Dish" class="w-full h-52 object-cover sizzle-effect">
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 inset-x-0 p-5">
                            <span class="text-amber-warm text-xs font-bold uppercase tracking-wider" x-text="t('hero.featured')"></span>
                            <h3 class="font-display text-xl font-bold mt-1" x-text="featuredDish ? (featuredDish.name[locale] || featuredDish.name) : t('hero.featuredName')"></h3>
                            <p class="text-amber-warm font-bold text-lg mt-1" x-text="'$' + (featuredDish ? featuredDish.price.toFixed(2) : '18.99')"></p>
                        </div>
                        <div class="cheese-layer absolute bottom-16 start-1/2 -translate-x-1/2 w-24 h-3 bg-amber-warm/60 rounded-full blur-sm"></div>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-8 inset-x-0 flex justify-center animate-bounce">
                <div class="w-6 h-10 rounded-full border-2 border-white/20 flex justify-center pt-2">
                    <div class="w-1 h-2 bg-amber-warm rounded-full"></div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             2. SENSORY SHOWCASE
        ═══════════════════════════════════════════════════════════════ -->
        <section id="showcase" class="relative py-28 wood-section overflow-hidden">
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

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                    <!-- Featured Dish Spotlight -->
                    <div class="lg:col-span-5" x-show="featuredDish">
                        <div class="text-start mb-6">
                            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-gradient-to-r from-crimson-cta/30 to-amber-fire/20 border border-amber-glow/20 text-amber-warm text-xs font-black uppercase tracking-wider animate-pulse">
                                <span>🏆</span> <span x-text="t('showcase.bestseller_badge')"></span>
                            </span>
                        </div>
                        <article class="group relative rounded-3xl overflow-hidden shadow-card-float border border-amber-glow/30 hover:border-amber-glow/60 transition-all duration-500 hover:-translate-y-2 cursor-pointer"
                                 @click="openCustomizer(featuredDish)">
                            <div class="aspect-[4/5] overflow-hidden">
                                <img :src="featuredDish ? featuredDish.image : ''" :alt="featuredDish ? (featuredDish.name[locale] || featuredDish.name) : ''"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 sizzle-effect">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-charcoal-950/40 to-transparent"></div>
                            
                            <div class="absolute top-1/3 start-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="steam-particle w-16 h-16 rounded-full bg-white/10 blur-xl animate-steam-rise"></div>
                            </div>

                            <div class="absolute bottom-0 inset-x-0 p-8">
                                <h3 class="font-display text-3xl font-black mb-2 text-amber-warm" x-text="featuredDish ? (featuredDish.name[locale] || featuredDish.name) : ''"></h3>
                                <p class="text-white/70 text-base mb-4 line-clamp-3" x-text="featuredDish ? (featuredDish.desc ? featuredDish.desc[locale] : featuredDish.description) : ''"></p>
                                <div class="flex items-center justify-between">
                                    <span class="text-white font-black text-2xl" x-text="'$' + (featuredDish ? featuredDish.price.toFixed(2) : '0.00')"></span>
                                    <button class="btn-ripple w-12 h-12 rounded-full bg-amber-glow text-charcoal-950 flex items-center justify-center hover:bg-amber-warm transition-colors shadow-glow-amber cursor-pointer"
                                            @click.stop="quickAdd(featuredDish, $event)">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Category Recommendations -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6" :class="featuredDish ? 'lg:col-span-7' : 'lg:col-span-12 sm:grid-cols-2 md:grid-cols-3'">
                        <template x-for="(dish, index) in showcaseDishes" :key="dish.id">
                            <article class="showcase-card group relative rounded-3xl overflow-hidden shadow-card-float border border-white/5 hover:border-amber-glow/30 transition-all duration-500 hover:-translate-y-2 cursor-pointer"
                                     @click="openCustomizer(dish)">
                                <div class="aspect-square overflow-hidden">
                                    <img :src="dish.image" :alt="dish.name[locale] || dish.name"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 sizzle-effect">
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-charcoal-950/20 to-transparent"></div>

                                <span class="absolute top-4 start-4 px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-wider"
                                      :class="dish.badgeClass || 'bg-amber-glow/30 text-amber-warm backdrop-blur-md'"
                                      x-text="dish.badge ? (dish.badge[locale] || dish.badge) : t('badges.' + (dish.badges?.[0] || 'bestseller'))"></span>

                                <div class="absolute bottom-0 inset-x-0 p-5">
                                    <h3 class="font-display text-xl font-bold mb-1" x-text="dish.name[locale] || dish.name"></h3>
                                    <p class="text-white/50 text-xs mb-3 line-clamp-2" x-text="dish.desc ? dish.desc[locale] : dish.description"></p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-amber-warm font-bold text-base" x-text="'$' + dish.price.toFixed(2)"></span>
                                        <button class="btn-ripple w-9 h-9 rounded-full bg-crimson-cta/90 flex items-center justify-center hover:bg-crimson-cta transition-colors shadow-glow-red cursor-pointer"
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

        <!-- ═══════════════════════════════════════════════════════════════
             3. MENU & LIVE FILTER RAIL
        ═══════════════════════════════════════════════════════════════ -->
        <section id="menu" class="py-28 bg-charcoal-900 relative">
            <div class="max-w-7xl mx-auto px-6 lg:px-10">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12 menu-header">
                    <div>
                        <span class="text-amber-warm text-xs font-bold uppercase tracking-[0.25em]" x-text="t('menu.label')"></span>
                        <h2 class="font-display text-4xl md:text-5xl font-black mt-3" x-text="t('menu.title')"></h2>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 items-center w-full lg:w-auto">
                        <div class="relative w-full sm:w-64">
                            <input type="text"
                                   x-model="searchQuery"
                                   :placeholder="t('menu.search_placeholder')"
                                   class="w-full px-4 py-2.5 pe-10 rounded-xl bg-charcoal-800 border border-white/10 text-sm focus:outline-none focus:border-amber-glow/40 placeholder:text-white/30 text-white">
                            
                            <button x-show="searchQuery.length > 0"
                                    @click="searchQuery = ''"
                                    class="absolute top-1/2 -translate-y-1/2 text-white/50 hover:text-white cursor-pointer"
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
                                        class="flex-shrink-0 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 border cursor-pointer"
                                        :class="activeCategory === cat.id
                                            ? 'bg-amber-glow/15 border-amber-glow/40 text-amber-warm shadow-glow-amber'
                                            : 'bg-charcoal-800 border-white/5 text-white/50 hover:border-amber-glow/20 hover:text-white/80'"
                                        x-text="cat.label ? cat.label[locale] : (cat.title || cat.name)">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Menu Items Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <template x-for="item in filteredMenu" :key="item.id">
                        <article class="food-card group relative rounded-2xl bg-charcoal-800/60 border border-white/5 overflow-hidden hover:border-amber-glow/25 hover:shadow-food-depth transition-all duration-500 cursor-pointer"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 @click="openCustomizer(item)">
                            <div class="relative aspect-square overflow-hidden">
                                <img :src="item.image" :alt="item.name[locale] || item.name"
                                     class="food-image w-full h-full object-cover transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-900/80 via-transparent to-transparent"></div>

                                <div class="absolute top-3 start-3 flex flex-wrap gap-1.5">
                                    <template x-for="badge in (item.badges || [])" :key="badge">
                                        <span class="px-2 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wide backdrop-blur-md"
                                              :class="badgeStyles[badge]?.class || 'bg-white/10 text-white/70'"
                                              x-text="t('badges.' + badge) || badge"></span>
                                    </template>
                                </div>

                                <button @click.stop="quickAdd(item, $event)"
                                        class="absolute bottom-3 end-3 btn-ripple w-11 h-11 rounded-xl bg-crimson-cta flex items-center justify-center opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-glow-red hover:scale-110 cursor-pointer"
                                        @mousedown="createRipple($event)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>

                                <div class="cheese-layer absolute bottom-0 inset-x-0 h-8 bg-gradient-to-t from-amber-warm/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>

                            <div class="p-5">
                                <h3 class="font-semibold text-lg mb-1 group-hover:text-amber-warm transition-colors" x-text="item.name[locale] || item.name"></h3>
                                <p class="text-white/40 text-sm line-clamp-2 mb-3" x-text="item.desc ? item.desc[locale] : item.description"></p>
                                <div class="flex items-center justify-between">
                                    <span class="text-amber-warm font-bold text-lg" x-text="'$' + item.price.toFixed(2)"></span>
                                    <div class="flex items-center gap-1 text-amber-warm/80">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-xs font-medium" x-text="item.rating || '4.8'"></span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </template>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             ABOUT STRIP
        ═══════════════════════════════════════════════════════════════ -->
        <section id="about" class="py-20 bg-gradient-to-r from-charcoal-950 via-charcoal-800 to-charcoal-950 border-y border-amber-glow/10">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="font-display text-3xl md:text-4xl font-black mb-4" x-text="t('about.title')"></h2>
                <p class="text-white/50 text-lg mb-8" x-text="t('about.subtitle')"></p>
                <button @click="cartOpen = true"
                        class="btn-ripple px-10 py-4 rounded-2xl bg-gradient-to-r from-amber-glow to-amber-fire text-charcoal-950 font-bold text-lg hover:scale-105 transition-transform shadow-glow-amber cursor-pointer"
                        @mousedown="createRipple($event)"
                        x-text="t('about.cta')">
                </button>
            </div>
        </section>
    </main>

    <!-- ═══════════════════════════════════════════════════════════════
         4. CUSTOMIZER MODAL
    ═══════════════════════════════════════════════════════════════ -->
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

        <div class="absolute inset-0 bg-charcoal-950/85 backdrop-blur-sm" @click="modalOpen = false"></div>

        <div x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300 delay-75"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-3xl bg-charcoal-800 border border-amber-glow/20 shadow-food-depth">

            <template x-if="selectedItem">
                <div class="grid md:grid-cols-2">
                    <!-- Image Zoom -->
                    <div class="relative aspect-square md:aspect-auto md:min-h-[480px] overflow-hidden">
                        <img :src="selectedItem.image" :alt="selectedItem.name[locale] || selectedItem.name"
                             class="w-full h-full object-cover sizzle-effect transition-transform duration-500"
                             :class="customizerZoom ? 'scale-125' : 'scale-100'"
                             @mouseenter="customizerZoom = true"
                             @mouseleave="customizerZoom = false">
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-800/60 to-transparent md:bg-none"></div>
                        <button @click="modalOpen = false"
                                class="absolute top-4 end-4 w-10 h-10 rounded-full bg-charcoal-950/70 backdrop-blur flex items-center justify-center hover:bg-charcoal-950 transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Customizer Controls -->
                    <div class="p-6 lg:p-8 flex flex-col justify-between">
                        <div>
                            <span class="text-amber-warm text-xs font-bold uppercase tracking-wider" x-text="t('modal.customize')"></span>
                            <h3 class="font-display text-3xl font-black mt-2 mb-2" x-text="selectedItem.name[locale] || selectedItem.name"></h3>
                            <p class="text-white/50 text-sm mb-6" x-text="selectedItem.desc ? selectedItem.desc[locale] : selectedItem.description"></p>

                            <!-- Addons Grouped -->
                            <div class="space-y-6 mb-6">
                                <template x-for="addonCategory in (selectedItem?.addon_categories || defaultAddonCategories)" :key="addonCategory.id">
                                    <div class="space-y-3">
                                        <h4 class="text-sm font-semibold text-amber-warm/80 uppercase tracking-wide" x-text="addonCategory.name[locale] || addonCategory.name"></h4>
                                        <div class="space-y-2">
                                            <template x-for="addon in addonCategory.addons" :key="addon.id">
                                                <label class="flex items-center justify-between p-3.5 rounded-xl bg-charcoal-900/60 border border-white/5 hover:border-amber-glow/20 cursor-pointer transition-all"
                                                       :class="selectedAddons.includes(addon.id) ? 'border-amber-glow/40 bg-amber-glow/5' : ''">
                                                    <div class="flex items-center gap-3.5">
                                                        <img :src="addon.image" :alt="addon.name[locale] || addon.name" class="w-12 h-12 rounded-lg object-cover">
                                                        <div>
                                                            <span class="font-semibold text-sm" x-text="addon.name[locale] || addon.name"></span>
                                                            <span class="block text-amber-warm/70 text-xs mt-0.5" x-text="'+' + '$' + addon.price.toFixed(2)"></span>
                                                        </div>
                                                    </div>
                                                    <input type="checkbox"
                                                           :value="addon.id"
                                                           @change="toggleAddon(addon.id)"
                                                           :checked="selectedAddons.includes(addon.id)"
                                                           class="w-5 h-5 rounded accent-amber-glow cursor-pointer">
                                                </label>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Cheese Pull Switch -->
                            <div class="flex items-center justify-between p-4 rounded-xl bg-charcoal-900/60 border border-white/5 mb-6">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🧀</span>
                                    <div>
                                        <span class="font-semibold text-sm" x-text="t('modal.cheesePull')"></span>
                                        <span class="block text-white/40 text-xs" x-text="t('modal.cheesePullDesc')"></span>
                                    </div>
                                </div>
                                <button @click="cheesePull = !cheesePull"
                                        class="relative w-12 h-7 rounded-full transition-colors cursor-pointer"
                                        :class="cheesePull ? 'bg-amber-glow' : 'bg-charcoal-700'">
                                    <span class="absolute top-0.5 w-6 h-6 rounded-full bg-white shadow transition-all"
                                          :class="cheesePull ? 'start-5' : 'start-0.5'"></span>
                                </button>
                            </div>
                        </div>

                        <!-- Quantity and Submit -->
                        <div class="border-t border-white/5 pt-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <button @click="modalQty = Math.max(1, modalQty - 1)"
                                            class="w-10 h-10 rounded-xl bg-charcoal-900 border border-white/10 flex items-center justify-center hover:border-amber-glow/30 transition-colors font-bold cursor-pointer">−</button>
                                    <span class="text-xl font-bold w-8 text-center" x-text="modalQty"></span>
                                    <button @click="modalQty++"
                                            class="w-10 h-10 rounded-xl bg-charcoal-900 border border-white/10 flex items-center justify-center hover:border-amber-glow/30 transition-colors font-bold cursor-pointer">+</button>
                                </div>
                                <div class="text-end">
                                    <span class="text-white/40 text-xs" x-text="t('modal.total')"></span>
                                    <p class="text-amber-warm font-black text-2xl" x-text="'$' + modalTotal.toFixed(2)"></p>
                                </div>
                            </div>
                            <button @click="addCustomizedToCart()"
                                    class="btn-ripple w-full py-4 rounded-2xl bg-gradient-to-r from-crimson-cta to-amber-fire font-bold text-lg shadow-glow-red hover:shadow-glow-amber transition-all hover:scale-[1.02] cursor-pointer"
                                    @mousedown="createRipple($event)"
                                    x-text="t('modal.addToCart') + ' — $' + modalTotal.toFixed(2)">
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════
         5. STICKY CART DRAWER
    ═══════════════════════════════════════════════════════════════ -->
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
             class="absolute inset-0 bg-charcoal-950/80 backdrop-blur-sm"
             @click="cartOpen = false"></div>

        <div x-show="cartOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="ltr:translate-x-full rtl:-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="ltr:translate-x-full rtl:-translate-x-full"
             class="absolute inset-y-0 end-0 w-full max-w-md bg-charcoal-900 border-s border-amber-glow/15 shadow-2xl flex flex-col">

            <!-- Cart Header -->
            <div class="p-6 border-b border-white/5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-glow/10 border border-amber-glow/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-warm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-display text-xl font-bold" x-text="t('cart.title')"></h3>
                        <span class="text-white/40 text-xs" x-text="cartCount + ' ' + t('cart.items')"></span>
                    </div>
                </div>
                <button @click="cartOpen = false" class="w-9 h-9 rounded-xl bg-charcoal-800 flex items-center justify-center hover:bg-charcoal-700 transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Cart Body -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4">
                <template x-if="cart.length === 0">
                    <div class="h-full flex flex-col items-center justify-center text-center py-16">
                        <span class="text-5xl mb-4">🛒</span>
                        <p class="text-white/40 text-sm" x-text="t('cart.empty')"></p>
                    </div>
                </template>

                <template x-for="item in cart" :key="item.cartId">
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-charcoal-800/60 border border-white/5">
                        <img :src="item.image" :alt="item.name[locale] || item.name" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-sm truncate" x-text="item.name[locale] || item.name"></h4>
                            <p class="text-white/40 text-xs truncate" x-show="item.customizationsText" x-text="item.customizationsText"></p>
                            <span class="text-amber-warm font-bold text-sm" x-text="'$' + (item.price * item.quantity).toFixed(2)"></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="updateCartQty(item.cartId, -1)" class="w-7 h-7 rounded-lg bg-charcoal-700 flex items-center justify-center hover:bg-charcoal-600 transition-colors cursor-pointer">−</button>
                            <span class="text-sm font-bold w-5 text-center" x-text="item.quantity"></span>
                            <button @click="updateCartQty(item.cartId, 1)" class="w-7 h-7 rounded-lg bg-charcoal-700 flex items-center justify-center hover:bg-charcoal-600 transition-colors cursor-pointer">+</button>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Cart Footer -->
            <div class="p-6 border-t border-white/5 space-y-4 bg-charcoal-950/50" x-show="cart.length > 0">
                <div class="flex gap-2">
                    <input type="text"
                           x-model="promoCode"
                           :placeholder="t('cart.promoPlaceholder')"
                           class="flex-1 px-4 py-2.5 rounded-xl bg-charcoal-800 border border-white/10 text-xs focus:outline-none focus:border-amber-glow/40 uppercase tracking-wider text-white">
                    <button @click="applyPromo()"
                            class="px-5 py-2.5 rounded-xl bg-charcoal-700 hover:bg-amber-glow hover:text-charcoal-950 text-xs font-bold transition-colors cursor-pointer"
                            x-text="t('cart.apply')">
                    </button>
                </div>
                <div x-show="promoApplied" class="text-green-400 text-xs font-semibold" x-text="t('cart.promoSuccess')"></div>

                <div class="space-y-2 text-sm text-white/60">
                    <div class="flex justify-between">
                        <span x-text="t('cart.subtotal')"></span>
                        <span class="text-white font-medium" x-text="'$' + cartSubtotal.toFixed(2)"></span>
                    </div>
                    <div x-show="promoApplied" class="flex justify-between text-green-400">
                        <span x-text="t('cart.discount')"></span>
                        <span x-text="'-$' + cartDiscount.toFixed(2)"></span>
                    </div>
                    <div class="flex justify-between">
                        <span x-text="t('cart.delivery')"></span>
                        <span class="text-white font-medium" x-text="cartDelivery === 0 ? t('cart.free') : '$' + cartDelivery.toFixed(2)"></span>
                    </div>
                    <div class="flex justify-between text-base font-bold text-white pt-2 border-t border-white/5">
                        <span x-text="t('cart.total')"></span>
                        <span class="text-amber-warm font-black text-xl" x-text="'$' + cartFinalTotal.toFixed(2)"></span>
                    </div>
                </div>

                <button @click="checkout()"
                        :disabled="isSubmittingOrder"
                        class="btn-ripple w-full py-4 rounded-2xl bg-gradient-to-r from-crimson-cta to-amber-fire text-white font-bold text-lg shadow-glow-red hover:shadow-glow-amber transition-all hover:scale-[1.02] cursor-pointer disabled:opacity-50"
                        @mousedown="createRipple($event)">
                    <span x-show="!isSubmittingOrder" x-text="t('cart.checkout') + ' — $' + cartFinalTotal.toFixed(2)"></span>
                    <span x-show="isSubmittingOrder">...</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════
         6. TOAST NOTIFICATION
    ═══════════════════════════════════════════════════════════════ -->
    <div x-show="toast.visible"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-8 scale-90"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-8 scale-90"
         class="fixed bottom-6 start-6 z-[120] flex items-center gap-3 px-5 py-3.5 rounded-2xl bg-charcoal-800/95 border border-amber-glow/30 backdrop-blur-xl shadow-glow-amber">
        <span class="text-xl" x-text="toast.icon"></span>
        <span class="text-sm font-semibold text-white" x-text="toast.message"></span>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════
         7. RECEIPT MODAL
    ═══════════════════════════════════════════════════════════════ -->
    <div x-show="receiptOpen"
         x-cloak
         class="fixed inset-0 z-[130] flex items-center justify-center p-4"
         @keydown.escape.window="receiptOpen = false">
        <div class="absolute inset-0 bg-charcoal-950/90 backdrop-blur-md" @click="receiptOpen = false"></div>
        <div class="relative w-full max-w-lg rounded-3xl bg-charcoal-900 border border-amber-glow/30 shadow-2xl p-8 overflow-hidden">
            <div class="text-center mb-6">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-gradient-to-br from-green-500 to-amber-warm flex items-center justify-center text-white text-2xl shadow-glow-amber mb-3">✓</div>
                <h3 class="font-display text-2xl font-black text-white" x-text="locale === 'ar' ? 'تم تأكيد طلبك بنجاح!' : 'Order Confirmed!'"></h3>
                <p class="text-amber-warm font-mono text-sm mt-1" x-text="lastOrder ? ('#' + lastOrder.order_number) : ''"></p>
            </div>
            <div class="bg-charcoal-800/70 rounded-2xl p-5 border border-white/5 space-y-3 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-white/60" x-text="locale === 'ar' ? 'حالة الطلب' : 'Status'"></span>
                    <span class="text-green-400 font-bold uppercase tracking-wider text-xs">Pending / قيد التحضير</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-white/60" x-text="locale === 'ar' ? 'المجموع المدفوع' : 'Total Paid'"></span>
                    <span class="text-amber-warm font-bold text-base" x-text="'$' + (lastOrder ? lastOrder.total_price.toFixed(2) : '0.00')"></span>
                </div>
            </div>
            <button @click="receiptOpen = false"
                    class="btn-ripple w-full py-3.5 rounded-xl bg-charcoal-700 hover:bg-charcoal-600 text-white font-bold transition-colors cursor-pointer">
                <span x-text="locale === 'ar' ? 'إغلاق ومتابعة التسوق' : 'Close & Continue Shopping'"></span>
            </button>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════════
         ALPINE.JS CLEAN APP CORE
    ═══════════════════════════════════════════════════════════════ -->
    <script>
        function craveApp() {
            return {
                locale: window.__INITIAL_LOCALE || 'ar',
                cartOpen: false,
                modalOpen: false,
                receiptOpen: false,
                isSubmittingOrder: false,
                searchQuery: '',
                activeCategory: 'all',
                selectedItem: null,
                selectedAddons: [],
                cheesePull: false,
                modalQty: 1,
                customizerZoom: false,
                promoCode: '',
                promoApplied: false,
                cart: [],
                lastOrder: null,
                toast: { visible: false, message: '', icon: '🔥' },

                // Translations injected from server lang files
                translations: window.__MENU_PAGE_TRANSLATIONS || {},

                // Featured Dishes from Controller Action
                featuredDish: window.__INITIAL_FEATURED_DISH || null,
                showcaseDishes: window.__INITIAL_SHOWCASE_DISHES || [],

                // Categories
                categories: [
                    { id: 'all', label: { ar: 'الكل', en: 'All' } },
                    { id: 'burgers', label: { ar: 'برجر', en: 'Burgers' } },
                    { id: 'pizza', label: { ar: 'بيتزا', en: 'Pizza' } },
                    { id: 'grills', label: { ar: 'مشويات', en: 'Grills' } },
                    { id: 'sides', label: { ar: 'مقبلات وجوانب', en: 'Sides & Elevates' } },
                ],

                // Fallback default addon categories
                defaultAddonCategories: [
                    {
                        id: 1,
                        name: { ar: 'صلصات فاخرة', en: 'Gourmet Sauces' },
                        addons: [
                            { id: 1, name: { ar: 'صوص باربكيو مدخن', en: 'Smoky BBQ Sauce' }, price: 1.50, image: 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=200&q=80' },
                            { id: 2, name: { ar: 'ثومية مع أعشاب برية', en: 'Garlic Herb Aioli' }, price: 1.50, image: 'https://images.unsplash.com/photo-1472476443507-c7a5948772fc?w=200&q=80' },
                            { id: 3, name: { ar: 'مايونيز الكمأة السوداء', en: 'Black Truffle Mayo' }, price: 2.50, image: 'https://images.unsplash.com/photo-1544025162-d76694265947?w=200&q=80' },
                        ]
                    },
                    {
                        id: 2,
                        name: { ar: 'إضافات مقرمشة', en: 'Premium Toppings' },
                        addons: [
                            { id: 4, name: { ar: 'بيكون بقري مقرمش', en: 'Crispy Beef Bacon' }, price: 2.50, image: 'https://images.unsplash.com/photo-1528607929212-2636ec44253e?w=200&q=80' },
                            { id: 5, name: { ar: 'هالبينو مشوي حار', en: 'Grilled Jalapeños' }, price: 1.25, image: 'https://images.unsplash.com/photo-1568901346715-366b9e2d4f4d?w=200&q=80' },
                            { id: 6, name: { ar: 'بصل مكرمل متبل', en: 'Caramelized Onions' }, price: 1.50, image: 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=200&q=80' },
                        ]
                    }
                ],

                // All Menu Items (Master list)
                allMenuItems: [],

                // Badge Styles
                badgeStyles: {
                    'bestseller': { ar: 'الأكثر مبيعاً', en: 'Bestseller', class: 'bg-green-500/30 text-green-200 backdrop-blur-md' },
                    'chef-special': { ar: 'طبق الشيف', en: "Chef's Special", class: 'bg-purple-500/30 text-purple-200 backdrop-blur-md' },
                    'crispy-hot': { ar: 'مقرمش وساخن', en: 'Crispy & Hot', class: 'bg-crimson-cta/30 text-crimson-hot backdrop-blur-md' },
                    'extra-cheese': { ar: 'جبنة إضافية', en: 'Extra Cheese', class: 'bg-amber-glow/30 text-amber-warm backdrop-blur-md' },
                },

                // Translation lookup helper
                t(key) {
                    const keys = key.split('.');
                    let current = this.translations[this.locale];
                    for (const k of keys) {
                        if (current && current[k] !== undefined) {
                            current = current[k];
                        } else {
                            return key;
                        }
                    }
                    return current;
                },

                toggleLocale() {
                    this.locale = this.locale === 'ar' ? 'en' : 'ar';
                    document.documentElement.dir = this.locale === 'ar' ? 'rtl' : 'ltr';
                    document.documentElement.lang = this.locale;
                },

                init() {
                    this.fetchMenuItems();
                    this.initAnimations();
                },

                async fetchMenuItems() {
                    try {
                        const response = await fetch('/api/menuitems');
                        if (response.ok) {
                            const data = await response.json();
                            if (data.items && data.items.length > 0) {
                                this.allMenuItems = data.items;
                                if (data.categories && data.categories.length > 0) {
                                    const cats = [{ id: 'all', label: { ar: 'الكل', en: 'All' } }];
                                    data.categories.forEach(c => {
                                        cats.push({
                                            id: c.slug || c.id,
                                            label: { ar: c.title || c.name, en: c.title || c.name }
                                        });
                                    });
                                    this.categories = cats;
                                }
                                return;
                            }
                        }
                    } catch (e) {
                        console.log('API fallback initialized');
                    }

                    // Fallback items if API is offline
                    this.allMenuItems = [
                        {
                            id: 1,
                            category: 'burgers',
                            price: 18.99,
                            image: 'https://images.unsplash.com/photo-1568901346715-366b9e2d4f4d?w=600&q=90',
                            name: { ar: 'برجر الوحش المزدوج', en: 'Double Monster Burger' },
                            desc: { ar: 'قطعتان من لحم الأنجوس الفاخر، صوص الشواء المدخن، جبنة شيدر مضاعفة تذوب بسخونة على الخبز الطري.', en: 'Two premium Angus beef patties, smoky BBQ sauce, double melted cheddar on a brioche bun.' },
                            rating: '4.9',
                            badges: ['bestseller', 'crispy-hot']
                        },
                        {
                            id: 2,
                            category: 'pizza',
                            price: 16.50,
                            image: 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=600&q=90',
                            name: { ar: 'بيتزا مارغريتا نابوليتان', en: 'Neapolitan Margherita' },
                            desc: { ar: 'صلصة طماطم سان مارزانو، جبنة موزاريلا فريش، ريحان إيطالي وزيت زيتون بكر ممتاز.', en: 'San Marzano tomato sauce, fresh mozzarella, Italian basil, and extra virgin olive oil.' },
                            rating: '4.8',
                            badges: ['extra-cheese']
                        },
                        {
                            id: 3,
                            category: 'grills',
                            price: 24.00,
                            image: 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600&q=90',
                            name: { ar: 'ريش لحم ضأن مدخنة', en: 'Smoked Lamb Ribs' },
                            desc: { ar: 'ريش لحم ضأن طرية مدخنة ببطء على خشب القيقب ومدهونة بتتبيلة الشيف الخاصة.', en: 'Slow-smoked tender lamb ribs glazed with chef’s signature spicy honey rub.' },
                            rating: '4.9',
                            badges: ['chef-special']
                        },
                        {
                            id: 4,
                            category: 'sides',
                            price: 8.50,
                            image: 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=600&q=90',
                            name: { ar: 'بطاطس ترافل مع البارميزان', en: 'Truffle Parmesan Fries' },
                            desc: { ar: 'بطاطس مقرمشة متبلة بزيت الكمأة الفاخر وجبنة البارميزان المعتقة مع صوص الثومية.', en: 'Crispy fries tossed with luxury truffle oil, aged parmesan, and garlic herb aioli.' },
                            rating: '4.7',
                            badges: ['crispy-hot']
                        }
                    ];
                },

                get filteredMenu() {
                    let items = this.allMenuItems;
                    if (this.activeCategory !== 'all') {
                        items = items.filter(i => i.category === this.activeCategory || i.category_id == this.activeCategory);
                    }
                    if (this.searchQuery.trim() !== '') {
                        const q = this.searchQuery.toLowerCase().trim();
                        items = items.filter(i => {
                            const nameAr = (i.name?.ar || i.name || '').toLowerCase();
                            const nameEn = (i.name?.en || i.name || '').toLowerCase();
                            const descAr = (i.desc?.ar || i.description || '').toLowerCase();
                            const descEn = (i.desc?.en || i.description || '').toLowerCase();
                            return nameAr.includes(q) || nameEn.includes(q) || descAr.includes(q) || descEn.includes(q);
                        });
                    }
                    return items;
                },

                selectCategory(id) {
                    this.activeCategory = id;
                },

                scrollToMenu() {
                    const el = document.getElementById('menu');
                    if (el) el.scrollIntoView({ behavior: 'smooth' });
                },

                openCustomizer(item) {
                    this.selectedItem = item;
                    this.selectedAddons = [];
                    this.cheesePull = false;
                    this.modalQty = 1;
                    this.modalOpen = true;
                },

                toggleAddon(id) {
                    const idx = this.selectedAddons.indexOf(id);
                    if (idx > -1) {
                        this.selectedAddons.splice(idx, 1);
                    } else {
                        this.selectedAddons.push(id);
                    }
                },

                get modalTotal() {
                    if (!this.selectedItem) return 0;
                    let total = this.selectedItem.price;
                    const cats = this.selectedItem.addon_categories || this.defaultAddonCategories;
                    cats.forEach(c => {
                        (c.addons || []).forEach(a => {
                            if (this.selectedAddons.includes(a.id)) {
                                total += a.price;
                            }
                        });
                    });
                    if (this.cheesePull) total += 2.00;
                    return total * this.modalQty;
                },

                addCustomizedToCart() {
                    if (!this.selectedItem) return;
                    let unitPrice = this.selectedItem.price;
                    let customNames = [];
                    const cats = this.selectedItem.addon_categories || this.defaultAddonCategories;
                    cats.forEach(c => {
                        (c.addons || []).forEach(a => {
                            if (this.selectedAddons.includes(a.id)) {
                                unitPrice += a.price;
                                customNames.push(a.name[this.locale] || a.name);
                            }
                        });
                    });
                    if (this.cheesePull) {
                        unitPrice += 2.00;
                        customNames.push(this.t('modal.cheesePull'));
                    }

                    const cartId = this.selectedItem.id + '_' + this.selectedAddons.sort().join('-') + (this.cheesePull ? '_cp' : '');
                    const existing = this.cart.find(i => i.cartId === cartId);
                    if (existing) {
                        existing.quantity += this.modalQty;
                    } else {
                        this.cart.push({
                            cartId,
                            id: this.selectedItem.id,
                            name: this.selectedItem.name,
                            price: unitPrice,
                            image: this.selectedItem.image,
                            quantity: this.modalQty,
                            customizationsText: customNames.join(', '),
                            addon_ids: [...this.selectedAddons],
                            special_instructions: customNames.join(', ')
                        });
                    }

                    this.modalOpen = false;
                    this.showToast(this.t('toast.added_to_cart'), '🛒');
                },

                quickAdd(item, event) {
                    if (event) this.triggerFlyToCart(event, item.image);
                    const cartId = item.id + '_default';
                    const existing = this.cart.find(i => i.cartId === cartId);
                    if (existing) {
                        existing.quantity++;
                    } else {
                        this.cart.push({
                            cartId,
                            id: item.id,
                            name: item.name,
                            price: item.price,
                            image: item.image,
                            quantity: 1,
                            customizationsText: '',
                            addon_ids: [],
                            special_instructions: ''
                        });
                    }
                    this.showToast(this.t('toast.added_to_cart'), '🔥');
                },

                updateCartQty(cartId, delta) {
                    const idx = this.cart.findIndex(i => i.cartId === cartId);
                    if (idx > -1) {
                        this.cart[idx].quantity += delta;
                        if (this.cart[idx].quantity <= 0) {
                            this.cart.splice(idx, 1);
                        }
                    }
                },

                get cartCount() {
                    return this.cart.reduce((s, i) => s + i.quantity, 0);
                },

                get cartSubtotal() {
                    return this.cart.reduce((s, i) => s + (i.price * i.quantity), 0);
                },

                get cartDiscount() {
                    return this.promoApplied ? this.cartSubtotal * 0.10 : 0;
                },

                get cartDelivery() {
                    return this.cartSubtotal > 35 || this.cartSubtotal === 0 ? 0 : 3.50;
                },

                get cartFinalTotal() {
                    return Math.max(0, this.cartSubtotal - this.cartDiscount + this.cartDelivery);
                },

                applyPromo() {
                    if (this.promoCode.trim().toUpperCase() === 'CRAVE10') {
                        this.promoApplied = true;
                        this.showToast(this.t('cart.promoSuccess'), '🏷️');
                    } else {
                        this.showToast(this.t('cart.promoInvalid'), '⚠️');
                    }
                },

                async checkout() {
                    if (this.cart.length === 0) return;
                    this.isSubmittingOrder = true;

                    const payload = {
                        order_type: 'delivery',
                        promo_code: this.promoApplied ? 'CRAVE10' : null,
                        items: this.cart.map(item => ({
                            menuitem_id: item.id,
                            quantity: item.quantity,
                            unit_price: item.price,
                            special_instructions: item.special_instructions || null,
                            addon_ids: item.addon_ids || []
                        }))
                    };

                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                        const res = await fetch('/api/orders', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                            },
                            body: JSON.stringify(payload)
                        });

                        if (res.ok) {
                            const result = await res.json();
                            this.lastOrder = result.data;
                            this.cart = [];
                            this.cartOpen = false;
                            this.receiptOpen = true;
                            this.showToast(this.t('toast.order_success') + ' ' + (this.lastOrder.order_number || 'CRAVE'), '🎉');
                        } else {
                            throw new Error('Server returned ' + res.status);
                        }
                    } catch (err) {
                        // Prototype fallback confirmation
                        this.lastOrder = {
                            order_number: 'ORD-' + Math.random().toString(36).substring(2, 8).toUpperCase(),
                            total_price: this.cartFinalTotal,
                            status: 'pending'
                        };
                        this.cart = [];
                        this.cartOpen = false;
                        this.receiptOpen = true;
                        this.showToast(this.t('toast.order_success') + ' ' + this.lastOrder.order_number, '🎉');
                    } finally {
                        this.isSubmittingOrder = false;
                    }
                },

                showToast(message, icon = '🔥') {
                    this.toast = { visible: true, message, icon };
                    setTimeout(() => { this.toast.visible = false; }, 3000);
                },

                triggerFlyToCart(event, imgSrc) {
                    const btn = event.currentTarget;
                    const rect = btn.getBoundingClientRect();
                    const ghost = document.createElement('img');
                    ghost.src = imgSrc;
                    ghost.className = 'fly-ghost w-12 h-12 rounded-full object-cover shadow-glow-amber';
                    ghost.style.top = rect.top + 'px';
                    ghost.style.left = rect.left + 'px';
                    
                    const flyX = (window.innerWidth - 60) - rect.left;
                    const flyY = 20 - rect.top;
                    ghost.style.setProperty('--fly-x', flyX + 'px');
                    ghost.style.setProperty('--fly-y', flyY + 'px');

                    document.body.appendChild(ghost);
                    setTimeout(() => { ghost.remove(); }, 700);
                },

                createRipple(event) {
                    const button = event.currentTarget;
                    const circle = document.createElement('span');
                    const diameter = Math.max(button.clientWidth, button.clientHeight);
                    const radius = diameter / 2;
                    const rect = button.getBoundingClientRect();

                    circle.style.width = circle.style.height = `${diameter}px`;
                    circle.style.left = `${event.clientX - rect.left - radius}px`;
                    circle.style.top = `${event.clientY - rect.top - radius}px`;
                    circle.classList.add('ripple-circle');

                    const ripple = button.getElementsByClassName('ripple-circle')[0];
                    if (ripple) ripple.remove();
                    button.appendChild(circle);
                },

                initAnimations() {
                    if (typeof gsap !== 'undefined') {
                        gsap.to('.hero-badge', { opacity: 1, y: 0, duration: 0.8, delay: 0.2 });
                        gsap.to('.hero-title', { opacity: 1, y: 0, duration: 0.8, delay: 0.4 });
                        gsap.to('.hero-subtitle', { opacity: 1, y: 0, duration: 0.8, delay: 0.6 });
                        gsap.to('.hero-cta', { opacity: 1, y: 0, duration: 0.8, delay: 0.8 });
                        gsap.to('.hero-float-card', { opacity: 1, y: 0, duration: 1, delay: 0.9 });
                    }
                }
            };
        }
    </script>
</body>
</html>
