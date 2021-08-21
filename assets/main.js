jQuery(document).ready(function ($) {
    $(".sub-menu").hide();
    $(".current_page_item .sub-menu").show();
    $("li.menu-item").click(function () { // mouse CLICK instead of hover
        // Only prevent the click on the topmost buttons
        if ($('.sub-menu', this).length >=1) {
            event.preventDefault();
        }
        $(".sub-menu").hide(); // First hide any open menu items
        $(this).find(".sub-menu").show(); // display child
        event.stopPropagation();
    });
});