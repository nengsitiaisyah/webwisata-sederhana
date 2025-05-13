<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Wisata Nusantara</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Wisata Nusantara</h1>
        <p>Wisata Nusantara adalah destinasi wisata terbaik yang menawarkan berbagai pengalaman menarik, mulai dari wahana seru, villa nyaman, hingga layanan terbaik untuk pengunjung. Nikmati keindahan alam dan fasilitas modern yang kami sediakan.</p>
        <div class="home-gallery slider">
            <div><img src="/ririw/uploads/prambanan.jpg" alt="Wahana 1"></div>
            <div><img src="/ririw/uploads/1.jpg" alt="Villa 1"></div>
            <div><img src="/ririw/uploads/borobudur.jpg" alt="Wahana 2"></div>
            <div><img src="/ririw/uploads/4.jpg" alt="Villa 2"></div>
        </div>
        <div class="testimonials">
            <h2>Testimoni Pengunjung</h2>
            <div class="testimonial-wrapper">
                <div class="testimonial">
                    <p>"Pengalaman yang luar biasa! Wahananya seru dan villanya sangat nyaman. Pasti akan kembali lagi!"</p>
                    <p><strong>- Andi, Jakarta</strong></p>
                </div>
                <div class="testimonial">
                    <p>"Pelayanan yang sangat ramah dan profesional. Tempatnya juga sangat bersih dan terawat."</p>
                    <p><strong>- Siti, Surabaya</strong></p>
                </div>
                <div class="testimonial">
                    <p>"Liburan terbaik bersama keluarga! Anak-anak sangat menikmati wahana yang ada."</p>
                    <p><strong>- Budi, Bandung</strong></p>
                </div>
                <div class="testimonial">
                    <p>"Tempat yang sangat indah dan menyenangkan. Sangat direkomendasikan!"</p>
                    <p><strong>- Rina, Bali</strong></p>
                </div>
            </div>
        </div>
    </div>
    <footer>
    <div class="footer-content">
        <p><i class="fas fa-map"></i> Jl. Wisata Nusantara No. 123, Yogyakarta</p>
        <p><i class="fas fa-phone"></i> +62 812 3456 7890</p>
        <p><i class="fas fa-envelope"></i> info@wisatanusantara.com</p>
        <p><i class="fas fa-clock"></i> Senin - Minggu, 08:00 - 20:00</p>
    </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.slider').slick({
                autoplay: true,
                autoplaySpeed: 3000,
                dots: true,
                arrows: false
            });
        });
    </script>
</body>
</html>
