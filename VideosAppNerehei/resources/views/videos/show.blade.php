@extends('layouts.VideosAppLayout')

@section('content')
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fdfdfd;
            color: #222;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            flex: 1; /* Para que el contenido empuje el footer hacia abajo */
        }

        .card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #0066cc;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .card-header h1 {
            font-size: 30px;
            margin: 0;
            text-transform: capitalize;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .video-container {
            position: relative;
            padding-bottom: 40%; /* Video más pequeño */
            height: 0;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .card-footer {
            background: #f9f9f9;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        /* Footer */
        footer {
            background-color: #222;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 20px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        footer p span {
            font-weight: bold;
            color: #00c3ff;
        }

        footer p a {
            color: #fff;
            text-decoration: underline;
        }

        footer p a:hover {
            color: #00c3ff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-header h1 {
                font-size: 20px;
            }

            .video-container {
                padding-bottom: 50%;
            }

            footer p {
                font-size: 12px;
            }
        }
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>{{ $video->title }}</h1>
            </div>
            <div class="card-body">
                <!-- Video Player -->
                <div class="video-container">
                    <iframe
                        src="{{ $video->url }}"
                        allow="autoplay; fullscreen; picture-in-picture"></iframe>
                </div>
                <!-- Video Description -->
                <p>{{ $video->description }}</p>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <script>document.write(new Date().getFullYear());</script> Creado por <span>Nerehei</span>. <a href="#">Contacto</a></p>
    </footer>
@endsection
