<style>
/* Navigation link tap/click animation */
.nav-links a {
    position: relative;
    overflow: hidden;
}
.nav-links a:active {
    color: var(--accent);
    background: rgba(140, 109, 98, 0.08);
    transition: background 0.2s, color 0.2s;
}
.nav-links a .nav-ripple {
    position: absolute;
    border-radius: 50%;
    transform: scale(0);
    animation: nav-ripple 0.5s linear;
    background: rgba(140, 109, 98, 0.18);
    pointer-events: none;
    z-index: 1;
}
@keyframes nav-ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
:root {
    --primary: #b76e79; /* Romantic rose gold */
    --accent: #d4af8a; /* Soft gold */
    --dark: #333333; /* Deep charcoal */
    --light: #f9f5f2; /* Creamy white */
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

/* Base Styles */
.wedding-header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    background: rgba(249, 245, 242, 0.98);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    box-shadow: var(--shadow);
    padding: 1.5rem 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: var(--transition);
    border-bottom: 1px solid rgba(214, 175, 138, 0.2);
}

.wedding-header.scrolled {
    padding: 1rem 5%;
    background: rgba(249, 245, 242, 0.98);
    box-shadow: 0 4px 30px rgba(183, 110, 121, 0.1);
}

/* Logo Styles */
.logo {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    color: var(--primary);
    text-decoration: none;
    display: flex;
    align-items: center;
    letter-spacing: 1px;
    font-weight: 600;
    transition: var(--transition);
}

.logo i {
    margin-right: 12px;
    color: var(--accent);
    font-size: 1.2em;
    transition: var(--transition);
}

.logo:hover {
    transform: translateY(-2px);
}

.logo:hover i {
    transform: scale(1.1) rotate(-10deg);
}

/* Navigation Links */
.nav-links {
    display: flex;
    gap: clamp(1.5rem, 3vw, 2.5rem);
    align-items: center;
}

.nav-links a {
    position: relative;
    text-decoration: none;
    color: var(--dark);
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
    font-size: 1rem;
    letter-spacing: 0.5px;
    padding: 0.5rem 0;
    transition: var(--transition);
    overflow: hidden;
}

.nav-links a::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    transition: var(--transition);
}

.nav-links a:hover {
    color: var(--primary);
    transform: translateY(-2px);
}

.nav-links a:hover::before {
    width: 100%;
}

/* Mobile Menu Button */
.mobile-menu-btn {
    display: none;
    background: transparent;
    border: none;
    color: var(--primary);
    font-size: 1.8rem;
    cursor: pointer;
    transition: var(--transition);
    padding: 0.5rem;
    border-radius: 4px;
}

.mobile-menu-btn:hover {
    color: var(--accent);
    transform: scale(1.1);
}

.mobile-menu-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(183, 110, 121, 0.3);
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .wedding-header {
        padding: 1rem 5%;
        flex-direction: row;
        align-items: center;
    }
    
    .nav-links {
        position: fixed;
        top: 80px;
        left: 0;
        width: 100%;
        background: var(--light);
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
        padding: 2rem 0;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-150%);
        opacity: 0;
        transition: var(--transition);
        z-index: 999;
    }
    
    .nav-links.active {
        transform: translateY(0);
        opacity: 1;
    }
    
    .mobile-menu-btn {
        display: block;
    }
}

/* Animation for Nav Links */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.nav-links.active a {
    animation: fadeIn 0.4s ease forwards;
}

.nav-links.active a:nth-child(1) { animation-delay: 0.1s; }
.nav-links.active a:nth-child(2) { animation-delay: 0.2s; }
.nav-links.active a:nth-child(3) { animation-delay: 0.3s; }
.nav-links.active a:nth-child(4) { animation-delay: 0.4s; }
</style>

<header class="wedding-header">
    <a href="#" class="logo">
        <i class="fas fa-heart"></i>
        <span class="couple-names">Efarina & Norden</span>
    </a>
    
    <nav class="nav-links">
        <a href="#gallery"><i class="fas fa-camera-retro"></i> Galeri</a>
        <a href="#memories"><i class="fas fa-heartbeat"></i> Memori</a>
        <a href="#contact"><i class="fas fa-envelope"></i> Hubungi</a>
    </nav>
    
    <button class="mobile-menu-btn" aria-label="Toggle navigation menu">
        <i class="fas fa-bars"></i>
    </button>
</header>

<script>
// Header scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.wedding-header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Mobile menu toggle
const mobileBtn = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');

mobileBtn.addEventListener('click', function() {
    navLinks.classList.toggle('active');
    this.setAttribute('aria-expanded', navLinks.classList.contains('active'));
    
    // Toggle icon between bars and times
    const icon = this.querySelector('i');
    if (navLinks.classList.contains('active')) {
        icon.classList.replace('fa-bars', 'fa-times');
    } else {
        icon.classList.replace('fa-times', 'fa-bars');
    }
});

// Close menu when clicking on a link (for mobile)
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            navLinks.classList.remove('active');
            mobileBtn.querySelector('i').classList.replace('fa-times', 'fa-bars');
            mobileBtn.setAttribute('aria-expanded', 'false');
        }
    });
});
</script>