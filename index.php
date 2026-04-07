<?php
session_start();
require_once 'config.php';

// Check if user is logged in
$logged_in = isset($_SESSION['user_id']);
$user_name = $_SESSION['user_name'] ?? '';
$user_avatar = $_SESSION['user_avatar'] ?? '?';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthPal – Health Management System</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>

        :root {
            --primary: #0a8abf;
            --secondary: #0cc0df;
            --bg-light: #e8f5fb;
            --card-bg: #ffffff;
            --text-dark: #1e2a38;
            --shadow: 0 6px 25px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        header {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow);
            z-index: 100;
        }

        .navbar {
    width: 95%; /* Changed from 90% to 95% */
    max-width: 1400px;
    margin: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    overflow-x: auto; /* Allows scrolling if needed */
    overflow-y: hidden;
}

/* Hide scrollbar but keep functionality */
.navbar::-webkit-scrollbar {
    display: none;
}
.navbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.nav-links {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 12px; /* Reduced from 25px */
    font-size: 0.85rem; /* Added smaller font */
}

.nav-links a {
    text-decoration: none;
    color: var(--text-dark);
    font-weight: 500;
    transition: all 0.3s ease;
    padding: 0.2px ;
    position: relative;
    font-size: 0.85rem;
    white-space: nowrap;
}

