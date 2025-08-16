@extends('layouts.app')

@section('title', 'StumpZone - Premium Sports Gear')

@section('content')
<style>
    :root {
        --primary: #6C63FF;
        --secondary: #FF6584;
        --dark: #121212;
        --darker: #0A0A0A;
        --light: #E0E0E0;
        --lighter: #F5F5F5;
        --gradient: linear-gradient(135deg, #6C63FF 0%, #FF6584 100%);
        --card-bg: #1E1E1E;
        --text-dark: rgba(255,255,255,0.9);
        --text-light: rgba(255,255,255,0.7);
    }
    
    body {
        background-color: var(--dark);
        color: var(--text-dark);
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    
    /* Hero Section */
    .hero {
        position: relative;
        height: 100vh;
        min-height: 800px;
        overflow: hidden;
        width: 100%;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, rgba(10,10,10,0.95) 0%, rgba(18,18,18,0.9) 100%);
    }
    
    .hero-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
        filter: brightness(0.4);
    }
    
    /* Video selector controls */
    .video-selector {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        gap: 15px;
    }
    
    .video-option {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .video-option.active {
        background: var(--primary);
        transform: scale(1.2);
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 4rem;
        width: 100%;
    }
    
    .hero-title {
        font-size: 5rem;
        font-weight: 900;
        line-height: 1;
        margin-bottom: 2rem;
        background: linear-gradient(to right, #fff, #c9d6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    .hero-subtitle {
        font-size: 1.8rem;
        font-weight: 400;
        max-width: 700px;
        margin-bottom: 3rem;
        color: var(--text-light);
        line-height: 1.6;
    }
    
    .cta-button {
        display: inline-block;
        padding: 1.2rem 3rem;
        background: var(--gradient);
        color: white;
        font-weight: 700;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 15px 30px rgba(108, 99, 255, 0.3);
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        border: none;
        cursor: pointer;
    }
    
    .cta-button::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 100%);
        transform: translateX(-100%);
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    
    .cta-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(108, 99, 255, 0.4);
    }
    
    .cta-button:hover::after {
        transform: translateX(0);
    }
    
    /* Neon Accent Elements */
    .neon-accent {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }
    
    .neon-line {
        position: absolute;
        background: var(--gradient);
        opacity: 0.1;
        filter: blur(20px);
    }
    
    /* Sports Categories */
    .sports-section {
        padding: 8rem 4rem;
        background-color: var(--darker);
        position: relative;
    }
    
    .section-title {
        text-align: center;
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 5rem;
        color: var(--lighter);
        position: relative;
        display: inline-block;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient);
        border-radius: 2px;
    }
    
    .sports-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 3rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .sport-card {
        position: relative;
        height: 500px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: var(--card-bg);
        border: 1px solid rgba(255,255,255,0.05);
    }
    
    .sport-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 35px 60px -10px rgba(108, 99, 255, 0.2);
        border-color: rgba(108, 99, 255, 0.3);
    }
    
    .sport-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1s ease;
        opacity: 0.8;
    }
    
    .sport-card:hover .sport-image {
        transform: scale(1.05);
        opacity: 1;
    }
    
    .sport-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 3rem;
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 100%);
    }
    
    .sport-name {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }
    
    .sport-link {
        display: inline-flex;
        align-items: center;
        color: white;
        font-weight: 600;
        text-decoration: none;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        background: rgba(108, 99, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        border: 1px solid rgba(108, 99, 255, 0.3);
    }
    
    .sport-link:hover {
        background: rgba(108, 99, 255, 0.3);
        transform: translateX(5px);
    }
    
    .sport-link svg {
        margin-left: 0.8rem;
        transition: transform 0.3s ease;
    }
    
    .sport-link:hover svg {
        transform: translateX(8px);
    }
    
    /* Featured Products */
    .featured-section {
        padding: 8rem 4rem;
        background-color: var(--dark);
        position: relative;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 3rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .product-card {
        background: var(--card-bg);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 30px -10px rgba(0,0,0,0.2);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(255,255,255,0.05);
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -15px rgba(108, 99, 255, 0.2);
        border-color: rgba(108, 99, 255, 0.2);
    }
    
    .product-image-container {
        height: 300px;
        overflow: hidden;
        position: relative;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1s ease;
        opacity: 0.9;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.1);
        opacity: 1;
    }
    
    .product-info {
        padding: 2rem;
    }
    
    .product-category {
        display: inline-block;
        padding: 0.5rem 1.2rem;
        background: var(--gradient);
        color: white;
        font-size: 0.9rem;
        font-weight: 700;
        border-radius: 50px;
        margin-bottom: 1rem;
        letter-spacing: 0.5px;
    }
    
    .product-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
        line-height: 1.3;
        color: var(--lighter);
    }
    
    .product-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }
    
    .product-rating {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        color: var(--text-light);
    }
    
    .product-actions {
        display: flex;
        gap: 1rem;
    }
    
    .product-button {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        text-align: center;
        border: none;
        cursor: pointer;
    }
    
    .view-button {
        background: rgba(255,255,255,0.1);
        color: white;
        backdrop-filter: blur(5px);
    }
    
    .cart-button {
        background: var(--gradient);
        color: white;
    }
    
    .product-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    /* Testimonials */
    .testimonials-section {
        padding: 8rem 4rem;
        background: linear-gradient(135deg, var(--darker) 0%, #1A1A2E 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .testimonials-title {
        text-align: center;
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 5rem;
        position: relative;
        display: inline-block;
        left: 50%;
        transform: translateX(-50%);
        color: var(--lighter);
    }
    
    .testimonials-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient);
        border-radius: 2px;
    }
    
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 3rem;
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }
    
    .testimonial-card {
        background: rgba(30,30,30,0.7);
        backdrop-filter: blur(15px);
        border-radius: 16px;
        padding: 3rem;
        transition: all 0.5s ease;
        border: 1px solid rgba(108, 99, 255, 0.1);
    }
    
    .testimonial-card:hover {
        transform: translateY(-10px);
        background: rgba(40,40,40,0.7);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        border-color: rgba(108, 99, 255, 0.2);
    }
    
    .testimonial-text {
        font-style: italic;
        margin-bottom: 2rem;
        line-height: 1.8;
        font-size: 1.1rem;
        position: relative;
        color: var(--text-light);
    }
    
    .testimonial-text::before,
    .testimonial-text::after {
        content: '"';
        font-size: 3rem;
        color: rgba(108, 99, 255, 0.3);
        position: absolute;
    }
    
    .testimonial-text::before {
        top: -20px;
        left: -15px;
    }
    
    .testimonial-text::after {
        bottom: -40px;
        right: -15px;
    }
    
    .testimonial-author {
        display: flex;
        align-items: center;
    }
    
    .author-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 1.5rem;
        border: 3px solid rgba(108, 99, 255, 0.3);
    }
    
    .author-info h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
        color: var(--lighter);
    }
    
    .author-info p {
        margin: 0.3rem 0 0;
        opacity: 0.7;
        font-size: 1rem;
        color: var(--text-light);
    }
    
    /* Newsletter */
    .newsletter-section {
        padding: 8rem 4rem;
        background-color: var(--darker);
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .newsletter-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 2rem;
        position: relative;
        color: var(--lighter);
    }
    
    .newsletter-subtitle {
        font-size: 1.4rem;
        max-width: 700px;
        margin: 0 auto 3rem;
        opacity: 0.8;
        line-height: 1.6;
        color: var(--text-light);
    }
    
    .newsletter-form {
        display: flex;
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }
    
    .newsletter-input {
        flex: 1;
        padding: 1.5rem;
        border: none;
        border-radius: 50px 0 0 50px;
        font-size: 1.1rem;
        outline: none;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(5px);
        color: white;
    }
    
    .newsletter-input::placeholder {
        color: rgba(255,255,255,0.6);
    }
    
    .newsletter-button {
        padding: 1.5rem 3rem;
        background: var(--gradient);
        color: white;
        border: none;
        border-radius: 0 50px 50px 0;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .newsletter-button:hover {
        background: linear-gradient(135deg, #7C75FF 0%, #FF758C 100%);
    }
    
    /* Neon Background Elements */
    .neon-bg-element {
        position: absolute;
        border-radius: 50%;
        background: rgba(108, 99, 255, 0.05);
        filter: blur(30px);
        z-index: 1;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .hero-title {
            font-size: 4rem;
        }
        
        .section-title, .testimonials-title, .newsletter-title {
            font-size: 3rem;
        }
    }
    
    @media (max-width: 768px) {
        .hero {
            height: 90vh;
            min-height: 700px;
        }
        
        .hero-content {
            padding: 0 2rem;
        }
        
        .hero-title {
            font-size: 3rem;
        }
        
        .hero-subtitle {
            font-size: 1.4rem;
        }
        
        .section-title, .testimonials-title, .newsletter-title {
            font-size: 2.5rem;
        }
        
        .sports-section, .featured-section, .testimonials-section, .newsletter-section {
            padding: 6rem 2rem;
        }
        
        .sports-grid, .products-grid, .testimonials-grid {
            grid-template-columns: 1fr;
        }
        
        .newsletter-form {
            flex-direction: column;
        }
        
        .newsletter-input {
            border-radius: 50px;
            margin-bottom: 1rem;
        }
        
        .newsletter-button {
            border-radius: 50px;
            width: 100%;
        }
    }
    
    @media (max-width: 480px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
        
        .section-title, .testimonials-title, .newsletter-title {
            font-size: 2rem;
        }
        
        .sport-name {
            font-size: 2rem;
        }
        
        .product-actions {
            flex-direction: column;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <!-- Neon accent elements -->
    <div class="neon-accent">
        <div class="neon-line" style="width: 200%; height: 2px; top: 20%; left: -50%; transform: rotate(-5deg);"></div>
        <div class="neon-line" style="width: 200%; height: 1px; top: 70%; left: -50%; transform: rotate(3deg);"></div>
    </div>
    
    <!-- Hero video backgrounds -->
    <video class="hero-video" id="video1" autoplay muted loop playsinline>
        <source src="{{ asset('build/assets/2932301-uhd_4096_2160_24fps.mp4') }}" type="video/mp4">
    </video>
    
    <video class="hero-video" id="video2" autoplay muted loop playsinline style="display: none;">
        <source src="{{ asset('build/assets/5192157-hd_1920_1080_30fps.mp4') }}" type="video/mp4">
    </video>
    
  
    <!-- Video selector controls -->
    <div class="video-selector">
        <div class="video-option active" data-video="video1"></div>
        <div class="video-option" data-video="video2"></div>
    </div>
    
    <div class="hero-content">
        <h1 class="hero-title">Elevate Your Game With Premium Sports Gear</h1>
        <p class="hero-subtitle">Discover handcrafted, high-performance equipment designed for athletes who demand excellence. Experience the difference of professional-grade gear.</p>
        <button class="cta-button">Explore Collections</button>
    </div>
</section>

<!-- Sports Categories -->
<section id="sports" class="sports-section">
    <!-- Neon background elements -->
    <div class="neon-bg-element" style="width: 300px; height: 300px; top: -100px; right: -100px;"></div>
    
    <h2 class="section-title">Shop By Sport</h2>
    <div class="sports-grid">
        <!-- Cricket -->
        <div class="sport-card">
            <img src="{{ asset('build/assets/pexels-case-originals-3800541.jpg') }}" alt="Cricket" class="sport-image">
    <div class="sport-overlay">
                <h3 class="sport-name">Cricket</h3>
                <a href="#" class="sport-link">
                    Explore
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Football -->
        <div class="sport-card">
             <img src="{{ asset('build/assets/pexels-pixabay-2346.jpg') }}" alt="Football" class="sport-image">
    <div class="sport-overlay">
                <h3 class="sport-name">Football</h3>
                <a href="#" class="sport-link">
                    Explore
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Basketball -->
        <div class="sport-card">
            <img src="{{ asset('build/assets/pexels-pixabay-274422.jpg') }}" alt="Basketball" class="sport-image">
    <div class="sport-overlay">
            <div class="sport-overlay">
                <h3 class="sport-name">Basketball</h3>
                <a href="#" class="sport-link">
                    Explore
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="featured-section">
    <!-- Neon background elements -->
    <div class="neon-bg-element" style="width: 400px; height: 400px; bottom: -200px; left: -200px;"></div>
    
    <h2 class="section-title">Featured Collection</h2>
    <div class="products-grid">
        
        <!-- Product 1 -->
        <div class="product-card">
            <div class="product-image-container">
                <img src="{{ asset('build/assets/new-product-500x500.png') }}" alt="Premium Cricket Bat" class="product-image">
            </div>
            <div class="product-info">
                <span class="product-category">Cricket</span>
                <h3 class="product-name">Elite Pro English Willow Cricket Bat</h3>
                <div class="product-price">LKR 56 760</div>
                <div class="product-rating">
                    ★★★★★ (47)
                </div>
                <div class="product-actions">
                    <button class="product-button view-button" data-target="desc1">View Details</button>
                </div>
                <!-- Hidden description -->
                <div id="desc1" class="product-description" style="display: none; margin-top: 1rem; color: var(--text-light);">
                    Crafted from the finest English willow, this bat offers exceptional power and balance, 
                    making it perfect for professional cricket players. Lightweight yet powerful.
                </div>
            </div>
        </div>
        
        <!-- Product 2 -->
        <div class="product-card">
            <div class="product-image-container">
                <img src="{{ asset('build/assets/adidas_F50_61753170876095_medium.jpg') }}" alt="Football Shoes" class="product-image">
            </div>
            <div class="product-info">
                <span class="product-category">Football</span>
                <h3 class="product-name">Velocity X Professional FG Boots</h3>
                <div class="product-price">LKR 34 500</div>
                <div class="product-rating">
                    ★★★★☆ (36)
                </div>
                <div class="product-actions">
                    <button class="product-button view-button" data-target="desc2">View Details</button>
                </div>
                <!-- Hidden description -->
                <div id="desc2" class="product-description" style="display: none; margin-top: 1rem; color: var(--text-light);">
                    Designed for speed and agility, these professional FG boots provide optimal grip and control 
                    on firm ground pitches. Lightweight synthetic upper with a snug fit.
                </div>
            </div>
        </div>
        
        <!-- Product 3 -->
        <div class="product-card">
            <div class="product-image-container">
                <img src="{{ asset('build/assets/235915766.jpg') }}" alt="Badminton Racket" class="product-image">
            </div>
            <div class="product-info">
                <span class="product-category">Badminton</span>
                <h3 class="product-name">Carbon Pro Badminton professional Racket</h3>
                <div class="product-price">LKR 8 600</div>
                <div class="product-rating">
                    ★★★★★ (52)
                </div>
                <div class="product-actions">
                    <button class="product-button view-button" data-target="desc3">View Details</button>
                </div>
                <!-- Hidden description -->
                <div id="desc3" class="product-description" style="display: none; margin-top: 1rem; color: var(--text-light);">
                    The Carbon Pro series offers excellent control and precision with a lightweight carbon frame, 
                    perfect for competitive players aiming for top performance.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Toggle Description Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const desc = document.getElementById(targetId);
            
            // Toggle visibility
            if (desc.style.display === 'none') {
                desc.style.display = 'block';
                this.textContent = 'Hide Details';
            } else {
                desc.style.display = 'none';
                this.textContent = 'View Details';
            }
        });
    });
});
</script>

