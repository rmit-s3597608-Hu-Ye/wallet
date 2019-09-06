$(document).ready(function () {

    $('#sidebar-dismiss, #sidebar-overlay').on('click', function () {
        console.log('hide sidebar');

        // hide sidebar
        $('#sidebar').removeClass('active');

        // hide overlay
        $('#sidebar-overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        console.log('open sidebar');

        // open sidebar
        $('#sidebar').addClass('active');

        // fade in the overlay
        $('#sidebar-overlay').addClass('active');
    });

});
