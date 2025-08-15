<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to StumpZone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Video Background Styles */
        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            opacity: 0;
            transition: opacity 0.5s linear;
            object-fit: cover;
        }
        .video-background.active {
            opacity: 1;
        }
        
        /* Glass Morphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            overflow: hidden;
            position: relative;
        }
        .glass-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.1) 0%,
                rgba(255, 255, 255, 0) 50%,
                rgba(255, 255, 255, 0.1) 100%
            );
            transform: rotate(30deg);
            z-index: -1;
            animation: liquidFlow 10s infinite linear;
        }
        @keyframes liquidFlow {
            0% { transform: rotate(30deg) translate(0, 0); }
            25% { transform: rotate(30deg) translate(-10%, 5%); }
            50% { transform: rotate(30deg) translate(0, 10%); }
            75% { transform: rotate(30deg) translate(10%, 5%); }
            100% { transform: rotate(30deg) translate(0, 0); }
        }
        
        /* Content Styles */
        .cricket-icon {
            font-size: 4rem;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .feature-item {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 12px;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-3px);
        }
        
        .login-btn {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(29, 78, 216, 0.9) 100%);
            backdrop-filter: blur(5px);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }
        .login-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.3) 0%,
                rgba(255, 255, 255, 0) 50%,
                rgba(255, 255, 255, 0.3) 100%
            );
            transform: rotate(30deg);
            animation: liquidFlow 8s infinite linear;
            z-index: -1;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen overflow-hidden text-white bg-gray-900">
    <!-- Video Background Container -->
    <div class="video-container">
        <video class="video-background active" id="video1" muted autoplay loop playsinline>
            <source src="{{ asset('build/assets/vecteezy_boy-is-playing-soccer-football-in-green-field-people-with_9290121.mov') }}" type="video/mp4">
        </video>
        <video class="video-background" id="video2" muted autoplay loop playsinline>
            <source src="{{ asset('build/assets/9944629-uhd_3840_2160_24fps.mp4') }}" type="video/mp4">
        </video>
        <video class="video-background" id="video3" muted autoplay loop playsinline>
            <source src="{{ asset('build/assets/8053652-uhd_3840_2160_25fps.mp4') }}" type="video/mp4">
        </video>
        <video class="video-background" id="video4" muted autoplay loop playsinline>
            <source src="{{ asset('build/assets/6877250-hd_1920_1080_30fps.mp4') }}" type="video/mp4">
        </video>
        <video class="video-background" id="video5" muted autoplay loop playsinline>
            <source src="{{ asset('build/assets/5192154-uhd_3840_2160_30fps.mp4') }}" type="video/mp4">
        </video>
    </div>

    <!-- Main Content -->
    <div class="w-full max-w-2xl p-10 mx-4 glass-card">
        <!-- Header Section -->
        <div class="mb-10 text-center">
            <div class="mb-4 cricket-icon">🏏</div>
            <h1 class="mb-3 text-5xl font-bold text-transparent bg-gradient-to-r from-blue-300 to-blue-100 bg-clip-text">StumpZone</h1>
            <p class="text-xl text-blue-100">Elevate Your Sport Experience</p>
        </div>
        
        <!-- Features Grid -->
        <div class="grid grid-cols-2 gap-4 mb-12 md:grid-cols-3">
            <div class="feature-item">
                <div class="mb-2 text-2xl">🎯</div>
                <h3 class="font-semibold">Precision Gear</h3>
                <p class="text-sm text-blue-100">Professional equipment</p>
            </div>
            <div class="feature-item">
                <div class="mb-2 text-2xl">⚡</div>
                <h3 class="font-semibold">Fast Delivery</h3>
                <p class="text-sm text-blue-100">24hr dispatch</p>
            </div>
            <div class="feature-item">
                <div class="mb-2 text-2xl">🛡️</div>
                <h3 class="font-semibold">Premium Quality</h3>
                <p class="text-sm text-blue-100">Tested by pros</p>
            </div>
            <div class="feature-item">
                <div class="mb-2 text-2xl">🏆</div>
                <h3 class="font-semibold">Champion Picks</h3>
                <p class="text-sm text-blue-100">Player favorites</p>
            </div>
            <div class="feature-item">
                <div class="mb-2 text-2xl">🔧</div>
                <h3 class="font-semibold">Expert Support</h3>
                <p class="text-sm text-blue-100">24/7 assistance</p>
            </div>
            <div class="feature-item">
                <div class="mb-2 text-2xl">💰</div>
                <h3 class="font-semibold">Best Value</h3>
                <p class="text-sm text-blue-100">Price match</p>
            </div>
        </div>
        
        <!-- Login Section -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="inline-block px-12 py-4 mb-6 text-lg font-semibold rounded-full login-btn">
                Enter StumpZone
            </a>
            <p class="text-sm text-blue-100">Join our community of Sport enthusiasts</p>
        </div>
    </div>

    <script>
        // Immediate video playback with no delays
        document.addEventListener('DOMContentLoaded', function() {
            const videos = [
                document.getElementById('video1'),
                document.getElementById('video2'),
                document.getElementById('video3'),
                document.getElementById('video4'),
                document.getElementById('video5')
            ];
            
            // Force all videos to start playing immediately with no delay
            function playVideos() {
                videos.forEach(video => {
                    video.play().catch(e => {
                        console.log('Video play attempt:', e);
                        // If autoplay is blocked, mute and try again
                        video.muted = true;
                        video.play().catch(e => console.log('Second attempt failed:', e));
                    });
                });
            }
            
            // Start playing immediately
            playVideos();
            
            // Set first video as active
            let currentVideoIndex = 0;
            
            // Rotate videos without any initial delay
            function rotateVideos() {
                videos[currentVideoIndex].classList.remove('active');
                currentVideoIndex = (currentVideoIndex + 1) % videos.length;
                videos[currentVideoIndex].classList.add('active');
            }
            
            // Start rotation immediately
            const rotationInterval = setInterval(rotateVideos, 8000);
            
            // Ensure videos loop properly
            videos.forEach(video => {
                video.addEventListener('ended', function() {
                    this.currentTime = 0;
                    this.play();
                });
            });
            
            // Preload videos for immediate switching
            window.addEventListener('load', function() {
                videos.forEach(video => {
                    video.load();
                });
            });
        });
    </script>
</body>
</html>