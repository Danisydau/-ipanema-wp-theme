<?php
/**
 * Template Name: Ipanema Custom Landing Page
 * Template Post Type: page
 *
 * This template displays the custom HTML structure defined below, bypassing the standard loop/content area
 * unless explicitly called with the_content(). Uses dynamic menus for navigation.
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

	

	<!-- Navigation Menu (Dynamic via WP Admin) -->
	<header id="masthead" class="site-header fixed top-0 left-0 w-full z-50 transition-all duration-300" role="banner">
		<nav id="main-nav" class="relative py-4 px-6 md:px-12 transition-all duration-300 bg-transparent"> <?php // Added relative, adjusted padding slightly ?>
			<div class="container mx-auto flex justify-between items-center">
				<!-- Logo – desktop -->
<div class="site-branding shrink-0">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="Homepage">
		<?php
		$brand_logo_url = 'https://ipanemamedia.com/wp-content/uploads/2025/04/Logo_ipanema_official.png'; // <- your PNG
		if ( ! empty( $brand_logo_url ) ) :
			?>
			<img src="<?php echo esc_url( $brand_logo_url ); ?>"
				alt="<?php bloginfo( 'name' ); ?> Logo"
				class="logo-img" />
		<?php else : ?>
			<span class="site-title font-bold text-lg text-gold"><?php bloginfo( 'name' ); ?></span>
		<?php endif; ?>
	</a>
</div>

				<!-- Desktop Navigation -->
				<div class="hidden md:flex items-center">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu flex space-x-8', // Tailwind classes for the <ul>
								'container'      => false, // No div wrapper
								'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'link_before'    => '<span class="hover-gold font-medium transition-colors duration-300">', // Wrap text for styling
								'link_after'     => '</span>',
								'fallback_cb'    => false,
							)
						);
					}
					?>
				</div>

				<!-- Mobile Menu Toggle Button -->
				<button class="md:hidden text-gold text-2xl focus:outline-none p-2 -mr-2" id="menu-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="Open Menu">
					<i class="fas fa-bars" aria-hidden="true"></i>
				</button>
			</div>
		</nav>
	</header>

	<!-- Mobile Menu Panel (Dynamic) -->
	<div class="mobile-menu" id="mobile-menu" role="dialog" aria-modal="true" aria-labelledby="mobile-menu-heading">
		<div class="flex justify-between items-center mb-12 px-1"> <?php // Adjusted padding slightly ?>
			<!-- Logo – mobile menu -->
<div class="site-branding">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php echo esc_url( $brand_logo_url ); ?>"
			alt="<?php bloginfo( 'name' ); ?> Logo"
			class="logo-img h-8" />
	</a>
</div>
			<button class="text-white text-3xl focus:outline-none" id="menu-close" aria-label="Close Menu">
				<i class="fas fa-times" aria-hidden="true"></i>
			</button>
		</div>

		<nav class="mobile-navigation" aria-label="Mobile Navigation" id="mobile-menu-heading">
			<?php
			if ( has_nav_menu( 'mobile' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'mobile',
						'menu_class'     => 'mobile-menu-items flex flex-col space-y-6', // Classes for the <ul>
						'container'      => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'link_before'    => '<span class="text-2xl font-bold hover-gold transition-colors duration-300 block py-1">', // Style wrapper
						'link_after'     => '</span>',
						'fallback_cb'    => false,
					)
				);
			} elseif ( has_nav_menu( 'primary' ) ) {
				// Fallback to primary menu if mobile menu isn't set
				wp_nav_menu(
					array(
						'theme_location' => 'primary', // Fallback
						'menu_class'     => 'mobile-menu-items flex flex-col space-y-6',
						'container'      => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'link_before'    => '<span class="text-2xl font-bold hover-gold transition-colors duration-300 block py-1">',
						'link_after'     => '</span>',
						'fallback_cb'    => false,
					)
				);
			} else {
				// If no menus are set, provide instructions
				echo '<p class="text-center text-gray-400 mt-10">Please set up a menu in Appearance -> Menus and assign it to the "Primary" or "Mobile" location.</p>';
			}
			?>
		</nav>

		<?php // Mobile Menu Footer Button (e.g., Book a Call) ?>
		<div class="absolute bottom-8 left-6 right-6 mt-12">
			<?php // NOTE: Update '#' with the actual link/action ?>
			<a href="#contact" class="block w-full cta-button bg-gold text-dark-green font-bold py-4 px-8 rounded-full text-center text-lg">
				Book a Call
				<i class="fas fa-phone ml-2"></i>
			</a>
		</div>
	</div>
	<div class="menu-overlay" id="menu-overlay"></div> <?php // Overlay for closing mobile menu ?>

	<main id="main" class="site-main" role="main">

	<section id="home" aria-labelledby="hero-headline-id" class="relative">
	
	<div class="video-responsive">
		<video autoplay muted loop playsinline poster="/path/to/your/video-poster.jpg">
			<source src="https://ipanemamedia.com/wp-content/uploads/2025/04/Olha_pra_elas_fan_reporter_1.mp4" type="video/mp4">
			Your browser does not support HTML5 video.
		</video>
		<div class="video-overlay"></div>
	</div>

<div class="hero-content px-6 flex items-center relative z-10">
		
		<div class="max-w-3xl w-full" data-aos="fade-up" data-aos-duration="800">
			<div class="mb-6">
				<img
					src="https://ipanemamedia.com/wp-content/uploads/2025/05/Ipanema-Media-campaign-banner_LATEST.png"
					alt="Proud Winner of the 2024 Bronze Award for Social Media & Influencer Marketing"
					class="w-full h-auto object-cover"
				/>
			</div>

			<h1 id="hero-headline-id" class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 text-shadow">
				<?php the_title(); ?>
			</h1>

			<p class="text-xl md:text-2xl mb-10 max-w-2xl opacity-90 leading-relaxed">
				We craft award-winning brand experiences and productions that stop people in their tracks — built to connect, move culture, and drive real business outcomes.
			</p>

			<div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
				<a href="#work" class="cta-button bg-gold text-dark-green font-bold py-4 px-8 rounded-full text-center inline-flex items-center justify-center hover:bg-opacity-90 group">
					See Our Work
					<i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
				</a>
				<a href="#contact" class="cta-button border-2 border-white hover:border-gold hover:text-gold font-bold py-4 px-8 rounded-full text-center inline-flex items-center justify-center">
					Book a Strategy Call
				</a>
			</div>

			<div class="mt-16 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm opacity-80">
				<div class="flex items-center"><i class="fas fa-trophy text-gold mr-2"></i><span>Cannes Lion Winner</span></div>
				<div class="flex items-center"><i class="fas fa-globe-americas text-gold mr-2"></i><span>Global Campaigns</span></div>
				<div class="flex items-center"><i class="fas fa-users text-gold mr-2"></i><span>100M+ Audience Reach</span></div>
			</div>
		</div>
	</div>
	<div class="scroll-indicator" aria-hidden="true"><span></span><span></span><span></span></div>
</section>


		<!-- Work Section -->
		<section class="py-20 bg-dark-green bg-opacity-95 relative z-10" id="work" aria-labelledby="work-heading">
			<div class="container mx-auto px-6 md:px-12">
				<div class="text-center mb-16" data-aos="fade-up">
					<span class="inline-block bg-gold bg-opacity-20 text-dark-green px-4 py-2 rounded-full text-sm font-bold mb-4 uppercase tracking-wider"> <!--                                         ^^^^^^^^^^^^^^^^ Change made here -->
						Selected Work
					</span>
					<h2 id="work-heading" class="text-3xl md:text-4xl font-bold mb-6">Our Global Award Winning <span class="text-gold">Campaign</span></h2>
					<p class="max-w-2xl mx-auto text-lg opacity-90">We craft immersive brand experiences that resonate with audiences and deliver measurable results.</p>
				</div>
				<div class="grid grid-cols-1 gap-8 justify-items-center">
					<?php
					// Example Structure for Work Items (Replace with actual data/loop)
					$work_items = array(
						array(
							'img'      => 'https://ipanemamedia.com/wp-content/uploads/2025/04/43cb3d9b5a33403c87ea5a53feb13677.avif',
							'alt'      => 'Fan Reporter Campaign',
							'title'    => 'Fan Reporter',
							'subtitle' => 'Social Media Campaign',
							'badge'    => 'Cannes Lion 2024',
						),
					);
					foreach ( $work_items as $index => $item ) :
						?>
					<div class="work-card bg-black/20 rounded-xl overflow-hidden group w-full max-w-xl" data-aos="fade-up" data-aos-delay="<?php echo ( $index * 100 ); ?>">
						<a href="#" class="block"> <?php // Link to project detail page or modal ?>
							<div class="relative overflow-hidden h-64">
								<img src="<?php echo esc_url( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
								<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-100"></div>
								<div class="absolute bottom-0 left-0 p-6">
									<h3 class="text-xl font-bold mb-1"><?php echo esc_html( $item['title'] ); ?></h3>
									<p class="text-sm opacity-90"><?php echo esc_html( $item['subtitle'] ); ?></p>
								</div>
								<?php if ( $item['badge'] ) : ?>
								<div class="absolute top-4 right-4 bg-gold text-dark-green px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
									<?php echo esc_html( $item['badge'] ); ?>
								</div>
								<?php endif; ?>
							</div>
						</a>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="text-center mt-12" data-aos="fade-up">
					<?php // Link to a potential portfolio page or use # for now ?>
					<a href="#" class="inline-flex items-center justify-center border-2 border-gold text-gold font-bold py-3 px-8 rounded-full hover:bg-gold hover:text-dark-green transition-all duration-300 group">
						View All Projects
						<i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
					</a>
				</div>
			</div>
		</section>

		<!-- About Section -->
		<section class="py-20 relative" id="about" aria-labelledby="about-heading">
	<div class="container mx-auto px-6 md:px-12 flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

	<!-- LEFT COLUMN: Your “Our Story” text/stats -->
	<div class="lg:w-1/2" data-aos="fade-right">
		<span class="inline-block bg-gold bg-opacity-20 text-dark-green px-4 py-2 rounded-full text-sm font-bold mb-4 uppercase tracking-wider">
		Our Story
		</span>
		<h2 id="about-heading" class="text-3xl md:text-4xl font-bold mb-6">
		Crafting <span class="text-gold">Cultural</span> Moments That Matter
		</h2>
		<div class="space-y-6 text-lg opacity-90 leading-relaxed">
		<p>Ipanema Media has grown from a boutique creative shop to an internationally recognized agency with work featured in AdAge, Campaign, and awarded at Cannes Lions.</p>
		<p>We believe in the power of culture to transform brands. Our team of strategists, creatives, and technologists work together to create campaigns that don't just get seen—they get remembered.</p>
		</div>
		<div class="mt-10 flex flex-wrap gap-8">
		<div class="flex items-center" data-aos="fade-up" data-aos-delay="100">
			<i class="fas fa-medal text-gold text-3xl mr-4"></i>
			<div>
			<div class="stat-number leading-none">12+</div>
			<div class="text-sm opacity-80 mt-1">Industry Awards</div>
			</div>
		</div>
		<div class="flex items-center" data-aos="fade-up" data-aos-delay="200">
			<i class="fas fa-globe text-gold text-3xl mr-4"></i>
			<div>
			<div class="stat-number leading-none">30+</div>
			<div class="text-sm opacity-80 mt-1">Countries</div>
			</div>
		</div>
		<div class="flex items-center" data-aos="fade-up" data-aos-delay="300">
			<i class="fas fa-users text-gold text-3xl mr-4"></i>
			<div>
			<div class="stat-number leading-none">30+</div>
			<div class="text-sm opacity-80 mt-1">Team Collaborators</div>
			</div>
		</div>
		</div>
	</div>

	<!-- RIGHT COLUMN: Portrait, perfectly square, centered on mobile / aligned right on desktop -->
	<!-- RIGHT COLUMN: Portrait + caption + intro text -->
<div class="lg:w-1/2 mt-10 lg:mt-0 flex flex-col items-center lg:items-end space-y-6" data-aos="fade-left">
	<!-- Square container -->
	<div class="w-48 h-64 overflow-hidden shadow-lg">
	<img
		src="https://ipanemamedia.com/wp-content/uploads/2025/04/DANILO-4-BW-HR-1.jpeg"
		alt="Danilo Monteiro"
		class="w-full h-full object-cover object-center"
	/>
	</div>

	<!-- Text under the portrait -->
	<div class="text-center lg:text-right max-w-xs">
	<p class="font-bold text-xl">
		Danilo Monteiro<br>
		<span class="text-sm font-medium">Cannes Lions Bronze-winning Creative Producer</span>
	</p>
	<p class="mt-2 text-sm">
		<a
		href="https://www.lovethework.com/directory/individuals/danilo-monteiro-11979829"
		target="_blank" rel="noopener noreferrer"
		class="underline hover:text-gold transition-colors"
		>
		Love the Work credits
		</a>
	</p>
	<p class="mt-4 opacity-90 leading-relaxed">
		We’ve helped brands (big and small) get their social humming from strategy through to implementation. Our client range speaks for itself! Whether you’re after organic, paid or influencer/creator help – get in touch! We’re here to help.
	</p>
	</div>
</div>

	</div>
</section>

  

		<!-- Clients Section -->
<!-- Clients Section -->
<section class="py-20 bg-dark-green bg-opacity-95" id="clients" aria-labelledby="clients-heading">
	<div class="container mx-auto px-6 md:px-12">
	<div class="text-center mb-16" data-aos="fade-up">
		<span class="inline-block bg-gold bg-opacity-20 text-dark-green px-4 py-2 rounded-full text-sm font-bold mb-4 uppercase tracking-wider">
		Trusted By
		</span>
		<h2 id="clients-heading" class="text-3xl md:text-4xl font-bold mb-6">
		Brands We've <span class="text-gold">Collaborated</span> With
		</h2>
		<p class="max-w-2xl mx-auto text-lg opacity-90">
		From global giants to innovative startups and local business, we've helped shape brand narratives across industries.
		</p>
	</div>

	<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-8 gap-y-12 items-center justify-items-center" data-aos="fade-up">
		<?php
		$client_logos = array(
			'https://ipanemamedia.com/wp-content/uploads/2025/04/CBF2019W-1.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/Guarana-antarctica_2020.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/cannes-lions-1.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/Ambev_logo_2015.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/FIFA_Womens_World_Cup_logo_PNG7.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/australia-and-new-zealand-banking-group-limited-seeklogo.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/Looksee_FINAL-02-7.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/idLHppKHk9_1745390104771.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/idQHcV1lce_logos.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/id_Y-FRCE__logos.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/idA0FA0t1M_1745390322846.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/id226ogL0Z_1745390657062.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/Effie-Worldwide_id5F9N_0EE_0.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/idpRTtksGZ_logos.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/Jim-Beam_idf_EHBQ-9_0.png',
			'https://ipanemamedia.com/wp-content/uploads/2025/04/idTPFJfDAm_1745391846117.png',

		);

		foreach ( $client_logos as $index => $client_logo_url ) :
			?>
		<img
			src="<?php echo esc_url( $client_logo_url ); ?>"
			alt="Client Logo <?php echo ( $index + 1 ); ?>"
			class="client-logo w-full h-auto max-h-10 md:max-h-12 object-contain"
			data-aos="fade-up"
			data-aos-delay="<?php echo ( $index * 50 ); ?>"
		>
		<?php endforeach; ?>
	</div>
	</div>
</section>
		<!-- Testimonials Section -->
<section class="py-20 relative" id="testimonials" aria-labelledby="testimonials-heading">
	<div class="container mx-auto px-6 md:px-12 relative z-10">
	<div class="text-center mb-16" data-aos="fade-up">
		<span class="inline-block bg-gold bg-opacity-20 text-dark-green px-4 py-2 rounded-full text-sm font-bold mb-4 uppercase tracking-wider">
		Testimonials
		</span>
		<h2 id="testimonials-heading" class="text-3xl md:text-4xl font-bold mb-6">
		What Our <span class="text-gold">Clients</span> Say
		</h2>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
		<?php
		$testimonials = array(
			array(
				'image' => 'https://ipanemamedia.com/wp-content/uploads/2025/04/gabriela.jpg',
				'name'  => 'Gabriela',
				'title' => 'Campaigns Manager, Guaraná/Ambev',
				'quote' => 'So many people involved to make this campaign happen! Cheers Danilo, and congratulations on Cannes!',
			),
			array(
				'image' => 'https://ipanemamedia.com/wp-content/uploads/2025/04/steve.jpg',
				'name'  => 'Steve',
				'title' => 'District Sales Manager, Coca-Cola Amatil',
				'quote' => 'Seeing what Dan and the team was able to put on is incredible—the transformation of this pub into an absolute hub for events, community-driven family and youth. When they asked if I could bring some of our brands for their first Pub Fest, it was an easy choice.',
			),
			array(
				'image' => 'https://ipanemamedia.com/wp-content/uploads/2025/04/pedro.jpg',
				'name'  => 'Pedro',
				'title' => 'Africa. Creative DDB, Creative Director',
				'quote' => 'Awesome, it was brilliant—when can we do it again? Thanks for everything!',
			),
			array(
				'image' => 'https://ipanemamedia.com/wp-content/uploads/2025/04/tais.jpg',
				'name'  => 'Tais',
				'title' => 'Africa. Creative DDB, Project Manager',
				'quote' => "I didn't believe you'd manage to deliver everything on time! Brilliant, top-notch work.",
			),
			array(
				'image' => 'https://ipanemamedia.com/wp-content/uploads/2025/04/renata.jpg',
				'name'  => 'Renata',
				'title' => 'Director Producer',
				'quote' => "Without you, this wouldn't have been possible! We're going to win at Cannes!",
			),
			array(
				'image' => 'https://ipanemamedia.com/wp-content/uploads/2025/04/silvia.jpg',
				'name'  => 'Manager Silvia',
				'title' => ', Fashion/Retail Import-Export',
				'quote' => 'Before working with Danilo, we never had an editorial done on time… let alone optimized on all of our platforms.',
			),
		);

		foreach ( $testimonials as $index => $testimonial ) :
			?>
			<div class="testimonial-card p-8 rounded-xl flex flex-col h-full" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
			<div class="flex items-center mb-6">
				<div class="w-12 text-center mr-4 text-gold text-4xl">
	<i class="fas fa-user-circle"></i>
</div>
				<div>
				<h4 class="font-bold leading-tight"><?php echo esc_html( $testimonial['name'] ); ?></h4>
				<p class="text-sm opacity-80 leading-tight"><?php echo esc_html( $testimonial['title'] ); ?></p>
				</div>
			</div>
			<blockquote class="mb-6 italic text-opacity-90 flex-grow leading-relaxed">
				<p><?php echo esc_html( $testimonial['quote'] ); ?></p>
			</blockquote>
			<div class="flex text-gold mt-auto">
				<?php
				for ( $i = 0; $i < 5; $i++ ) {
					echo '<i class="fas fa-star mr-1"></i>';}
				?>
			</div>
			</div>
		<?php endforeach; ?>
	</div>
	</div>
</section>

		<!-- CTA Section -->
		<section class="py-20 bg-gradient-to-r from-dark-green to-emerald-900" aria-labelledby="cta-heading">
			<div class="container mx-auto px-6 md:px-12">
				<div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
					<h2 id="cta-heading" class="text-3xl md:text-4xl font-bold mb-6">Ready to Create Something <span class="text-gold">Extraordinary</span>?</h2>
					<p class="text-xl mb-10 max-w-3xl mx-auto opacity-90 leading-relaxed">Let's discuss how we can help your brand make a cultural impact that drives results.</p>
					<div class="flex flex-col sm:flex-row justify-center gap-6">
						<a href="#contact" class="cta-button bg-gold text-dark-green font-bold py-4 px-8 rounded-full text-center inline-flex items-center justify-center hover:bg-opacity-90 group">Book a Strategy Call <i class="fas fa-phone ml-2"></i></a>
						<a href="#" class="cta-button border-2 border-white hover:border-gold hover:text-gold font-bold py-4 px-8 rounded-full text-center inline-flex items-center justify-center group">See Our Case Studies <i class="fas fa-book-open ml-2"></i></a>
					</div>
				</div>
			</div>
		</section>

<!-- Contact Section -->
<section class="py-20" id="contact" aria-labelledby="contact-heading">
	<div class="container mx-auto px-6 md:px-12">
	<div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
		<div class="lg:w-1/2" data-aos="fade-right">
		<span class="inline-block bg-gold bg-opacity-20 text-dark-green px-4 py-2 rounded-full text-sm font-bold mb-4 uppercase tracking-wider">
			Get In Touch
		</span>
		<h2 id="contact-heading" class="text-3xl md:text-4xl font-bold mb-6">
			Let's <span class="text-gold">Connect</span>
		</h2>
		<p class="text-lg mb-8 opacity-90 leading-relaxed">
			Whether you're ready to start a project or just want to explore possibilities, we'd love to hear from you.
		</p>
		<!-- your address / email / phone / social icons here… -->
		</div>

		<div class="lg:w-1/2" data-aos="fade-left">
		<?php echo do_shortcode( '[contact-form-7 id="bfd1c40" title="Contact form 1"]' ); ?>
		</div>
	</div>
	</div>
</section>


	</main> <!-- /#main -->

	<!-- Footer -->
	<footer id="colophon" class="site-footer bg-dark-green py-12 border-t border-white border-opacity-10 relative z-10" role="contentinfo">
		<div class="container mx-auto px-6 md:px-12">
			<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-8 md:gap-4">
				<div class="site-branding shrink-0">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo esc_url( $brand_logo_url ); ?>"
		alt="<?php bloginfo( 'name' ); ?> Logo" class="logo-img h-10">
					</a>
				</div>
				<nav class="footer-navigation" aria-label="Footer Navigation">
					<ul class="flex flex-wrap justify-center gap-x-6 gap-y-2 md:gap-x-8">
						<?php // Could use another wp_nav_menu('footer') location here too ?>
						<li><a href="#work" class="footer-link hover-gold transition-colors duration-300 text-sm">Work</a></li>
						<li><a href="#about" class="footer-link hover-gold transition-colors duration-300 text-sm">About</a></li>
						<li><a href="#clients" class="footer-link hover-gold transition-colors duration-300 text-sm">Clients</a></li>
						<li><a href="#contact" class="footer-link hover-gold transition-colors duration-300 text-sm">Contact</a></li>
						<?php // Links to actual pages (create these pages in WP) ?>
						<li><a href="https://ipanemamedia.com/privacy-policy/" class="footer-link hover-gold transition-colors duration-300 text-sm">Privacy Policy</a></li>
<li><a href="https://ipanemamedia.com/terms-of-service/" class="footer-link hover-gold transition-colors duration-300 text-sm">Terms of Service</a></li>
<li><a href="https://ipanemamedia.com/blog/" class="footer-link hover-gold transition-colors duration-300 text-sm">Blog</a></li>
					</ul>
				</nav>
			</div>
			<div class="border-t border-white border-opacity-20 pt-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-4 md:gap-0">
				<p class="text-sm opacity-80">© <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
				<div class="flex flex-wrap justify-center space-x-6">
					<?php // NOTE: Create Privacy/Terms pages in WP and link to them ?>
					<a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="text-sm opacity-80 hover:opacity-100 hover-gold transition-opacity duration-300">Privacy Policy</a>
					<a href="<?php echo esc_url( home_url( '/terms-of-service' ) ); ?>" class="text-sm opacity-80 hover:opacity-100 hover-gold transition-opacity duration-300">Terms of Service</a>
				</div>
			</div>
		</div>
	</footer>

	<!-- Back to Top Button -->
	<button id="back-to-top" class="fixed bottom-6 right-6 bg-gold text-dark-green w-12 h-12 rounded-full flex items-center justify-center shadow-lg opacity-0 invisible transition-all duration-300 z-50 hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-dark-green focus:ring-gold" aria-label="Back to Top">
		<i class="fas fa-arrow-up" aria-hidden="true"></i>
	</button>

	<!-- Scripts removed and enqueued in functions.php -->

<?php get_footer(); ?>