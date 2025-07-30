$(document).ready(function () {
    $('#user-menu-button').click(function () {
        $('.dropdown-menu').toggle('hidden');
    });

    $('.leads-drop-down').click(function () {
        $('#sub-menu-1').toggle('hidden');
    });

    $('.deals-drop-down').click(function () {
        $('#sub-menu-2').toggle('hidden');
    });

    $('.posts-drop-down').click(function () {
        $('#sub-menu-3').toggle('hidden');
    });

    $('.emails-drop-down').click(function () {
        $('#sub-menu-4').toggle('hidden');
    });

    $('.post-templates-drop-down').click(function () {
        $('#sub-menu-5').toggle('hidden');
    });

    $('.deals-mobile-drop-down').click(function () {
        $('#mobile-sub-menu-2').toggle('hidden');
    });

    $('.leads-mobile-drop-down').click(function () {
        $('#mobile-sub-menu-1').toggle('hidden');
    });

    $('.emails-mobile-drop-down').click(function () {
        $('#mobile-sub-menu-4').toggle('hidden');
    });

    $('.posts-mobile-drop-down').click(function () {
        $('#mobile-sub-menu-3').toggle('hidden');
    });

    $('.post-templates-mobile-drop-down').click(function () {
        $('#mobile-sub-menu-5').toggle('hidden');
    });

    $('.close-sidenav').click(function () {
        $('.mobile-sidenav').toggle('hidden');
    });

    $('.open-sidenav').click(function () {
        $('.mobile-sidenav').toggle('hidden');
    });

    $('#notification-button').click(function () {
        $('.dropdown-notification').toggle('hidden');
    });

    $('.sub-menu-dropdown').click(function () {
        $('#sub-menu-list').toggle('hidden');
    });

    $('.mobile-sub-menu-dropdown').click(function () {
        $('#mobile-sub-menu-list').toggle('hidden');
    });
})

