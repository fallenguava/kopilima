@extends('layouts.layout_navbar')

@section('content')
<style>
    .privacy-container {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 2rem auto;
        max-width: 800px;
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
    }

    .privacy-container h1,
    .privacy-container h2 {
        color: #03045e;
        text-align: center;
    }

    .privacy-container h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .privacy-container h2 {
        font-size: 1.8rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .privacy-container p {
        color: #4a4a4a;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .privacy-container ul {
        padding-left: 1.5rem;
    }

    .privacy-container ul li {
        color: #4a4a4a;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .privacy-container a {
        color: #0077b6;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .privacy-container a:hover {
        color: #03045e;
    }
</style>

<div class="container my-5">
    <div class="privacy-container">
        <h1>Privacy Policy</h1>
        <p>Welcome to Kopi Lima! Your privacy is important to us. This Privacy Policy explains how we collect, use, and safeguard your personal information. By using our website or services, you agree to the practices described in this policy.</p>

        <h2>1. Information We Collect</h2>
        <p>We collect the following types of information to provide better services and enhance your experience:</p>
        <ul>
            <li><strong>Personal Information:</strong> Name, email address, phone number, and billing details.</li>
            <li><strong>Usage Data:</strong> Information about how you interact with our website, including pages visited, time spent, and actions performed.</li>
            <li><strong>Device Information:</strong> IP address, browser type, operating system, and device identifiers.</li>
        </ul>

        <h2>2. How We Use Your Information</h2>
        <p>We use your information to:</p>
        <ul>
            <li>Provide and maintain our services.</li>
            <li>Process orders and manage transactions.</li>
            <li>Improve our website functionality and user experience.</li>
            <li>Send promotional offers, updates, and service-related communications.</li>
            <li>Ensure security and prevent fraudulent activities.</li>
        </ul>

        <h2>3. Sharing Your Information</h2>
        <p>Your information will never be sold. However, we may share your information with trusted third parties, including:</p>
        <ul>
            <li>Payment processors to handle transactions securely.</li>
            <li>Delivery partners for order fulfillment.</li>
            <li>Service providers for website hosting, analytics, and maintenance.</li>
            <li>Legal authorities, if required by law or for fraud prevention.</li>
        </ul>

        <h2>4. Cookies and Tracking Technologies</h2>
        <p>We use cookies and similar technologies to enhance your browsing experience. Cookies allow us to:</p>
        <ul>
            <li>Recognize your preferences and personalize content.</li>
            <li>Analyze website performance and improve functionality.</li>
            <li>Track promotions and marketing effectiveness.</li>
        </ul>
        <p>You can manage or disable cookies through your browser settings, but some features may not function properly without them.</p>

        <h2>5. Protecting Your Information</h2>
        <p>We are committed to keeping your information secure. Measures include:</p>
        <ul>
            <li>Encrypted data transmission (SSL).</li>
            <li>Regular security audits and vulnerability testing.</li>
            <li>Access control to ensure only authorized personnel handle your data.</li>
        </ul>

        <h2>6. Your Rights</h2>
        <p>You have the right to:</p>
        <ul>
            <li>Access, update, or delete your personal information.</li>
            <li>Opt-out of promotional communications at any time.</li>
            <li>Request a copy of the data we hold about you.</li>
        </ul>
        <p>To exercise your rights, please contact us at <a href="mailto:support@kopilima.com">support@kopilima.com</a>.</p>

        <h2>7. Changes to This Policy</h2>
        <p>We may update this Privacy Policy from time to time. Changes will be posted on this page with the updated date. Your continued use of our services constitutes acceptance of the revised policy.</p>

        <h2>8. Contact Us</h2>
        <p>If you have any questions about this Privacy Policy, please contact us at:</p>
        <p>Email: <a href="mailto:support@kopilima.com">support@kopilima.com</a></p>
        <p>Phone: +62 123-456-789</p>
        <p>Address: Jl. Kopi Lima No. 10, Jakarta, Indonesia</p>
    </div>
</div>
@endsection
