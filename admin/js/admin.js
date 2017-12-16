function confirmDelete() {
    return !!confirm("Delete this item?");
}

jQuery(document).ready(function($) {
    $("#codeigniter_profiler").appendTo('footer');
    $("#show-profiler").click(function() {
        $("#codeigniter_profiler").toggle();
    });
});