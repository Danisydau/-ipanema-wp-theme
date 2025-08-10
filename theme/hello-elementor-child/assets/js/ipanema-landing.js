document.addEventListener('DOMContentLoaded', function() {

		// Initialize AOS
		AOS.init({ duration: 800, once: true, offset: 50, easing: 'ease-in-out' });

		// --- Mobile Menu ---
		const menuToggle = document.getElementById('menu-toggle');
		const mobileMenu = document.getElementById('mobile-menu');
		const menuOverlay = document.getElementById('menu-overlay');
		const menuClose = document.getElementById('menu-close');
		const body = document.body;
		let isMenuOpen = false; // State tracking

		function openMenu() {
			if (!mobileMenu || !menuOverlay || isMenuOpen) return;
			mobileMenu.classList.add('active');
			mobileMenu.setAttribute('aria-hidden', 'false');
			menuOverlay.classList.add('active');
			body.classList.add('mobile-menu-active'); // Use class for body overflow
			menuToggle.setAttribute('aria-expanded', 'true');
			isMenuOpen = true;
			// Trap focus inside menu (basic example)
			const focusableElements = mobileMenu.querySelectorAll('a[href], button');
			if (focusableElements.length) focusableElements[0].focus();
		}

		function closeMenu() {
			if (!mobileMenu || !menuOverlay || !isMenuOpen) return;
			mobileMenu.classList.remove('active');
			mobileMenu.setAttribute('aria-hidden', 'true');
			menuOverlay.classList.remove('active');
			body.classList.remove('mobile-menu-active');
			menuToggle.setAttribute('aria-expanded', 'false');
			menuToggle.focus(); // Return focus to toggle button
			isMenuOpen = false;
		}

		if (menuToggle) menuToggle.addEventListener('click', openMenu);
		if (menuClose) menuClose.addEventListener('click', closeMenu);
		if (menuOverlay) menuOverlay.addEventListener('click', closeMenu);

		// Close menu on Escape key
		document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && isMenuOpen) { closeMenu(); } });

			// Add onclick handler to MOBILE menu links to close menu after click (needed if walker isn't used)
		if (mobileMenu) {
			mobileMenu.addEventListener('click', function(e) {
				// Check if the clicked element is a link within the mobile menu list items
				if (e.target.closest('.mobile-menu-items a')) {
					// If the link is purely an anchor (#...), close menu
					if (e.target.closest('a').getAttribute('href').startsWith('#')) {
						closeMenu();
					}
					// If it's a link to another page, the page will navigate away,
					// closing the menu implicitly isn't strictly needed, but good for consistency.
				}
				// Also close if the Book a Call button is clicked (if it links to #contact)
				if (e.target.closest('.cta-button') && e.target.closest('a').getAttribute('href').startsWith('#contact')) {
					closeMenu();
				}
			});
		}


		// --- Navbar scroll effect ---
		const navbar = document.getElementById('main-nav');
		const header = document.getElementById('masthead');
		if (navbar && header) {
			let lastScrollY = window.scrollY;
			const scrollThreshold = 50; // Pixels before changing state

			const handleScroll = () => {
				const currentScrollY = window.scrollY;
				// Add scrolled class past threshold
				if (currentScrollY > scrollThreshold) {
					header.classList.add('scrolled', 'bg-dark-green', 'shadow-lg');
					header.classList.remove('bg-transparent');
				} else {
					header.classList.remove('scrolled', 'bg-dark-green', 'shadow-lg');
					header.classList.add('bg-transparent');
				}

				// Optional: Hide on scroll down (uncomment if needed)
				if (currentScrollY > lastScrollY && currentScrollY > header.offsetHeight) {
	header.style.transform = 'translateY(-100%)'; // Hide when scrolling down
} else {
	header.style.transform = 'translateY(0)';     // Show on scroll‑up
}

				lastScrollY = currentScrollY <= 0 ? 0 : currentScrollY;
			};
			window.addEventListener('scroll', handleScroll, { passive: true });
			handleScroll(); // Initial check in case page loads scrolled
		}


		// --- Back to top button ---
		const backToTopButton = document.getElementById('back-to-top');
		if (backToTopButton) {
			const handleBackToTopScroll = () => {
				if (window.scrollY > 300) { backToTopButton.classList.add('opacity-100', 'visible'); backToTopButton.classList.remove('opacity-0', 'invisible'); }
				else { backToTopButton.classList.add('opacity-0', 'invisible'); backToTopButton.classList.remove('opacity-100', 'visible'); }
			};
			window.addEventListener('scroll', handleBackToTopScroll, { passive: true });
			handleBackToTopScroll(); // Initial check

			backToTopButton.addEventListener('click', () => { window.scrollTo({ top: 0, behavior: 'smooth' }); });
		}

		// --- Smooth scrolling for internal anchor links ---
		document.querySelectorAll('a[href^="#"]').forEach(anchor => {
			// Ensure it's not just '#' and has a valid target potential
			if (anchor.getAttribute('href').length > 1) {
				anchor.addEventListener('click', function(e) {
					const href = this.getAttribute('href');
					let targetElement = null;
					try {
						targetElement = document.querySelector(href);
					} catch (error) {
						console.warn("Smooth scroll selector error:", error);
						return; // Exit if selector is invalid
					}

					if (targetElement) {
						e.preventDefault(); // Prevent default jump

						const headerHeight = header ? header.offsetHeight : 80; // Get dynamic header height or fallback
						const elementPosition = targetElement.getBoundingClientRect().top;
						const offsetPosition = elementPosition + window.scrollY - headerHeight - 20; // Adjust with header height and small buffer

						window.scrollTo({
							top: Math.max(0, offsetPosition), // Don't scroll above top
							behavior: 'smooth'
						});

						// // Accessibility: Move focus to the target section after scroll
						// // Timeout helps ensure scroll finishes before focus moves
						// setTimeout(() => {
						//     targetElement.setAttribute('tabindex', '-1'); // Make non-interactive elements focusable temporarily
						//     targetElement.focus({ preventScroll: true }); // Move focus without triggering another scroll
						// }, 1000); // Adjust delay as needed

						// No need to close mobile menu here, it's handled by the mobile menu click listener above if applicable
					}
					// If targetElement doesn't exist, allow default browser behavior (might navigate away)
				});
			}
		});


		// --- Optional: Basic Form Validation / Handling (Example only, replace with plugin) ---
		// const contactForm = document.querySelector('#contact form'); // Adjust selector if form ID changes
		// if (contactForm && !document.querySelector('.wpcf7') && !document.querySelector('.wpforms-container')) { // Only run if no plugin detected
		//     contactForm.addEventListener('submit', function(e) {
		//         // e.preventDefault(); // Prevent actual submit unless handled via AJAX
		//         // Add your basic validation here
		//         const name = contactForm.querySelector('#contact-name').value;
		//         const email = contactForm.querySelector('#contact-email').value;
		//         if (!name || !email) {
		//             alert('Please fill in required fields.');
		//             // Don't prevent default if fields are missing, let browser validation work
		//             // e.preventDefault();
		//         } else {
		//            // Could add AJAX submission here instead of standard POST
		//             console.log('Form appears valid, letting browser handle submit (or use AJAX)');
		//             // To prevent page reload, you WOULD use e.preventDefault() and add AJAX fetch() call here.
		//         }
		//     });
		// }


		}); // End DOMContentLoaded
