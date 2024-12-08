@extends('layouts.layout_navbar')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    /* Full Page Sections */
    .container {
        scroll-snap-type: y mandatory;
        overflow-y: scroll;
        height: 100vh;
    }

    section {
        height: 100vh; /* Full viewport height */
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        position: relative;
        scroll-snap-align: start;
        padding: 2rem;
    }

    /* Background Animation */
    .section-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background: linear-gradient(45deg, #03045e, #0077b6, #00b4d8, #90e0ef, #caf0f8);
        background-size: 400% 400%;
        animation: gradientMove 10s ease infinite;
    }

    @keyframes gradientMove {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    /* Text Styling */
    section h2 {
        font-size: 4rem;
        color: #0077b6;
        text-transform: uppercase;
        margin-bottom: 1rem;
        text-align: center;
        opacity: 0;
        transform: translateY(50px);
        transition: all 1.2s ease;
    }

    section p {
        font-size: 1.5rem;
        color: #4a4a4a;
        max-width: 800px;
        text-align: center;
        line-height: 1.8;
        opacity: 0;
        transform: translateY(50px);
        transition: all 1.2s ease;
    }

    /* Image Styling */
    section img {
        max-width: 40%;
        margin: 1rem auto;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        object-fit: cover;
        opacity: 0;
        transform: translateY(50px);
        transition: all 1.2s ease;
    }

    /* Visible Class */
    .visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        section img {
            max-width: 60%;
        }

        section h2 {
            font-size: 3rem;
        }

        section p {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 768px) {
        section img {
            max-width: 70%;
        }

        section h2 {
            font-size: 2.5rem;
        }

        section p {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        section img {
            max-width: 90%;
        }

        section h2 {
            font-size: 2rem;
        }

        section p {
            font-size: 1rem;
        }
    }
</style>

<!-- Section 1: About Us -->
<section>
    <div class="section-bg animate__fadeInLeft"></div>
    <h2>About Us</h2>
    <p>
        Welcome to Kopi Lima! We are more than just a coffee shop; we are a place where stories are shared and memories are brewed.
    </p>
    <img src="{{ asset('about/about1.jpg') }}" alt="About Us">
</section>

<!-- Section 2: Our Story -->
<section>
    <div class="section-bg animate__fadeInLeft"></div>
    <h2>Our Story</h2>
    <p>
        From humble beginnings as a coffee cart, Kopi Lima has grown into a hub of connection. 
        Each cup represents our passion for crafting unforgettable experiences.
    </p>
    <img src="{{ asset('about/about2.jpg') }}" alt="Our Story">
</section>

<!-- Section 3: The Art of Coffee -->
<section>
    <div class="section-bg animate__fadeInLeft"></div>
    <h2>The Art of Coffee</h2>
    <p>
        Coffee is an art. From selecting the finest beans to mastering the perfect roast, 
        every cup tells a story of dedication and skill.
    </p>
    <img src="{{ asset('about/about3.jpg') }}" alt="The Art of Coffee">
</section>

<!-- Section 4: How Coffee is Made -->
<section>
    <div class="section-bg animate__fadeInLeft"></div>
    <h2>How Coffee is Made</h2>
    <p>
        Starting with ethically sourced beans, our coffee undergoes meticulous steps from drying and roasting 
        to brewing. This journey ensures every cup is a masterpiece worth savoring.
    </p>
    <img src="{{ asset('about/about4.jpg') }}" alt="How Coffee is Made">
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const elements = document.querySelectorAll('h2, p, img');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.7 });

        elements.forEach(el => observer.observe(el));
    });
</script>
@endsection
