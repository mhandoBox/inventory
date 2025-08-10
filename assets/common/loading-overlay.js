// Define BASE_URL
var BASE_URL = $('meta[name="base_url"]').attr('content');

// Loading overlay management
const LoadingOverlay = {
    init: function() {
        // Create overlay if it doesn't exist
        if (!document.querySelector('.loading-overlay')) {
            const overlay = document.createElement('div');
            overlay.className = 'loading-overlay';
            overlay.innerHTML = `
                <img src="${BASE_URL}assets/common/loading-animation.svg" alt="Loading..." class="loading-animation">
            `;
            document.body.appendChild(overlay);
        }
    },

    show: function() {
        const overlay = document.querySelector('.loading-overlay');
        if (overlay) {
            document.body.classList.add('loading');
            overlay.classList.add('active');
        }
    },

    hide: function() {
        const overlay = document.querySelector('.loading-overlay');
        if (overlay) {
            document.body.classList.remove('loading');
            overlay.classList.remove('active');
        }
    }
};

// Initialize loading overlay
document.addEventListener('DOMContentLoaded', function() {
    LoadingOverlay.init();
    
    // Show loading on page load
    LoadingOverlay.show();
    
    // Hide loading when page is fully loaded
    window.addEventListener('load', function() {
        LoadingOverlay.hide();
    });
    
    // Show loading on AJAX requests
    $(document).ajaxStart(function() {
        LoadingOverlay.show();
    });
    
    $(document).ajaxStop(function() {
        LoadingOverlay.hide();
    });
    
    // Show loading on form submissions
    document.addEventListener('submit', function(e) {
        if (!e.target.classList.contains('no-loading')) { // Skip for forms with 'no-loading' class
            LoadingOverlay.show();
        }
    });
    
    // Show loading on page navigation
    window.addEventListener('beforeunload', function() {
        LoadingOverlay.show();
    });
});

// Page Preloader
document.onreadystatechange = function() {
    var preloader = document.getElementById('page-preloader');
    
    if (document.readyState === "complete") {
        // Add hidden class first (triggers transition)
        preloader.classList.add('preloader-hidden');
        
        // Remove element after transition
        setTimeout(function() {
            if (preloader.parentNode) {
                preloader.parentNode.removeChild(preloader);
            }
        }, 300);
    }
};

// Ajax Loading Overlay
$(document).ajaxStart(function() {
    $('#loading-overlay').fadeIn(200);
}).ajaxStop(function() {
    $('#loading-overlay').fadeOut(200);
});

// Show loading overlay for form submissions
$('form').on('submit', function() {
    $('#loading-overlay').fadeIn(200);
});
