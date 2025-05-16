<footer id="footer-content">
    <div class="container footer-container">
        <!-- content goes here -->
    </div>
</footer>

<?php get_template_part('partials/modal','content'); ?>
<?php get_template_part('partials/modal','menu'); ?>
<?php get_template_part('partials/modal','story'); ?>
    <?php wp_footer(); ?>
    <!-- Clean, minimal modal script with unique class names -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal trigger buttons with new class names
        var modalTriggers = document.querySelectorAll('[class*="ts-"][class*="-trigger"]');
        
        // Modal close elements
        var closeButtons = document.querySelectorAll('.modal-close, .close-modal, .modal-background');
        
        // All modals
        var modals = document.querySelectorAll('.modal');
        
        // Open modal function
        function openModal(modalId) {
            // Close all modals first
            modals.forEach(function(modal) {
                modal.classList.remove('is-active');
            });
            
            // Open the specific modal
            var targetModal = document.getElementById('modal-' + modalId);
            if (targetModal) {
                targetModal.classList.add('is-active');
                console.log('Opened modal:', modalId);
            } else {
                console.error('Modal not found:', modalId);
            }
        }
        
        // Close modal function
        function closeModals() {
            modals.forEach(function(modal) {
                modal.classList.remove('is-active');
            });
            console.log('All modals closed');
        }
        
        // Add click events to all modal triggers
        modalTriggers.forEach(function(trigger) {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                var modalType = this.getAttribute('data-modal');
                openModal(modalType);
                return false;
            });
        });
        
        // Add click events to close buttons
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                closeModals();
                return false;
            });
        });
        
        // Close modals when clicking outside content
        modals.forEach(function(modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModals();
                }
            });
        });
        
        // Close modals with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModals();
            }
        });
        
        console.log('Modal system initialized');
    });
    </script>
    </body>
</html>