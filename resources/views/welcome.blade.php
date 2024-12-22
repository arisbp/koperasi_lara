<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Website Koperasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Playfair+Display:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #497449;
            color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #609560;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        header p { 
            font-family: 'Poppins', sans-serif; 
            margin: 10px 0; 
            font-size: 1.2em; 
            color: #d8f3dc;
        }

        header h1, header p {
            margin-top: 0; /* Mengurangi jarak atas */
            margin-bottom: 0; /* Mengurangi jarak bawah */
            padding: 0; /* Pastikan tidak ada padding ekstra */
        }

        header h1, .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5em; /* Or 3em depending on the section */
            margin: 0;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            padding: 10px 0;
        }

        nav a {
            color: #d8f3dc;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #fff;
            color: #1b4332;
        }

        .hero {
            text-align: center;
            margin-bottom: 15px; /* Mengurangi jarak bawah */
        }

        .hero h1 {
            font-size: 3em;
            margin: 0;
        }

        .hero p {
            font-family: 'Poppins', sans-serif;
            font-size: 1.2em;
            margin: 5px 0;
        }

        .hero button {
            background-color: #d8f3dc;
            color: #1b4332;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .hero button:hover {
            background-color: #95d5b2;
        }

        .features {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 15px; /* Mengurangi jarak bawah */
        }

        .feature {
            background-color: #609560;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 30%;
            text-align: center;
            transition: transform 0.3s;
        }

        .feature:hover {
            transform: translateY(-5px);
        }

        .feature img {
            max-width: 100%;
            margin-bottom: 20px;
        }

        .feature h2 {
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        .feature p {
            font-size: 1em;
            line-height: 1.6;
            color: #fff;
        }

        footer {
            background-color: #609560;
            padding: 5px;
            color: #fff;
            text-align: center;
            font-size: 0.9em;
            margin-top: 5px; /* Mengurangi jarak atas */
            flex-direction: column; 
        } 
        @media (max-width: 768px) {
            .features {
                flex-direction: column; 
                align-items: center; 
            } 
            .feature {
                 width: 80%; 
            } 
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Selamat Datang di Website Koperasi</h1>
            <p>Melayani dengan kejujuran dan profesionalisme</p>
            <nav>
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="hero">
            <h1>MY KOPERASI</h1>
            <p>Inovasi Pengelolaan Koperasi Digital, Proses Transaksi Koperasi kini jadi lebih mudah!</p>
            <button>Apa itu myKoperasi?</button>
        </section>

        <section class="features">
            <div class="feature">
                <img src="{{ asset('images/1.jpg') }}" alt="Logo Koperasi" class="logo">
                <h2>Ekosistem yang Kuat</h2>
                <p>Koperasi kami memiliki berbagai layanan unggulan yang dirancang untuk memenuhi kebutuhan Anda, mulai dari simpan pinjam, investasi, hingga layanan komunitas.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/2.jpg') }}" alt="Logo Koperasi" class="logo">
                <h2>Pelayanan Profesional</h2>
                <p>Dengan dukungan tim yang berpengalaman dan teknologi modern, kami memberikan pelayanan terbaik untuk kenyamanan Anda.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/3.jpg') }}" alt="Logo Koperasi" class="logo">
                <h2>Kemudahan Akses</h2>
                <p>Akses layanan koperasi kapan saja dan di mana saja melalui website kami. Daftar layanan seperti simpan pinjam, investasi, dan lainnya dapat diakses melalui menu navigasi.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/4.jpg') }}" alt="Logo Koperasi" class="logo">
                <h2>Inovasi Berkelanjutan</h2>
                <p>Kami terus berinovasi dalam menghadirkan layanan dan produk yang relevan dengan kebutuhan masa kini. Dengan pendekatan berbasis teknologi, kami memastikan koperasi selalu adaptif terhadap perkembangan zaman.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>Koperasi Kami &copy; 2024. Semua Hak Dilindungi.</p>
    </footer>
</body>

</html>
