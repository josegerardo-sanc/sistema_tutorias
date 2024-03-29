// Auto update layout
(function() {
    window.layoutHelpers.setAutoUpdate(true);
    // window.attachMaterialRippleOnLoad();
})();

// Collapse menu
(function() {
    if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
        return;
    }

    try {
        window.layoutHelpers.setCollapsed(
            localStorage.getItem('layoutCollapsed') === 'true',
            false
        );
    } catch (e) {}
})();

$(function() {
    // Initialize sidenav
    $('#layout-sidenav').each(function() {
        new SideNav(this, {
            orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
        });
    });

    // Initialize sidenav togglers
    $('body').on('click', '.layout-sidenav-toggle', function(e) {
        e.preventDefault();
        window.layoutHelpers.toggleCollapsed();
        if (!window.layoutHelpers.isSmallScreen()) {
            try {
                localStorage.setItem('layoutCollapsed', String(window.layoutHelpers.isCollapsed()));
            } catch (e) {}
        }
    });

    if ($('html').attr('dir') === 'rtl') {
        $('#layout-navbar .dropdown-menu').toggleClass('dropdown-menu-right');
    }
});

$(function() {
    $('#ui-builder > .style-toggler').on('click', function() {
        $('#ui-builder').toggleClass('open');
    });
    $('#nav-dark').change(function() {
        if ($(this).is(":checked")) {
            $('#layout-sidenav').removeClass('bg-white');
            $('#layout-sidenav').addClass('bg-dark');
        } else {
            $('#layout-sidenav').addClass('bg-white');
            $('#layout-sidenav').removeClass('bg-dark');
        }
    });
    $('#brand-dark').change(function() {
        if ($(this).is(":checked")) {
            $('#layout-sidenav').removeClass('logo-white');
            $('#layout-sidenav').addClass('logo-dark');
        } else {
            $('#layout-sidenav').addClass('logo-white');
            $('#layout-sidenav').removeClass('logo-dark');
        }
    });
    $('#head-dark').change(function() {
        if ($(this).is(":checked")) {
            $('#layout-navbar').removeClass('bg-white');
            $('#layout-navbar').addClass('bg-dark');
        } else {
            $('#layout-navbar').addClass('bg-white');
            $('#layout-navbar').removeClass('bg-dark');
        }
    });
    $('#navbar-fixed').change(function() {
        if ($(this).is(":checked")) {
            $('html').addClass('layout-fixed');
        } else {
            $('html').removeClass('layout-fixed');
        }
    });
    $('#header-fixed').change(function() {
        if ($(this).is(":checked")) {
            $('html').addClass('layout-navbar-fixed');
        } else {
            $('html').removeClass('layout-navbar-fixed');
        }
    });
    $('.header-color > a').on('click', function() {
        var temp = $(this).attr('data-val');
        $('#layout-navbar').removeClassPrefix('bg-');
        $('#layout-navbar').addClass(temp);
    });
    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };
});
