
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
    height2 = $('.container-main').heig<ht();
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
// requêtes asynchrones
/*database*/
$(document).ready(function () {
    // Handle click events on navigation links
    $('.nav-link').on('click', function (e) {
        e.preventDefault();
        var view = $(this).data('view');
        loadProducts(view);
    });

    // Initial load with 'all_products' view
    loadProducts('all_products');

    // Function to load products based on the selected view
    function loadProducts(view) {
        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: { view: view },
            success: function (response) {
                $('#main-content').html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
});