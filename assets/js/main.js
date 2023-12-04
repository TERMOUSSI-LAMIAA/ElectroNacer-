
// -------------------
$(document).ready(function() {
    var sidebar = $(".sidebar");
      var sidebarTop = sidebar.offset().top;

      $(window).scroll(function() {
        if ($(window).scrollTop() > sidebarTop) {
          sidebar.addClass("fixed");
        } else {
          sidebar.removeClass("fixed");
        }
      });
    var overlay = $('.sidebar-overlay');

    $('.sidebar-toggle').on('click', function() {
        var sidebar = $('#sidebar');
        sidebar.toggleClass('open');
        if ((sidebar.hasClass('sidebar-fixed-left') || sidebar.hasClass('sidebar-fixed-right')) && sidebar.hasClass('open')) {
            overlay.addClass('active');
        } else {
            overlay.removeClass('active');
        }
    });

    overlay.on('click', function() {
        $(this).removeClass('active');
        $('#sidebar').removeClass('open');
    });

});

// Sidebar constructor
//
function htmlbodyHeightUpdate() {
    var height3 = $(window).height();
    var height1 = $('.nav').height() + 50;
    height2 = $('.container-main').height();
    if (height2 > height3) {
        $('html').height(Math.max(height1, height3, height2) + 10);
        $('body').height(Math.max(height1, height3, height2) + 10);
    } else
    {
        $('html').height(Math.max(height1, height3, height2));
        $('body').height(Math.max(height1, height3, height2));
    }

}
$(document).ready(function () {
    htmlbodyHeightUpdate();
    $(window).resize(function () {
        htmlbodyHeightUpdate();
    });
    $(window).scroll(function () {
        height2 = $('.container-main').height();
        htmlbodyHeightUpdate();
    });
});
/*database*/
document.addEventListener('DOMContentLoaded', function () {
    var mainContent = document.getElementById('main-content');
    var navLinks = document.querySelectorAll('.nav-link');

    // Function to load content based on the view
    function loadContent(view) {
        fetch('?view=' + view)
            .then(response => response.text())
            .then(data => {
                mainContent.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Add a click event listener to each navigation link
    navLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            // Prevent the default link behavior
            event.preventDefault();

            // Remove the 'active' class from all links
            navLinks.forEach(function (navLink) {
                navLink.classList.remove('active');
            });

            // Add the 'active' class to the clicked link
            link.classList.add('active');

            // Determine the view based on the clicked link
            var view = link.getAttribute('data-view');

            // Load the content based on the view
            loadContent(view);
        });
    });

    // Load all products on page loading
    loadContent('all_products');
});