.logo {
    font-size: 24px; /* Reduced from 30px */
    font-weight: 800;
    color: var(--primary);
    display: flex;
    align-items: center;
    margin-right: 30px; /* Reduced space */
    margin-left: 10px; /* Reduced space */
}        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Login Button */
      .login-btn {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border: none;
    padding: 6px 15px; /* Reduced from 10px 25px */
    border-radius: 30px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px; /* Reduced from 8px */
    font-size: 0.85rem; /* Smaller font */
    white-space: nowrap;
}

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(10, 138, 191, 0.3);
        }

        .login-btn i {
            font-size: 18px;
        }

        /* Login Popup Overlay */
        .login-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Login Container */
        .login-container {
            background: white;
            width: 90%;
            max-width: 320px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: slideUp 0.5s ease;
            font-size: 14px;margin: 20px auto
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 15px 15px 10px 15px
            text-align: center;
        }

        .login-header h2 {
            font-size: 20px !important; /* Very small heading */
    margin-bottom: 5px
        }

        .login-header p {
                font-size: 12px; /* Smaller subtitle */
    opacity: 0.8;

        }

        .login-body {
            padding: 15px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .form-group {
            display: flex;margin-bottom: 10px
            flex-direction: column;
        }

        .form-group label {
            font-weight: 500;
            font-size: 12px !important;
    margin-bottom: 4px !important;
    font-weight: normal;
            color: var(--text-dark);
        }

        .form-group input {
            padding: 8px 12px;
            border: 2px solid #e0e6ed;
            border-radius: 6px;
            font-size: 13px;height: 35px
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 138, 191, 0.1);
        }

        .form-options {
            display: flex; font-size: 12px;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .remember-me {
            display: flex;
            align-items: center;font-size: 12px;
            gap: 8px;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;font-size: 12px
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600; height: 40px
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 5px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(10, 138, 191, 0.3);
        }

        .login-divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .login-divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e6ed;
        }

        .login-divider span {
            background: white;
            font-size: 11px;
    padding: 0 8px;
            color: #7a7f8a;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .social-btn {
            flex: 1;
            padding: 8px;
            border-radius: 12px;
            border: 2px solid #e0e6ed;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 500;
            cursor: pointer; height: 38px;
            transition: all 0.3s ease;
            font-size: 12px;
        }

        .social-btn:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        .social-btn.google i {
            color: #DB4437;
        }

        .social-btn.facebook i {
            color: #4267B2;
        }

        .register-link {
            text-align: center;
            font-size: 12px;
    margin-top: 10px;
            color: #7a7f8a;
        }

        .register-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .close-login {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-login:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        /* First Page/Hero Section with Background Image */
        .hero {
            min-height: calc(100vh - 80px); /* adjusts for navbar */
    padding: 90px 20px 60px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: 
                linear-gradient(135deg, rgba(10, 138, 191, 0.85), rgba(12, 192, 223, 0.8)),
                url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.2) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;

        }

        .hero h1 {
            font-size: 3rem;
            color: white;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
            line-height: 1.2;
            animation: fadeInDown 1s ease;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
            margin-bottom: 40px;
            opacity: 0.9;
            animation: fadeInUp 1s ease 0.3s both;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-main {
            margin-top: 20px;
            padding: 18px 40px;
            border-radius: 40px;
            border: none;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            background: linear-gradient(135deg, #ffffff, #f0f9ff);
            color: var(--primary);
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            animation: fadeInUp 1s ease 0.6s both;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-main::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transition: left 0.4s ease;
            z-index: -1;
        }

        .btn-main:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(10, 138, 191, 0.4);
            color: white;
        }

        .btn-main:hover::before {
            left: 0;
        }

        .btn-main i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .btn-main:hover i {
            transform: translateX(5px);
        }

        .scroll-down {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
            color: white;
            font-size: 2rem;
            cursor: pointer;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        .section {
            width: 90%;
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
        }

        h2 {
            color: var(--primary);
            margin-bottom: 30px;
            font-size: 2.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        input, select, textarea {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            border-radius: 10px;
            border: 2px solid #e0e6ed;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 138, 191, 0.1);
        }

        .btn {
            margin-top: 20px;
            padding: 14px 30px;
            border-radius: 30px;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(10, 138, 191, 0.3);
        }

        ul {
            list-style: none;
        }

        ul li {
            background: white;
            padding: 20px;
            margin-top: 15px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
            border-left: 4px solid var(--primary);
        }

        ul li:hover {
            transform: translateX(10px);
        }

        .disease-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .disease-card {
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.4s ease;
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .disease-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .disease-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .disease-card:hover::before {
            transform: scaleX(1);
        }

        .disease-card img {
            width: 100%;
            height: 180px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.5s ease;
            margin-bottom: 15px;
        }

        .disease-card:hover img {
            transform: scale(1.08);
        }

        .disease-card h3 {
            color: var(--text-dark);
            margin-bottom: 10px;
            font-size: 1.3rem;
        }

        .disease-card p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        /* Add this to show all content */
* {
    visibility: visible !important;
    opacity: 1 !important;
}

.disease-info, .disease-content, #disease-content, .content {
    display: block !important;
    height: auto !important;
    overflow: visible !important;
    max-height: none !important;
}
        /* User info after login */
        .user-info {
            display: <?php echo $logged_in ? 'flex' : 'none'; ?>;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }
        
        .logout-btn {
            background: transparent;
            color: var(--text-dark);
            border: 2px solid #e0e6ed;
            padding: 8px 18px;
            border-radius: 30px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #f8f9fa;
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Enhanced About Us Styles */
        .about-hero {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(rgba(10, 138, 191, 0.9), rgba(12, 192, 223, 0.8)), 
                        url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            border-radius: 20px;
            margin-bottom: 40px;
        }

        .about-hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
            color: white;
        }

        .about-hero p {
            font-size: 1.5rem;
            max-width: 800px;
            line-height: 1.6;
            margin-bottom: 40px;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
        }

        /* Mission Section */
        .mission-section {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }

        .mission-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 40px;
            position: relative;
        }

        .mission-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .mission-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .mission-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
        }

        .mission-text p {
            margin-bottom: 20px;
        }

        .mission-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            height: 400px;
        }

        .mission-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .mission-image:hover img {
            transform: scale(1.05);
        }

        /* Features Grid */
        .features-section {
            margin-bottom: 40px;
        }

        .features-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 40px;
            position: relative;
        }

        .features-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-image {
            height: 180px;
            overflow: hidden;
        }

        .feature-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .feature-card:hover .feature-image img {
            transform: scale(1.1);
        }

        .feature-content {
            padding: 25px;
        }

        .feature-content h3 {
            color: var(--primary);
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .feature-content p {
            color: #666;
            line-height: 1.6;
        }

        /* Team Section */
        .team-section {
            margin-bottom: 40px;
        }

        .team-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 40px;
            position: relative;
        }

        .team-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .team-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            text-align: center;
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
        }

        .team-image {
            height: 220px;
            overflow: hidden;
        }

        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-info {
            padding: 20px;
        }

        .team-info h3 {
            color: var(--primary);
            margin-bottom: 10px;
        }

        .team-info p {
            color: #666;
            font-style: italic;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 60px 20px;
            border-radius: 20px;
            margin-bottom: 40px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            text-align: center;
        }

        .stat-item h2 {
            font-size: 3rem;
            margin-bottom: 10px;
            font-weight: 800;
            color: white;
        }

        .stat-item p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .cta-content p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .cta-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 40px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cta-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(10, 138, 191, 0.3);
        }

        /* Disease Details Popup */
        .disease-details-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
            padding: 20px;
            overflow-y: auto;
        }

        .disease-details-container {
            background: white;
            width: 90%;
            max-width: 900px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.5s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        .disease-details-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .disease-details-header h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: white;
        }

        .disease-details-header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .close-details {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-details:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .disease-details-body {
            padding: 40px;
        }

        .disease-main-image {
            width: 100%;
            height: 300px;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .disease-main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .disease-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-section {
            background: var(--bg-light);
            padding: 25px;
            border-radius: 15px;
        }

        .info-section h3 {
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-section h3 i {
            font-size: 1.2rem;
        }

        .info-section ul {
            list-style: none;
        }

        .info-section ul li {
            background: transparent;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            margin: 0;
            box-shadow: none;
        }

        .info-section ul li:last-child {
            border-bottom: none;
        }

        .specialist-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 25px;
            border-radius: 15px;
            margin-top: 30px;
        }

        .specialist-info h3 {
            color: var(--primary);
            margin-bottom: 20px;
        }

        .specialist-card {
            display: flex;
            align-items: center;
            gap: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .specialist-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .specialist-details h4 {
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .specialist-details p {
            color: #666;
            margin-bottom: 5px;
        }

        .prevention-tips {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            padding: 25px;
            border-radius: 15px;
            margin-top: 30px;
        }

        .prevention-tips h3 {
            color: var(--primary);
            margin-bottom: 20px;
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .tip-item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .tip-item:hover {
            transform: translateY(-5px);
        }

        .tip-item i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .tip-item p {
            color: var(--text-dark);
            font-weight: 500;
        }

        /* Search Input */
        #diseaseSearch {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            display: block;
            padding: 16px 24px;
            font-size: 18px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.8rem;
            }
            
            .hero p {
                font-size: 1.2rem;
            }
            
            .nav-links {
                gap: 15px;
                font-size: 0.9rem;
            }
            
            .mission-content {
                grid-template-columns: 1fr;
            }
            
            .mission-title, .features-title, .team-title {
                font-size: 2rem;
            }
            
            .disease-details-header h2 {
                font-size: 2rem;
            }
            
            .disease-info-grid {
                grid-template-columns: 1fr;
            }
            
            .specialist-card {
                flex-direction: column;
                text-align: center;
            }
            
            .about-hero h1 {
                font-size: 2.5rem;
            }
            
            .about-hero p {
                font-size: 1.2rem;
            }
            
            .btn-main {
                padding: 15px 30px;
                font-size: 1.1rem;
            }
            
            .section {
                margin: 60px auto;
            }
            
            h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .navbar {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .disease-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.8s ease;
        }

        .slide-up {
            animation: slideUp 0.8s ease;
        }
    </style>
</head>

<body>

<header>
    <nav class="navbar">
        <div class="logo"><i class="fas fa-heartbeat"></i>HealthPal</div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#symptoms">Symptoms</a></li>
            <li><a href="#disease">Diseases</a></li>
            <li><a href="#journal">Journal</a></li>
            <li><a href="#medication">Reminders</a></li>
            <li><a href="#emergency">Emergency</a></li>
            <li><a href="#about">About</a></li>
            <li>
                <?php if(!$logged_in): ?>
                <button class="login-btn" id="openLogin">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <?php else: ?>
                <div class="user-info" id="userInfo">
                    <div class="user-avatar" id="userAvatar"><?php echo $user_avatar; ?></div>
                    <span id="userName"><?php echo htmlspecialchars($user_name); ?></span>
                    <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
                </div>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>

<?php if(!$logged_in): ?>
<!-- Login Popup -->
<div class="login-overlay" id="loginOverlay">
    <div class="login-container">
        <button class="close-login" id="closeLogin">&times;</button>
        <div class="login-header">
            <h2>Welcome Back!</h2>
            <p>Sign in to access your health dashboard</p>
        </div>
        <div class="login-body">
            <form class="login-form" action="login.php" method="POST">
                <div class="form-group">
                    <label for="loginEmail">Email Address</label>
                    <input type="email" id="loginEmail" name="email" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="password" placeholder="Enter your password" required>
                </div>
                
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="rememberMe" name="remember">
                        <label for="rememberMe">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>
            
            <div class="login-divider">
                <span>Or continue with</span>
            </div>
            
            <div class="social-login">
                <button class="social-btn google">
                    <i class="fab fa-google"></i> Google
                </button>
                <button class="social-btn facebook">
                    <i class="fab fa-facebook-f"></i> Facebook
                </button>
            </div>
            
            <div class="register-link">
                Don't have an account? <a href="#" id="showRegister">Sign up now</a>
            </div>
        </div>
    </div>
</div>
<!-- Registration Popup -->
<div class="login-overlay" id="registerOverlay">
    <div class="login-container">
        <button class="close-login" id="closeRegister">&times;</button>
        <div class="login-header">
            <h2>Create Account</h2>
            <p>Join HealthPal to manage your health</p>
        </div>
        <div class="login-body">
            <form class="login-form" action="register.php" method="POST">
                <!-- ADD THIS HIDDEN FIELD -->
                <input type="hidden" name="register" value="1">
                
                <div class="form-group">
                    <label for="registerName">Full Name</label>
                    <input type="text" id="registerName" name="name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email Address</label>
                    <input type="email" id="registerEmail" name="email" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" id="registerPassword" name="password" placeholder="Create a password" required>
                </div>
                <div class="form-group">
                    <label for="registerConfirmPassword">Confirm Password</label>
                    <input type="password" id="registerConfirmPassword" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="acceptTerms" required>
                        <label for="acceptTerms">I agree to the <a href="#" style="color: var(--primary);">Terms & Conditions</a></label>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>
            
            <div class="register-link">
                Already have an account? <a href="#" id="showLogin">Sign in here</a>
            </div>
        </div>
    </div>
</div><?php endif; ?>

<!-- Disease Details Popup -->
<div class="disease-details-overlay" id="diseaseDetailsOverlay">
    <div class="disease-details-container">
        <button class="close-details" id="closeDetails">&times;</button>
        <div class="disease-details-header">
            <h2 id="diseasePopupTitle">Disease Name</h2>
            <p id="diseasePopupDescription">Disease description will appear here</p>
        </div>
        <div class="disease-details-body">
            <div class="disease-main-image">
                <img id="diseasePopupImage" src="" alt="Disease Image">
            </div>
            
            <div class="disease-info-grid">
                <div class="info-section">
                    <h3><i class="fas fa-exclamation-circle"></i> Common Symptoms</h3>
                    <ul id="diseaseSymptoms"></ul>
                </div>
                
                <div class="info-section">
                    <h3><i class="fas fa-pills"></i> Treatment Options</h3>
                    <ul id="diseaseTreatments"></ul>
                </div>
            </div>
            
            <div class="specialist-info">
                <h3><i class="fas fa-user-md"></i> Specialist Information</h3>
                <div class="specialist-card">
                    <div class="specialist-icon">
                        <i id="specialistIcon"></i>
                    </div>
                    <div class="specialist-details">
                        <h4 id="specialistTitle">Specialist Doctor</h4>
                        <p id="specialistDescription">Description about the specialist</p>
                        <p><strong>When to visit:</strong> <span id="whenToVisit">When experiencing symptoms</span></p>
                    </div>
                </div>
            </div>
            
            <div class="prevention-tips">
                <h3><i class="fas fa-shield-alt"></i> Prevention Tips</h3>
                <div class="tips-grid" id="preventionTips"></div>
            </div>
        </div>
    </div>
</div>

<!-- First Page/Hero Section -->
<section class="hero" id="home">
    <div class="hero-content">
        <h1>Your Health. Simplified.</h1>
        <p>Track symptoms, manage diseases, and stay healthy with our comprehensive health management system.</p>
        <?php if(!$logged_in): ?>
        <button class="btn-main" id="heroStartBtn">
            Start Your Health Journey
            <i class="fas fa-arrow-right"></i>
        </button>
        <?php else: ?>
        <button class="btn-main" onclick="window.location.href='#symptoms'">
            Track Your Symptoms
            <i class="fas fa-arrow-right"></i>
        </button>
        <?php endif; ?>
    </div>
    <div class="scroll-down" onclick="document.querySelector('#symptoms').scrollIntoView({behavior: 'smooth'})">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<section class="section" id="symptoms">
    <h2>Symptom Tracker</h2>
    <?php if($logged_in): ?>
    <div class="card">
        <form id="symptomForm" action="add_symptom.php" method="POST">
            <input id="symptom" name="symptom" placeholder="Symptom">
            <select id="severity" name="severity">
                <option value="Mild">Mild</option>
                <option value="Moderate">Moderate</option>
                <option value="Severe">Severe</option>
            </select>
            <input type="date" id="symptomDate" name="symptom_date">
            <textarea id="notes" name="notes" placeholder="Notes" rows="4"></textarea>
            <button type="submit" class="btn">Add Symptom</button>
        </form>
    </div>
    
    <ul id="symptomList">
        <?php
        // Fetch symptoms for logged in user
        $user_id = $_SESSION['user_id'];
        $symptoms_query = "SELECT * FROM symptoms WHERE user_id = '$user_id' ORDER BY created_at DESC";
        $symptoms_result = mysqli_query($conn, $symptoms_query);
        
        while($symptom = mysqli_fetch_assoc($symptoms_result)) {
            $severity_color = $symptom['severity'] === 'Severe' ? '#e74c3c' : 
                            ($symptom['severity'] === 'Moderate' ? '#f39c12' : '#27ae60');
            echo "<li>
                    <strong>{$symptom['symptom']}</strong> 
                    <span style=\"color: {$severity_color}\">
                        ({$symptom['severity']})
                    </span> 
                    <br>
                    <small>{$symptom['symptom_date']}</small>
                    <br>
                    " . ($symptom['notes'] ?: 'No additional notes') . "
                  </li>";
        }
        ?>
    </ul>
    <?php else: ?>
    <div class="card">
        <p style="text-align: center; color: #666;">Please <a href="#" id="openLoginPrompt" style="color: var(--primary);">login</a> to track your symptoms.</p>
    </div>
    <?php endif; ?>
</section>

<section class="section" id="disease">
    <h2>Disease Information</h2>
    <input id="diseaseSearch" class="card" placeholder="Search disease...">
    <div id="diseaseContainer" class="disease-grid"></div>
</section>

<section class="section" id="journal">
    <h2>Health Journal</h2>
    <?php if($logged_in): ?>
    <div class="card">
        <form id="journalForm" action="add_journal.php" method="POST">
            <textarea id="journalEntry" name="entry" placeholder="Write your health notes here..." rows="6"></textarea>
            <button type="submit" class="btn">Save Entry</button>
        </form>
    </div>
    
    <ul id="journalList">
        <?php
        // Fetch journal entries for logged in user
        $journal_query = "SELECT * FROM journal WHERE user_id = '$user_id' ORDER BY created_at DESC";
        $journal_result = mysqli_query($conn, $journal_query);
        
        while($journal = mysqli_fetch_assoc($journal_result)) {
            $date = date('Y-m-d H:i:s', strtotime($journal['created_at']));
            echo "<li>
                    <p>{$journal['entry']}</p>
                    <small style=\"color: #666;\">{$date}</small>
                  </li>";
        }
        ?>
    </ul>
    <?php else: ?>
    <div class="card">
        <p style="text-align: center; color: #666;">Please <a href="#" id="openLoginPrompt2" style="color: var(--primary);">login</a> to access your health journal.</p>
    </div>
    <?php endif; ?>
</section>

<section class="section" id="medication">
    <h2>Reminders</h2>
    <?php if($logged_in): ?>
    <div class="card">
        <form id="medForm" action="add_reminder.php" method="POST">
            <input id="medName" name="medication" placeholder="Medication / Appointment" required>
            <input type="datetime-local" id="medTime" name="reminder_time" required>
            <button type="submit" class="btn">Add Reminder</button>
        </form>
    </div>
    
    <ul id="medList">
        <?php
        // Fetch reminders for logged in user
        $reminders_query = "SELECT * FROM reminders WHERE user_id = '$user_id' ORDER BY reminder_time ASC";
        $reminders_result = mysqli_query($conn, $reminders_query);
        
        if(mysqli_num_rows($reminders_result) > 0) {
            while($reminder = mysqli_fetch_assoc($reminders_result)) {
                // Use isset() to check if keys exist, or use correct column names
                $med_name = isset($reminder['medication']) ? $reminder['medication'] : 
                           (isset($reminder['med_name']) ? $reminder['med_name'] : 'No name');
                
                $reminder_time = isset($reminder['reminder_time']) ? $reminder['reminder_time'] : 
                               (isset($reminder['med_time']) ? $reminder['med_time'] : '');
                
                if(!empty($reminder_time)) {
                    $formatted_date = date('Y-m-d H:i', strtotime($reminder_time));
                } else {
                    $formatted_date = 'No date set';
                }
                
                echo "<li>
                        <strong>{$med_name}</strong>
                        <br>
                        <small>{$formatted_date}</small>
                        <br>
                        <span style=\"color: #666; font-size: 0.9em;\">Reminder set</span>
                      </li>";
            }
        } else {
            echo '<li style="color: #666; text-align: center;">No reminders set yet.</li>';
        }
        ?>
    </ul>
    <?php else: ?>
    <div class="card">
        <p style="text-align: center; color: #666;">Please <a href="#" id="openLoginPrompt3" style="color: var(--primary);">login</a> to set reminders.</p>
    </div>
    <?php endif; ?>
</section>
<section class="section" id="emergency">
    <h2>Emergency Contacts</h2>
    <?php if($logged_in): ?>
    <div class="card">
        <form id="contactForm" action="add_contact.php" method="POST">
            <input id="contactName" name="contact_name" placeholder="Name">
            <input id="contactPhone" name="contact_phone" placeholder="Phone">
            <button type="submit" class="btn">Add Contact</button>
        </form>
    </div>
    
    <ul id="contactList">
        <?php
        // Fetch emergency contacts for logged in user
        $contacts_query = "SELECT * FROM emergency_contacts WHERE user_id = '$user_id' ORDER BY created_at DESC";
        $contacts_result = mysqli_query($conn, $contacts_query);
        
        while($contact = mysqli_fetch_assoc($contacts_result)) {
            echo "<li>
                    <strong>{$contact['contact_name']}</strong>
                    <br>
                    <a href=\"tel:{$contact['contact_phone']}\" style=\"color: var(--primary); text-decoration: none;\">
                        {$contact['contact_phone']}
                    </a>
                    <br>
                    <small style=\"color: #666;\">Emergency Contact</small>
                  </li>";
        }
        ?>
    </ul>
    <?php else: ?>
    <div class="card">
        <p style="text-align: center; color: #666;">Please <a href="#" id="openLoginPrompt4" style="color: var(--primary);">login</a> to manage emergency contacts.</p>
    </div>
    <?php endif; ?>
</section>

<!-- Enhanced About Us Section -->
<section class="section" id="about">
    <div class="about-hero">
        <h1>About HealthPal</h1>
        <p>Revolutionizing healthcare management through innovative technology and compassionate care. We're dedicated to making health tracking accessible, personalized, and effective for everyone.</p>
        <a href="#mission" class="btn-main">Discover Our Mission</a>
    </div>
    
    <div class="mission-section" id="mission">
        <h2 class="mission-title">Our Mission</h2>
        <div class="mission-content">
            <div class="mission-text">
                <p>At HealthPal, we believe that everyone deserves access to comprehensive health management tools. Our mission is to bridge the gap between patients and healthcare providers through innovative technology.</p>
                <p>We combine cutting-edge AI with medical expertise to provide personalized health insights, symptom tracking, and disease prevention strategies. Our platform empowers individuals to take control of their health journey.</p>
                <p>With a team of healthcare professionals, data scientists, and user experience designers, we're committed to creating solutions that are both medically accurate and user-friendly.</p>
            </div>
            <div class="mission-image">
                <img src="https://kajabi-storefronts-production.kajabi-cdn.com/kajabi-storefronts-production/file-uploads/blogs/2147494235/images/a47012e-6867-6220-2087-f28705ceb68_mage-hd-digital-marketing-mission-statement.jpeg">
            </div>
        </div>
    </div>
    
    <div class="features-section">
        <h2 class="features-title">Our Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-image">
                    <img src="https://images.unsplash.com/photo-1559757175-0eb30cd8c063?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80" alt="Symptom Tracking">
                </div>
                <div class="feature-content">
                    <h3>Advanced Symptom Tracking</h3>
                    <p>Track symptoms with severity levels, add notes, and monitor patterns over time. Get personalized insights based on your health data.</p>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-image">
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80" alt="Disease Information">
                </div>
                <div class="feature-content">
                    <h3>Comprehensive Disease Database</h3>
                    <p>Access detailed information about various diseases, including symptoms, treatments, and prevention methods from verified medical sources.</p>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-image">
                    <img src="https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80" alt="Medication Reminders">
                </div>
                <div class="feature-content">
                    <h3>Smart Medication Reminders</h3>
                    <p>Never miss a dose with our intelligent reminder system that sends notifications for medications, appointments, and health check-ups.</p>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-image">
                    <img src="https://th.bing.com/th/id/OIP.S10zR8vkdIRLaLILh7w0MAHaDo?w=295&h=171&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3">
                </div>
                <div class="feature-content">
                    <h3>Health Analytics Dashboard</h3>
                    <p>Visualize your health trends with interactive charts and graphs. Track progress and identify areas for improvement.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <h2>50K+</h2>
                <p>Active Users</p>
            </div>
            <div class="stat-item">
                <h2>30+</h2>
                <p>Diseases Covered</p>
            </div>
            <div class="stat-item">
                <h2>24/7</h2>
                <p>Support Available</p>
            </div>
            <div class="stat-item">
                <h2>98%</h2>
                <p>User Satisfaction</p>
            </div>
        </div>
    </div>
    
    <div class="team-section">
    <h2 class="team-title">How HealthPal Supports You</h2>
    <div class="team-grid">

        <div class="team-card">
            <div class="team-image">
                <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=1374&q=80" alt="Personalized Health Management">
            </div>
            <div class="team-info">
                <h3>Personalized Health Management</h3>
                <p>Organize symptoms, diseases, and health records securely in one platform.</p>
            </div>
        </div>

        <div class="team-card">
            <div class="team-image">
                <img src="https://appadvertising-reviews.com/wp-content/uploads/2024/01/health-apps.jpg">
            </div>
            <div class="team-info">
                <h3>Early Health Awareness</h3>
                <p>Continuous symptom tracking helps identify health patterns and potential risks early.</p>
            </div>
        </div>

        <div class="team-card">
            <div class="team-image">
                <img src="https://elitepharmacy.ca/wp-content/uploads/2023/10/elite_medicationreviews-1024x682.jpg">
            </div>
            <div class="team-info">
                <h3>Medication & Routine Assistance</h3>
                <p>Smart reminders support timely medications, appointments, and daily routines.</p>
            </div>
        </div>

        <div class="team-card">
            <div class="team-image">
                <img src="https://ohsonline.com/Articles/2023/12/08/-/media/OHS/OHS/Images/2023/12/12,-d-,8,-d-,23emergencypreparedness.jpg">
            </div>
            <div class="team-info">
                <h3>Emergency Readiness</h3>
                <p>Quick access to emergency contacts and critical health information when needed.</p>
            </div>
        </div>

    </div>
</div>

    
    <div class="cta-section">
        <div class="cta-content">
            <h2>Join the Health Revolution</h2>
            <p>Take control of your health journey today. Join thousands of users who have transformed their health management with HealthPal. Our platform is designed to grow with you, adapting to your unique health needs and goals.</p>
            <?php if(!$logged_in): ?>
            <button class="cta-btn" id="aboutCtaBtn">Get Started Free</button>
            <?php else: ?>
            <button class="cta-btn" onclick="window.location.href='#symptoms'">Continue Tracking</button>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    // Login functionality
    const openLoginBtn = document.getElementById('openLogin');
    const closeLoginBtn = document.getElementById('closeLogin');
    const loginOverlay = document.getElementById('loginOverlay');
    const showRegisterLink = document.getElementById('showRegister');
    const registerOverlay = document.getElementById('registerOverlay');
    const closeRegisterBtn = document.getElementById('closeRegister');
    const showLoginLink = document.getElementById('showLogin');
    const heroStartBtn = document.getElementById('heroStartBtn');
    const aboutCtaBtn = document.getElementById('aboutCtaBtn');

    // Disease details popup elements
    const diseaseDetailsOverlay = document.getElementById('diseaseDetailsOverlay');
    const closeDetailsBtn = document.getElementById('closeDetails');
    const diseasePopupTitle = document.getElementById('diseasePopupTitle');
    const diseasePopupDescription = document.getElementById('diseasePopupDescription');
    const diseasePopupImage = document.getElementById('diseasePopupImage');
    const diseaseSymptoms = document.getElementById('diseaseSymptoms');
    const diseaseTreatments = document.getElementById('diseaseTreatments');
    const specialistIcon = document.getElementById('specialistIcon');
    const specialistTitle = document.getElementById('specialistTitle');
    const specialistDescription = document.getElementById('specialistDescription');
    const whenToVisit = document.getElementById('whenToVisit');
    const preventionTips = document.getElementById('preventionTips');

    // Open login popup if elements exist
    if(openLoginBtn) {
        openLoginBtn.addEventListener('click', () => {
            loginOverlay.style.display = 'flex';
        });
    }

    // Close login popup if elements exist
    if(closeLoginBtn) {
        closeLoginBtn.addEventListener('click', () => {
            loginOverlay.style.display = 'none';
        });
    }

    // Show registration form if elements exist
    if(showRegisterLink) {
        showRegisterLink.addEventListener('click', (e) => {
            e.preventDefault();
            loginOverlay.style.display = 'none';
            registerOverlay.style.display = 'flex';
        });
    }

    // Close registration popup if elements exist
    if(closeRegisterBtn) {
        closeRegisterBtn.addEventListener('click', () => {
            registerOverlay.style.display = 'none';
        });
    }

    // Show login form from registration if elements exist
    if(showLoginLink) {
        showLoginLink.addEventListener('click', (e) => {
            e.preventDefault();
            registerOverlay.style.display = 'none';
            loginOverlay.style.display = 'flex';
        });
    }

    // Close disease details popup
    closeDetailsBtn.addEventListener('click', () => {
        diseaseDetailsOverlay.style.display = 'none';
    });

    // Close popups when clicking outside
    window.addEventListener('click', (e) => {
        if (loginOverlay && e.target === loginOverlay) {
            loginOverlay.style.display = 'none';
        }
        if (registerOverlay && e.target === registerOverlay) {
            registerOverlay.style.display = 'none';
        }
        if (e.target === diseaseDetailsOverlay) {
            diseaseDetailsOverlay.style.display = 'none';
        }
    });

    // Hero start button also opens login
    if(heroStartBtn) {
        heroStartBtn.addEventListener('click', () => {
            loginOverlay.style.display = 'flex';
        });
    }

    // About CTA button
    if(aboutCtaBtn) {
        aboutCtaBtn.addEventListener('click', () => {
            loginOverlay.style.display = 'flex';
        });
    }

    // Open login prompts for non-logged in users
    const loginPrompts = ['openLoginPrompt', 'openLoginPrompt2', 'openLoginPrompt3', 'openLoginPrompt4'];
    loginPrompts.forEach(promptId => {
        const element = document.getElementById(promptId);
        if(element) {
            element.addEventListener('click', (e) => {
                e.preventDefault();
                if(loginOverlay) {
                    loginOverlay.style.display = 'flex';
                }
            });
        }
    });

    // COMPLETE DISEASE DATA - All 45 diseases with full details
    const diseaseData = [
        {
            name: "Asthma",
            info: "Chronic respiratory disease causing breathing difficulty.",
            image: "https://chdcityhospital.com/wp-content/uploads/2022/07/ASTHMA.jpg",
            symptoms: ["Wheezing", "Shortness of breath", "Chest tightness", "Coughing (especially at night)", "Difficulty breathing"],
            treatments: ["Inhalers (bronchodilators)", "Steroid medications", "Anti-inflammatory drugs", "Allergy medications", "Lifestyle changes"],
            specialist: {
                icon: "fas fa-lungs",
                title: "Pulmonologist",
                description: "Specializes in respiratory system diseases",
                whenToVisit: "When experiencing frequent breathing difficulties"
            },
            prevention: ["Avoid allergens", "Use air purifier", "Exercise regularly", "Manage stress", "Get flu vaccine"]
        },
        {
            name: "Diabetes",
            info: "A metabolic disorder affecting blood sugar levels.",
            image: "https://medrechospital.com/assets/img/blog/diabetes.jpg",
            symptoms: ["Increased thirst", "Frequent urination", "Extreme hunger", "Unexplained weight loss", "Fatigue", "Blurred vision"],
            treatments: ["Insulin therapy", "Oral medications", "Blood sugar monitoring", "Dietary changes", "Regular exercise"],
            specialist: {
                icon: "fas fa-stethoscope",
                title: "Endocrinologist",
                description: "Specializes in hormonal disorders and diabetes",
                whenToVisit: "When blood sugar levels are consistently high"
            },
            prevention: ["Maintain healthy weight", "Eat balanced diet", "Exercise regularly", "Regular check-ups", "Limit sugar intake"]
        },
               {
            name: "Hypertension (BP)",
            info: "Consistently high blood pressure condition.",
            image: "https://dronurtasar.com/wp-content/uploads/2024/10/Hipertansiyon-Nedir.jpg",
            symptoms: ["Headaches", "Shortness of breath", "Nosebleeds", "Flushing", "Dizziness", "Chest pain"],
            treatments: ["ACE inhibitors", "Beta-blockers", "Diuretics", "Calcium channel blockers", "Lifestyle modifications"],
            specialist: {
                icon: "fas fa-heartbeat",
                title: "Cardiologist",
                description: "Specializes in heart and blood vessel conditions",
                whenToVisit: "When blood pressure readings are consistently high"
            },
            prevention: ["Reduce salt intake", "Exercise regularly", "Maintain healthy weight", "Limit alcohol", "Manage stress"]
        },
        {
            name: "Arthritis",
            info: "Joint inflammation causing pain and stiffness.",
            image: "https://blog.medkart.in/wp-content/uploads/2023/08/What-is-arthritis.jpg",
            symptoms: ["Joint pain", "Swelling", "Stiffness", "Reduced range of motion", "Warmth around joints", "Fatigue"],
            treatments: ["Pain relievers", "Anti-inflammatory drugs", "Physical therapy", "Joint injections", "Surgery in severe cases"],
            specialist: {
                icon: "fas fa-bone",
                title: "Rheumatologist",
                description: "Specializes in arthritis and autoimmune diseases",
                whenToVisit: "When joint pain persists for more than 2 weeks"
            },
            prevention: ["Maintain healthy weight", "Exercise regularly", "Protect joints", "Eat anti-inflammatory foods", "Avoid injuries"]
        },
        {
            name: "Migraine",
            info: "Severe headache with nausea and sensitivity.",
            image: "https://www.eroftexas.com/everything-you-need-to-know-about-migraines/images/everything-you-need-to-know-about-migraines.jpg",
            symptoms: ["Throbbing headache", "Nausea", "Sensitivity to light/sound", "Aura (visual disturbances)", "Vomiting", "Dizziness"],
            treatments: ["Pain relievers", "Triptans", "Anti-nausea drugs", "Preventive medications", "Rest in dark room"],
            specialist: {
                icon: "fas fa-brain",
                title: "Neurologist",
                description: "Specializes in nervous system and headache disorders",
                whenToVisit: "When migraines are frequent or severe"
            },
            prevention: ["Identify triggers", "Regular sleep schedule", "Stress management", "Stay hydrated", "Regular meals"]
        },
        {
            name: "COVID-19",
            info: "Viral respiratory illness.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJDCJigv5MWUH3MACqCKRBB2VeaX3kzTZbnw&s",
            symptoms: ["Fever", "Cough", "Shortness of breath", "Loss of taste/smell", "Fatigue", "Body aches"],
            treatments: ["Antiviral medications", "Rest and isolation", "Fever reducers", "Oxygen therapy (severe cases)", "Hospitalization if needed"],
            specialist: {
                icon: "fas fa-virus",
                title: "Infectious Disease Specialist",
                description: "Specializes in viral and infectious diseases",
                whenToVisit: "When experiencing COVID-19 symptoms or exposure"
            },
            prevention: ["Vaccination", "Wear masks", "Social distancing", "Hand hygiene", "Good ventilation"]
        },
        {
            name: "Tuberculosis",
            info: "Bacterial lung infection.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoTNJ-oRZ1wD4zD49G4J3dvW0XGrMd-kh3ig&s",
            symptoms: ["Persistent cough", "Chest pain", "Coughing up blood", "Fever", "Night sweats", "Weight loss"],
            treatments: ["Antibiotic therapy (6-9 months)", "Isoniazid", "Rifampin", "Ethambutol", "Pyrazinamide"],
            specialist: {
                icon: "fas fa-lungs",
                title: "Pulmonologist",
                description: "Specializes in lung diseases and infections",
                whenToVisit: "When cough lasts more than 3 weeks with fever"
            },
            prevention: ["BCG vaccination", "Avoid close contact with infected", "Good ventilation", "Cover mouth when coughing", "Complete treatment if infected"]
        },
        {
            name: "Heart Disease",
            info: "Conditions affecting the heart.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZDTtBKX2DxxVPMBs5wLL4tH8EgowxRBGW_Q&s",
            symptoms: ["Chest pain", "Shortness of breath", "Palpitations", "Fatigue", "Swelling in legs", "Dizziness"],
            treatments: ["Medications", "Angioplasty", "Bypass surgery", "Pacemaker", "Lifestyle changes", "Cardiac rehabilitation"],
            specialist: {
                icon: "fas fa-heartbeat",
                title: "Cardiologist",
                description: "Specializes in heart conditions",
                whenToVisit: "When experiencing chest pain or heart palpitations"
            },
            prevention: ["Healthy diet", "Regular exercise", "No smoking", "Control blood pressure", "Manage stress"]
        },
        {
            name: "Stroke",
            info: "Blood flow interruption to the brain.",
            image: "https://www.ayushmanhhs.in/wp-content/uploads/2024/06/Acute-Stroke-1030x686.jpg",
            symptoms: ["Sudden numbness/weakness", "Confusion", "Trouble speaking", "Vision problems", "Dizziness", "Severe headache"],
            treatments: ["Clot-busting drugs", "Thrombectomy", "Rehabilitation therapy", "Blood thinners", "Surgery"],
            specialist: {
                icon: "fas fa-brain",
                title: "Neurologist",
                description: "Specializes in brain and nervous system disorders",
                whenToVisit: "Immediately when stroke symptoms appear"
            },
            prevention: ["Control blood pressure", "Manage cholesterol", "No smoking", "Healthy diet", "Regular exercise"]
        },
        {
            name: "Eye Infection",
            info: "Bacterial or viral infection in the eye.",
            image: "https://www.cheapmedicineshop.com/blog/wp-content/uploads/2023/10/Eye-Infection.webp",
            symptoms: ["Redness", "Itching", "Discharge", "Watering", "Sensitivity to light", "Blurred vision"],
            treatments: ["Antibiotic eye drops", "Antiviral medication", "Warm compresses", "Artificial tears", "Steroid eye drops"],
            specialist: {
                icon: "fas fa-eye",
                title: "Ophthalmologist",
                description: "Specializes in eye diseases and infections",
                whenToVisit: "When eye redness persists or vision is affected"
            },
            prevention: ["Wash hands frequently", "Don't touch eyes", "Clean contact lenses properly", "Avoid sharing eye makeup", "Protect eyes from irritants"]
        },
        {
            name: "Skin Rash",
            info: "Change in skin color, texture or appearance.",
            image: "https://th.bing.com/th/id/OIP.AiJknHD_srrZd0eOgop__QHaEK?w=310&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Red patches", "Itching", "Bumps", "Blisters", "Dryness", "Swelling"],
            treatments: ["Topical creams", "Antihistamines", "Moisturizers", "Steroid creams", "Avoid triggers"],
            specialist: {
                icon: "fas fa-allergies",
                title: "Dermatologist",
                description: "Specializes in skin conditions",
                whenToVisit: "When rash spreads or doesn't improve"
            },
            prevention: ["Identify allergens", "Use gentle skincare", "Moisturize regularly", "Avoid irritants", "Protect from sun"]
        },
        {
            name: "Joint Pain",
            info: "Discomfort in joints like knees, hips, hands.",
            image: "https://th.bing.com/th/id/OIP.p_7TvuSfvVbiaNnpAbYNYwHaEo?w=278&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Pain in joints", "Stiffness", "Swelling", "Warmth", "Reduced mobility", "Crepitus (cracking sound)"],
            treatments: ["Pain relievers", "Anti-inflammatory drugs", "Physical therapy", "Joint injections", "Rest"],
            specialist: {
                icon: "fas fa-bone",
                title: "Orthopedist",
                description: "Specializes in musculoskeletal system",
                whenToVisit: "When joint pain affects daily activities"
            },
            prevention: ["Maintain healthy weight", "Low-impact exercise", "Proper posture", "Strengthen muscles", "Avoid overuse"]
        },
        {
            name: "Muscle Pain",
            info: "Pain in muscles, often from overuse.",
            image: "https://th.bing.com/th/id/OIP.eBA6h0geidsHRNYAcY_oUAHaE7?w=245&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Muscle soreness", "Stiffness", "Weakness", "Cramps", "Tenderness", "Limited movement"],
            treatments: ["Rest", "Ice/heat therapy", "Pain relievers", "Stretching", "Massage", "Muscle relaxants"],
            specialist: {
                icon: "fas fa-running",
                title: "Sports Medicine Specialist",
                description: "Specializes in muscle and sports injuries",
                whenToVisit: "When muscle pain is severe or persistent"
            },
            prevention: ["Warm up before exercise", "Stay hydrated", "Proper technique", "Gradual increase in activity", "Adequate rest"]
        },
        {
            name: "Fatigue",
            info: "Extreme tiredness or lack of energy.",
            image: "https://th.bing.com/th/id/OIP.oCRQ4y-pk2MviULJDXaRwAHaE8?w=291&h=194&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Constant tiredness", "Weakness", "Lack of motivation", "Difficulty concentrating", "Headaches", "Irritability"],
            treatments: ["Identify underlying cause", "Lifestyle changes", "Sleep improvement", "Stress management", "Nutritional support"],
            specialist: {
                icon: "fas fa-bed",
                title: "General Physician",
                description: "Treats general health issues and fatigue",
                whenToVisit: "When fatigue affects daily life for more than 2 weeks"
            },
            prevention: ["Regular sleep schedule", "Balanced diet", "Regular exercise", "Stress reduction", "Stay hydrated"]
        },
        {
            name: "Insomnia",
            info: "Difficulty falling or staying asleep.",
            image: "https://th.bing.com/th/id/OIP.ChGPXPfSKACzwL66IXT9OgHaE8?w=288&h=192&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Difficulty falling asleep", "Waking up often", "Waking up too early", "Daytime sleepiness", "Irritability", "Poor concentration"],
            treatments: ["Cognitive behavioral therapy", "Sleep medications", "Relaxation techniques", "Sleep hygiene", "Light therapy"],
            specialist: {
                icon: "fas fa-moon",
                title: "Sleep Specialist",
                description: "Specializes in sleep disorders",
                whenToVisit: "When insomnia lasts more than 3 weeks"
            },
            prevention: ["Consistent sleep schedule", "Avoid caffeine/alcohol", "Create restful environment", "Limit screen time before bed", "Regular exercise"]
        },
        {
            name: "Stress",
            info: "Mental or emotional strain.",
            image: "https://tse2.mm.bing.net/th/id/OIP.BLn3BvCwXIJo7irPmALtRQHaEA?pid=ImgDet&w=206&h=111&c=7&dpr=1.1&o=7&rm=3",
            symptoms: ["Anxiety", "Irritability", "Headaches", "Muscle tension", "Sleep problems", "Fatigue"],
            treatments: ["Counseling/therapy", "Meditation", "Exercise", "Time management", "Medications if severe"],
            specialist: {
                icon: "fas fa-brain",
                title: "Psychologist/Psychiatrist",
                description: "Specializes in mental health",
                whenToVisit: "When stress affects daily functioning"
            },
            prevention: ["Regular exercise", "Healthy diet", "Adequate sleep", "Time management", "Social support"]
        },
        {
            name: "Anemia",
            info: "Low red blood cell count.",
            image: "https://media.allaboutvision.com/cms/caas/v1/media/422458/data/picture/c7d97ab5e1775a0796c700c4566e2075.png",
            symptoms: ["Fatigue", "Weakness", "Pale skin", "Shortness of breath", "Dizziness", "Cold hands/feet"],
            treatments: ["Iron supplements", "Vitamin B12 shots", "Folic acid", "Dietary changes", "Blood transfusion in severe cases"],
            specialist: {
                icon: "fas fa-tint",
                title: "Hematologist",
                description: "Specializes in blood disorders",
                whenToVisit: "When experiencing persistent fatigue and weakness"
            },
            prevention: ["Iron-rich diet", "Vitamin C intake", "Regular check-ups", "Treat underlying causes", "Avoid blood loss"]
        },
        {
            name: "Dengue",
            info: "Mosquito-borne viral disease.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDlD70kmLJGifG-2Bh5xV0Tx57V-y5p0QsnA&s",
            symptoms: ["High fever", "Severe headache", "Pain behind eyes", "Joint/muscle pain", "Nausea/vomiting", "Skin rash"],
            treatments: ["Rest and hydration", "Pain relievers (avoid aspirin)", "Hospitalization for severe cases", "Platelet transfusion if needed"],
            specialist: {
                icon: "fas fa-virus",
                title: "Infectious Disease Specialist",
                description: "Specializes in viral diseases",
                whenToVisit: "When fever with rash and severe pain occurs"
            },
            prevention: ["Mosquito control", "Use repellents", "Wear protective clothing", "Eliminate standing water", "Use mosquito nets"]
        },
        {
            name: "Malaria",
            info: "Parasitic mosquito-borne disease.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQh9l38gv6hoqQDstwgfF32XMratkjRahF1Q&s",
            symptoms: ["Fever and chills", "Sweating", "Headache", "Nausea/vomiting", "Muscle pain", "Fatigue"],
            treatments: ["Antimalarial medications", "Artemisinin-based therapy", "Quinine", "Chloroquine", "Hospitalization for severe cases"],
            specialist: {
                icon: "fas fa-bug",
                title: "Infectious Disease Specialist",
                description: "Specializes in parasitic infections",
                whenToVisit: "When fever occurs after mosquito bite or travel to endemic areas"
            },
            prevention: ["Antimalarial prophylaxis", "Mosquito nets", "Insect repellent", "Cover skin", "Eliminate breeding sites"]
        },
        {
            name: "Pneumonia",
            info: "Lung infection causing inflammation.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGkdLyplDDVCpCOcjfY6QWhtmx0gBGnmMTtw&s",
            symptoms: ["Cough with phlegm", "Fever", "Chills", "Shortness of breath", "Chest pain", "Fatigue"],
            treatments: ["Antibiotics", "Antiviral drugs", "Cough medicine", "Fever reducers", "Oxygen therapy", "Hospitalization if severe"],
            specialist: {
                icon: "fas fa-lungs",
                title: "Pulmonologist",
                description: "Specializes in lung infections",
                whenToVisit: "When cough with fever and breathing difficulty occurs"
            },
            prevention: ["Pneumonia vaccine", "Flu vaccine", "Good hygiene", "No smoking", "Healthy lifestyle"]
        },
        {
            name: "Depression",
            info: "Mental health disorder.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQV-uO3oMkDjWF5CcoDdeFr4YRxnuhN9kDgCA&s",
            symptoms: ["Persistent sadness", "Loss of interest", "Sleep changes", "Appetite changes", "Fatigue", "Thoughts of death/suicide"],
            treatments: ["Psychotherapy", "Antidepressants", "Lifestyle changes", "Support groups", "ECT for severe cases"],
            specialist: {
                icon: "fas fa-brain",
                title: "Psychiatrist",
                description: "Specializes in mental health disorders",
                whenToVisit: "When symptoms last more than 2 weeks"
            },
            prevention: ["Regular exercise", "Social connections", "Stress management", "Healthy sleep", "Seek help early"]
        },
        {
            name: "Gastritis",
            info: "Inflammation of stomach lining.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTAjbelni1-NzCF-r_1aqG5sSDB6zNweixig&s",
            symptoms: ["Upper abdominal pain", "Nausea", "Vomiting", "Bloating", "Loss of appetite", "Indigestion"],
            treatments: ["Antacids", "H2 blockers", "Proton pump inhibitors", "Antibiotics for H. pylori", "Dietary changes"],
            specialist: {
                icon: "fas fa-stomach",
                title: "Gastroenterologist",
                description: "Specializes in digestive system disorders",
                whenToVisit: "When stomach pain persists or worsens"
            },
            prevention: ["Avoid irritants", "Limit alcohol", "Manage stress", "Eat smaller meals", "Avoid NSAIDs if possible"]
        },
        {
            name: "Osteoporosis",
            info: "Bone disease that increases risk of fractures.",
            image: "https://mindbodyspine.ca/wp-content/uploads/2015/07/Osteoporosis-Stages.jpg",
            symptoms: ["Back pain", "Loss of height", "Stooped posture", "Bone fractures easily", "Reduced mobility"],
            treatments: ["Bisphosphonates", "Calcium supplements", "Vitamin D", "Weight-bearing exercise", "Bone-building medications"],
            specialist: {
                icon: "fas fa-bone",
                title: "Endocrinologist/Rheumatologist",
                description: "Specializes in bone metabolism disorders",
                whenToVisit: "After menopause or if fractures occur easily"
            },
            prevention: ["Adequate calcium/vitamin D", "Weight-bearing exercise", "No smoking", "Limit alcohol", "Fall prevention"]
        },
        {
            name: "Alzheimer's",
            info: "Progressive neurodegenerative disease affecting memory.",
            image: "https://th.bing.com/th/id/OIP.Usg0nLFrYBottL0Z3ysdQgHaE7?w=234&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Memory loss", "Confusion", "Difficulty communicating", "Poor judgment", "Personality changes", "Getting lost"],
            treatments: ["Cholinesterase inhibitors", "Memantine", "Cognitive therapy", "Supportive care", "Safety measures"],
            specialist: {
                icon: "fas fa-brain",
                title: "Neurologist",
                description: "Specializes in neurodegenerative diseases",
                whenToVisit: "When memory problems affect daily life"
            },
            prevention: ["Mental stimulation", "Social engagement", "Healthy diet", "Regular exercise", "Manage heart health"]
        },
        {
            name: "Parkinson's",
            info: "Neurological disorder affecting movement.",
            image: "https://th.bing.com/th/id/OIP.k4BGq1QbBdrzADnzDMTiWQHaD4?w=311&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Tremors", "Stiffness", "Slow movement", "Balance problems", "Speech changes", "Writing changes"],
            treatments: ["Levodopa", "Dopamine agonists", "MAO B inhibitors", "Physical therapy", "Deep brain stimulation"],
            specialist: {
                icon: "fas fa-brain",
                title: "Neurologist",
                description: "Specializes in movement disorders",
                whenToVisit: "When tremors or movement problems develop"
            },
            prevention: ["Regular exercise", "Healthy diet", "Avoid toxins", "Caffeine may help", "No known prevention"]
        },
        {
            name: "Cancer",
            info: "Uncontrolled cell growth forming tumors.",
            image: "https://th.bing.com/th/id/OIP.F10WgbKPgEGr-UbfHNoqGAHaFu?w=203&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Lump or thickening", "Unexplained weight loss", "Fatigue", "Skin changes", "Persistent cough", "Unusual bleeding"],
            treatments: ["Surgery", "Chemotherapy", "Radiation", "Immunotherapy", "Targeted therapy", "Hormone therapy"],
            specialist: {
                icon: "fas fa-hospital",
                title: "Oncologist",
                description: "Specializes in cancer treatment",
                whenToVisit: "When suspicious symptoms persist"
            },
            prevention: ["No smoking", "Healthy diet", "Regular exercise", "Sun protection", "Regular screenings"]
        },
        {
            name: "Hepatitis",
            info: "Liver inflammation, often viral in origin.",
            image: "https://th.bing.com/th/id/OIP.biWbR1k2-Bba2qzbXUqgLAHaEc?w=304&h=182&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Fatigue", "Jaundice", "Abdominal pain", "Loss of appetite", "Nausea", "Dark urine"],
            treatments: ["Antiviral medications", "Interferon therapy", "Liver transplant in severe cases", "Rest", "Avoid alcohol"],
            specialist: {
                icon: "fas fa-liver",
                title: "Hepatologist",
                description: "Specializes in liver diseases",
                whenToVisit: "When jaundice or liver symptoms appear"
            },
            prevention: ["Vaccination (Hep A & B)", "Safe sex practices", "Avoid sharing needles", "Food/water safety", "Limit alcohol"]
        },
        {
            name: "Thyroid Disorder",
            info: "Imbalance in thyroid hormone production.",
            image: "https://th.bing.com/th/id/OIP.3stDDKvgATIgT86HFQq0IQHaHa?w=199&h=199&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Weight changes", "Fatigue", "Mood changes", "Temperature sensitivity", "Hair/skin changes", "Heart rate changes"],
            treatments: ["Thyroid hormone replacement", "Anti-thyroid medications", "Radioactive iodine", "Surgery", "Regular monitoring"],
            specialist: {
                icon: "fas fa-gland",
                title: "Endocrinologist",
                description: "Specializes in hormonal disorders",
                whenToVisit: "When thyroid symptoms are present"
            },
            prevention: ["Iodine in diet", "Regular check-ups", "Manage stress", "Avoid radiation exposure", "Healthy lifestyle"]
        },
        {
            name: "High Cholesterol",
            info: "High levels of lipids in the blood.",
            image: "https://th.bing.com/th/id/OIP.WbzdMNoS8jrYSfIln7gffwHaD4?w=298&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Usually no symptoms", "Xanthomas (fatty deposits)", "Chest pain (if arteries affected)", "Shortness of breath"],
            treatments: ["Statins", "Fibrates", "Niacin", "Bile acid sequestrants", "Diet and exercise", "PCSK9 inhibitors"],
            specialist: {
                icon: "fas fa-heartbeat",
                title: "Cardiologist",
                description: "Specializes in heart and vascular health",
                whenToVisit: "When cholesterol levels are high on screening"
            },
            prevention: ["Healthy diet", "Regular exercise", "Maintain healthy weight", "No smoking", "Limit alcohol"]
        },
        {
            name: "Kidney Stones",
            info: "Hard mineral deposits in kidneys.",
            image: "https://th.bing.com/th/id/OIP.FM1yLc_CTpvzPnY9QPXQXgHaFH?w=262&h=181&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Severe flank pain", "Painful urination", "Blood in urine", "Nausea/vomiting", "Frequent urination", "Fever if infected"],
            treatments: ["Pain relief", "Increased fluid intake", "Medications to help pass stones", "Lithotripsy", "Surgery for large stones"],
            specialist: {
                icon: "fas fa-kidneys",
                title: "Urologist",
                description: "Specializes in urinary system disorders",
                whenToVisit: "When severe pain or blood in urine occurs"
            },
            prevention: ["Drink plenty of water", "Limit salt", "Reduce oxalate-rich foods", "Adequate calcium", "Limit animal protein"]
        },
        {
            name: "Psoriasis",
            info: "Chronic autoimmune skin condition.",
            image: "https://th.bing.com/th/id/OIP.II6w4gM2MFgoOPTfnsc4igHaEJ?w=280&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Red patches with silvery scales", "Dry cracked skin", "Itching/burning", "Thickened/pitted nails", "Stiff/swollen joints"],
            treatments: ["Topical corticosteroids", "Vitamin D analogues", "Light therapy", "Oral medications", "Biologics"],
            specialist: {
                icon: "fas fa-allergies",
                title: "Dermatologist",
                description: "Specializes in skin autoimmune conditions",
                whenToVisit: "When skin lesions appear and persist"
            },
            prevention: ["Moisturize skin", "Avoid triggers", "Manage stress", "No smoking", "Limit alcohol"]
        },
        {
            name: "Bronchitis",
            info: "Inflammation of bronchial tubes in lungs.",
            image: "https://th.bing.com/th/id/OIP.50eqKR0GPtzJ_5iKoy92-wHaFS?w=241&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Cough with mucus", "Fatigue", "Shortness of breath", "Slight fever/chills", "Chest discomfort"],
            treatments: ["Cough medicine", "Bronchodilators", "Anti-inflammatory drugs", "Antibiotics if bacterial", "Rest and fluids"],
            specialist: {
                icon: "fas fa-lungs",
                title: "Pulmonologist",
                description: "Specializes in respiratory conditions",
                whenToVisit: "When cough persists more than 3 weeks"
            },
            prevention: ["No smoking", "Avoid irritants", "Wash hands frequently", "Wear mask when needed", "Get vaccinated"]
        },
        {
            name: "Epilepsy",
            info: "Neurological disorder causing seizures.",
            image: "https://th.bing.com/th/id/OIP.BiNzA_9W_7T32uyMA4eXEgHaD4?w=310&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Temporary confusion", "Staring spells", "Uncontrollable jerking", "Loss of consciousness", "Fear/anxiety", "Deja vu"],
            treatments: ["Anti-seizure medications", "Ketogenic diet", "Vagus nerve stimulation", "Surgery", "Responsive neurostimulation"],
            specialist: {
                icon: "fas fa-brain",
                title: "Neurologist",
                description: "Specializes in seizure disorders",
                whenToVisit: "After first seizure or recurrent seizures"
            },
            prevention: ["Take medications as prescribed", "Get adequate sleep", "Manage stress", "Avoid triggers", "Wear helmet when needed"]
        },
        {
            name: "Obesity",
            info: "Excessive body fat accumulation.",
            image: "https://th.bing.com/th/id/OIP.wMhQY-qgkYanP6a-88h78QHaEK?w=298&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Excess body fat", "Difficulty with physical activity", "Shortness of breath", "Increased sweating", "Joint pain", "Fatigue"],
            treatments: ["Dietary changes", "Exercise program", "Behavioral therapy", "Medications", "Bariatric surgery"],
            specialist: {
                icon: "fas fa-weight",
                title: "Bariatric Specialist/Endocrinologist",
                description: "Specializes in weight management",
                whenToVisit: "When BMI is 30 or higher"
            },
            prevention: ["Balanced diet", "Regular exercise", "Portion control", "Limit processed foods", "Regular check-ups"]
        },
        {
            name: "Allergy",
            info: "Immune system reaction to foreign substances.",
            image: "https://th.bing.com/th/id/OIP.TL53DjtHf7dlNFVDFSmlTQHaE8?w=270&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Sneezing", "Itching", "Runny nose", "Watery eyes", "Skin rash", "Swelling"],
            treatments: ["Antihistamines", "Decongestants", "Nasal sprays", "Eye drops", "Immunotherapy", "Avoid allergens"],
            specialist: {
                icon: "fas fa-allergies",
                title: "Allergist",
                description: "Specializes in allergic conditions",
                whenToVisit: "When allergies affect quality of life"
            },
            prevention: ["Avoid allergens", "Use air purifiers", "Keep windows closed", "Shower after being outdoors", "Clean regularly"]
        },
        {
            name: "Common Cold",
            info: "Viral infection of nose and throat.",
            image: "https://th.bing.com/th/id/OIP.ik_6q8fL5smxVbxlgi6n9QAAAA?w=277&h=184&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Runny nose", "Sore throat", "Coughing", "Sneezing", "Mild headache", "Body aches"],
            treatments: ["Rest and hydration", "Over-the-counter cold medicines", "Pain relievers", "Nasal decongestants", "Warm salt water gargle"],
            specialist: {
                icon: "fas fa-user-md",
                title: "General Physician",
                description: "Treats common illnesses and viral infections",
                whenToVisit: "When symptoms last more than 10 days or worsen"
            },
            prevention: ["Wash hands frequently", "Avoid close contact with sick people", "Boost immunity", "Stay hydrated", "Get adequate sleep"]
        },
        {
            name: "Fever",
            info: "Elevated body temperature often due to infection.",
            image: "https://th.bing.com/th/id/OIP.YJ7WdsJAw5h3xxfup8uFlQHaE8?w=279&h=185&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["High body temperature", "Sweating", "Chills and shivering", "Headache", "Muscle aches", "Weakness"],
            treatments: ["Antipyretics (fever reducers)", "Rest and fluids", "Cool compresses", "Light clothing", "Medical evaluation if persistent"],
            specialist: {
                icon: "fas fa-thermometer",
                title: "General Physician",
                description: "Treats common illnesses and infections",
                whenToVisit: "When fever exceeds 103°F or lasts more than 3 days"
            },
            prevention: ["Practice good hygiene", "Stay up-to-date with vaccinations", "Avoid sick individuals", "Boost immune system", "Stay hydrated"]
        },
        {
            name: "Cough",
            info: "Reflex to clear throat of mucus or irritants.",
            image: "https://wexnermedical.osu.edu/-/media/images/wexnermedical/blog/2018-stories/12/my-cold-is-gone-so-why-am-i-still-coughing/lingering-cough_large.jpg",
            symptoms: ["Persistent coughing", "Throat irritation", "Chest discomfort", "Difficulty breathing", "Wheezing", "Sputum production"],
            treatments: ["Cough suppressants", "Expectorants", "Steam inhalation", "Honey and warm liquids", "Throat lozenges"],
            specialist: {
                icon: "fas fa-lungs",
                title: "Pulmonologist",
                description: "Specializes in respiratory conditions",
                whenToVisit: "When cough lasts more than 3 weeks or produces blood"
            },
            prevention: ["Avoid irritants (smoke, dust)", "Stay hydrated", "Use humidifier", "Practice good hygiene", "Avoid allergens"]
        },
        {
            name: "Headache",
            info: "Pain in head or upper neck region.",
            image: "https://www.barrowneuro.org/wp-content/uploads/iStock-896115300-2000x1125.jpg",
            symptoms: ["Throbbing pain", "Pressure in head", "Sensitivity to light/sound", "Nausea", "Blurred vision", "Dizziness"],
            treatments: ["Pain relievers", "Rest in dark room", "Cold compresses", "Hydration", "Stress management techniques"],
            specialist: {
                icon: "fas fa-brain",
                title: "Neurologist",
                description: "Specializes in nervous system disorders",
                whenToVisit: "When headaches are severe, frequent, or accompanied by neurological symptoms"
            },
            prevention: ["Regular sleep schedule", "Stress management", "Regular meals", "Limit caffeine/alcohol", "Good posture"]
        },
        {
            name: "Back Pain",
            info: "Pain felt in the back, usually lower back.",
            image: "https://th.bing.com/th/id/OIP.jRV72bHswzqwaAhvW-YE6wHaEK?w=328&h=184&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Muscle ache", "Shooting/burning pain", "Pain radiating down legs", "Stiffness", "Difficulty standing straight"],
            treatments: ["Pain medication", "Physical therapy", "Heat/cold therapy", "Massage", "Exercise and stretching"],
            specialist: {
                icon: "fas fa-bone",
                title: "Orthopedist",
                description: "Specializes in musculoskeletal system",
                whenToVisit: "When pain is severe, persistent, or accompanied by leg weakness"
            },
            prevention: ["Exercise regularly", "Maintain good posture", "Lift properly", "Use ergonomic furniture", "Maintain healthy weight"]
        },
        {
            name: "Acidity",
            info: "Excess stomach acid causing heartburn.",
            image: "https://th.bing.com/th/id/OIP.h5n2eKJcu6p8bFdyil87kAHaFj?w=230&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Heartburn", "Regurgitation", "Bloating", "Burping", "Nausea", "Stomach discomfort"],
            treatments: ["Antacids", "H2 blockers", "Proton pump inhibitors", "Dietary changes", "Lifestyle modifications"],
            specialist: {
                icon: "fas fa-stomach",
                title: "Gastroenterologist",
                description: "Specializes in digestive system disorders",
                whenToVisit: "When acidity occurs frequently or interferes with daily life"
            },
            prevention: ["Avoid trigger foods", "Eat smaller meals", "Don't lie down after eating", "Maintain healthy weight", "Limit alcohol/caffeine"]
        },
        {
            name: "Constipation",
            info: "Difficulty in passing stools regularly.",
            image: "https://tse3.mm.bing.net/th/id/OIP.nePeOl8gOBOtjPtKl7gEiQHaHa?pid=ImgDet&w=206&h=206&c=7&dpr=1.1&o=7&rm=3",
            symptoms: ["Infrequent bowel movements", "Hard/dry stools", "Straining", "Feeling of blockage", "Abdominal bloating", "Need for manual assistance"],
            treatments: ["Fiber supplements", "Laxatives", "Stool softeners", "Increased fluids", "Exercise", "Probiotics"],
            specialist: {
                icon: "fas fa-stomach",
                title: "Gastroenterologist",
                description: "Specializes in digestive disorders",
                whenToVisit: "When constipation lasts more than 3 weeks"
            },
            prevention: ["High-fiber diet", "Drink plenty of water", "Regular exercise", "Don't ignore urge", "Establish routine"]
        },
        {
            name: "Diarrhea",
            info: "Frequent loose or watery bowel movements.",
            image: "https://tse2.mm.bing.net/th/id/OIP.KNXloK0FrgddGV5hoT6mVAHaE8?rs=1&pid=ImgDetMain&o=7&rm=3",
            symptoms: ["Watery stools", "Urgent need for bowel movement", "Abdominal cramps", "Bloating", "Nausea", "Fever if infection"],
            treatments: ["Oral rehydration solutions", "Anti-diarrheal medications", "Antibiotics if bacterial", "BRAT diet", "Probiotics"],
            specialist: {
                icon: "fas fa-stomach",
                title: "Gastroenterologist",
                description: "Specializes in digestive disorders",
                whenToVisit: "When diarrhea lasts more than 2 days or is severe"
            },
            prevention: ["Food safety practices", "Clean water", "Hand washing", "Proper food storage", "Avoid contaminated food/water"]
        },
        {
            name: "Flu (Influenza)",
            info: "Contagious respiratory illness.",
            image: "https://th.bing.com/th/id/OIP.2cKd2OrBk6MeS9F2OKLg9wHaEK?w=308&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Fever", "Body aches", "Fatigue", "Sore throat", "Cough", "Headache", "Chills"],
            treatments: ["Antiviral medications", "Rest and fluids", "Pain relievers", "Fever reducers", "Cough medicine"],
            specialist: {
                icon: "fas fa-user-md",
                title: "General Physician",
                description: "Treats viral infections and common illnesses",
                whenToVisit: "When symptoms are severe or risk of complications is high"
            },
            prevention: ["Annual flu vaccine", "Frequent hand washing", "Avoid sick people", "Boost immunity", "Stay home when sick"]
        },
        {
            name: "Sore Throat",
            info: "Pain, scratchiness or irritation of throat.",
            image: "https://pacificcross.com.vn/wp-content/uploads/2021/01/Sore-throat-1024x682.jpeg",
            symptoms: ["Throat pain", "Difficulty swallowing", "Dry/scratchy throat", "Swollen glands", "Hoarseness", "Red/swollen tonsils"],
            treatments: ["Warm salt water gargle", "Lozenges", "Pain relievers", "Antibiotics if bacterial", "Increased fluids", "Rest"],
            specialist: {
                icon: "fas fa-user-md",
                title: "General Physician/ENT Specialist",
                description: "Treats throat infections and conditions",
                whenToVisit: "When sore throat is severe or lasts more than a week"
            },
            prevention: ["Wash hands frequently", "Avoid sharing utensils", "Stay hydrated", "Avoid irritants", "Humidify air"]
        },
        {
            name: "Sinus Infection",
            info: "Inflammation of sinus cavities.",
            image: "https://parkside-suite-frimley.org.uk/wp-content/uploads/2023/03/Respiratory-Medicine_Parkside-Suite.jpg",
            symptoms: ["Facial pain/pressure", "Nasal congestion", "Thick nasal discharge", "Loss of smell", "Cough", "Fatigue"],
            treatments: ["Nasal decongestants", "Saline nasal spray", "Antibiotics if bacterial", "Nasal corticosteroids", "Pain relievers", "Steam inhalation"],
            specialist: {
                icon: "fas fa-head-side-virus",
                title: "ENT Specialist",
                description: "Specializes in ear, nose, and throat conditions",
                whenToVisit: "When symptoms last more than 10 days or are severe"
            },
            prevention: ["Avoid allergens", "Use humidifier", "Stay hydrated", "Nasal irrigation", "Wash hands frequently"]
        },
        {
            name: "Urinary Infection",
            info: "Infection in any part of urinary system.",
            image: "https://th.bing.com/th/id/OIP.h3n7RBQQsvzws3eGsJeX4AHaEb?w=292&h=180&c=7&r=0&o=7&dpr=1.1&pid=1.7&rm=3",
            symptoms: ["Burning during urination", "Frequent urination", "Cloudy/strong-smelling urine", "Pelvic pain", "Fever/chills if kidney infection"],
            treatments: ["Antibiotics", "Increased fluid intake", "Pain relievers", "Heating pad for pain", "Cranberry products may help"],
            specialist: {
                icon: "fas fa-bladder",
                title: "Urologist",
                description: "Specializes in urinary system disorders",
                whenToVisit: "When UTI symptoms appear, especially with fever"
            },
            prevention: ["Drink plenty of water", "Wipe front to back", "Urinate after intercourse", "Avoid irritating feminine products", "Empty bladder regularly"]
        }

    ];

    function showDiseases(list) {
        diseaseContainer.innerHTML = "";
        list.forEach(d => {
            const diseaseCard = document.createElement("div");
            diseaseCard.className = "disease-card";
            diseaseCard.innerHTML = `
                <img src="${d.image}">
                <h3>${d.name}</h3>
                <p>${d.info}</p>
            `;
            
            // Add click event to show disease details
            diseaseCard.addEventListener('click', () => {
                showDiseaseDetails(d);
            });
            
            diseaseContainer.appendChild(diseaseCard);
        });
    }

    function showDiseaseDetails(disease) {
        // Set basic disease information
        diseasePopupTitle.textContent = disease.name;
        diseasePopupDescription.textContent = disease.info;
        diseasePopupImage.src = disease.image;
        diseasePopupImage.alt = disease.name;
        
        // Clear previous lists
        diseaseSymptoms.innerHTML = '';
        diseaseTreatments.innerHTML = '';
        preventionTips.innerHTML = '';
        
        // Populate symptoms
        if (disease.symptoms) {
            disease.symptoms.forEach(symptom => {
                const li = document.createElement('li');
                li.textContent = symptom;
                diseaseSymptoms.appendChild(li);
            });
        }
        
        // Populate treatments
        if (disease.treatments) {
            disease.treatments.forEach(treatment => {
                const li = document.createElement('li');
                li.textContent = treatment;
                diseaseTreatments.appendChild(li);
            });
        }
        
        // Set specialist information
        if (disease.specialist) {
            specialistIcon.className = disease.specialist.icon;
            specialistTitle.textContent = disease.specialist.title;
            specialistDescription.textContent = disease.specialist.description;
            whenToVisit.textContent = disease.specialist.whenToVisit;
        }
        
        // Populate prevention tips
        if (disease.prevention) {
            const tipIcons = ['fas fa-hands-wash', 'fas fa-apple-alt', 'fas fa-running', 'fas fa-bed', 'fas fa-heart'];
            disease.prevention.forEach((tip, index) => {
                const tipItem = document.createElement('div');
                tipItem.className = 'tip-item';
                tipItem.innerHTML = `
                    <i class="${tipIcons[index] || 'fas fa-shield-alt'}"></i>
                    <p>${tip}</p>
                `;
                preventionTips.appendChild(tipItem);
            });
        }
        
        // Show the popup
        diseaseDetailsOverlay.style.display = 'flex';
    }

    // Initial display of diseases
    showDiseases(diseaseData);

    // Search functionality
    diseaseSearch.oninput = () => {
        const searchTerm = diseaseSearch.value.toLowerCase();
        const filteredDiseases = diseaseData.filter(d => 
            d.name.toLowerCase().includes(searchTerm) || 
            d.info.toLowerCase().includes(searchTerm)
        );
        showDiseases(filteredDiseases);
    };

    // Smooth scrolling for navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add scroll animations
    window.addEventListener('scroll', () => {
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => {
            const sectionTop = section.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            if (sectionTop < windowHeight * 0.8) {
                section.classList.add('fade-in');
            }
        });
    });

    // Initialize first scroll animation
    window.dispatchEvent(new Event('scroll'));
</script>

</body>
</html>