<!-- Testimonials -->
<section class="testimonials-section">
    <!-- Neon background elements -->
    <div class="neon-bg-element" style="width: 500px; height: 500px; top: -250px; left: -250px; opacity: 0.1;"></div>
    <div class="neon-bg-element" style="width: 300px; height: 300px; bottom: -150px; right: -150px; opacity: 0.1;"></div>
    
    <h2 class="testimonials-title">Athlete Testimonials</h2>
    <div class="testimonials-grid">
        <!-- Testimonial 1 -->
        <div class="testimonial-card">
            <p class="testimonial-text">The cricket bat I purchased from StumpZone transformed my game. The balance and power are unlike anything I've experienced before. Truly professional-grade equipment.</p>
            <div class="testimonial-author">
                <img src="{{ asset('build\assets\download.jpg') }}" alt="Rahul Sharma" class="author-avatar">
                <div class="author-info">
                    <h4>Rahul Sharma</h4>
                    <p>State Level Cricketer</p>
                </div>
            </div>
        </div>
        
        <!-- Testimonial 2 -->
        <div class="testimonial-card">
            <p class="testimonial-text">As a professional football coach, I recommend StumpZone gear to all my players. The quality and durability are exceptional, and their customer service is outstanding.</p>
            <div class="testimonial-author">
                <img src="{{ asset('build\assets\OIP.jpg') }}" alt="Priya Patel" class="author-avatar">
                <div class="author-info">
                    <h4>Priya Patel</h4>
                    <p>Football Coach</p>
                </div>
            </div>
        </div>
        
        <!-- Testimonial 3 -->
        <div class="testimonial-card">
            <p class="testimonial-text">I've tried many badminton rackets over the years, but none compare to the precision and control of StumpZone's Carbon Pro series. Worth every rupee for serious players.</p>
            <div class="testimonial-author">
                <img src="{{ asset('build\assets\OIP (1).jpg') }}" alt="Arjun Mehta" class="author-avatar">
                <div class="author-info">
                    <h4>Arjun Mehta</h4>
                    <p>National Level Player</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter-section">
    <!-- Neon background elements -->
    <div class="neon-bg-element" style="width: 600px; height: 600px; top: -300px; right: -300px; opacity: 0.05;"></div>
    
    <h2 class="newsletter-title">Join Our Athlete Community</h2>
    <p class="newsletter-subtitle">Subscribe to receive exclusive offers, training tips, and early access to our newest collections. Elevate your game with insider knowledge.</p>
    <form class="newsletter-form">
        <input type="email" placeholder="Your email address" class="newsletter-input" required>
        <button type="submit" class="newsletter-button">Subscribe Now</button>
    </form>
