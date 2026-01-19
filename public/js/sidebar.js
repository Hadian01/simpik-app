$(document).ready(function () {

    $('#btnSidebar').on('click', function () {
        $('#sidebar').addClass('active');
        $('#sidebarOverlay').show();
    });

    $('#sidebarOverlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $(this).hide();
    });

});
