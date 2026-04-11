     // Menu controls
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        const menuOverlay = document.getElementById('menuOverlay');

        // Open menu
        navbarToggler.addEventListener('click', (e) => {
            e.stopPropagation();
            navbarCollapse.classList.add('show');
            menuOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        });

        // Close menu - overlay click
        menuOverlay.addEventListener('click', () => {
            navbarCollapse.classList.remove('show');
            menuOverlay.classList.remove('show');
            document.body.style.overflow = '';
        });

        // Close menu - escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
                menuOverlay.classList.remove('show');
                document.body.style.overflow = '';
            }
        });

        // Smooth scroll & close menu
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
                // Close menu
                navbarCollapse.classList.remove('show');
                menuOverlay.classList.remove('show');
                document.body.style.overflow = '';
            });
        });

        // Close dropdown on outside click
        document.addEventListener('click', (e) => {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(e.target)) {
                    const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
                    const bsDropdown = bootstrap.Dropdown.getInstance(dropdownToggle);
                    if (bsDropdown) bsDropdown.hide();
                }
            });
        });