</section>

<script>
    // Video switcher functionality
    document.addEventListener('DOMContentLoaded', function() {
        const videoOptions = document.querySelectorAll('.video-option');
        const videos = {
            video1: document.getElementById('video1'),
            video2: document.getElementById('video2')
        };
        
        // Set initial active video
        let currentVideo = 'video1';
        
        // Add click event to video options
        videoOptions.forEach(option => {
            option.addEventListener('click', function() {
                const videoId = this.getAttribute('data-video');
                
                if (videoId !== currentVideo) {
                    // Update active state
                    document.querySelector('.video-option.active').classList.remove('active');
                    this.classList.add('active');
                    
                    // Switch videos
                    videos[currentVideo].style.display = 'none';
                    videos[videoId].style.display = 'block';
                    
                    // Play the new video
                    videos[videoId].play();
                    
                    currentVideo = videoId;
                }
            });
        });
        
        // Ensure videos loop properly (fallback for some browsers)
        Object.values(videos).forEach(video => {
            video.addEventListener('ended', function() {
                this.currentTime = 0;
                this.play();
            });
            
            // Preload videos
            video.preload = "auto";
        });
        
        // Fallback if videos don't load
        setTimeout(() => {
            if (Object.values(videos).every(v => v.readyState === 0)) {
                document.querySelector('.hero-fallback').style.display = 'block';
                Object.values(videos).forEach(v => v.style.display = 'none');
            }
        }, 3000);
        
        // Simple animation for elements when they come into view
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.sport-card, .product-card, .testimonial-card');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if(elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Set initial state
        document.querySelectorAll('.sport-card, .product-card, .testimonial-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1)';
        });
        
        // Animate neon lines
        const neonLines = document.querySelectorAll('.neon-line');
        neonLines.forEach((line, index) => {
            line.style.transition = `all 1.5s cubic-bezier(0.165, 0.84, 0.44, 1) ${index * 0.3}s`;
            setTimeout(() => {
                line.style.width = '100%';
                line.style.left = '0';
                line.style.transform = 'rotate(0)';
            }, 100);
        });
        
        // Add scroll event listener
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    });
</script>
@endsection